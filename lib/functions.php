<?php
//require_once 'C:\wamp\www\proginz\plugins\PHPMailer\PHPMailerAutoload.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'configuration.class.php';
date_default_timezone_set(Configuration::$TIME_ZONE);

function printAllNewsletters(){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " newsletter.id AS id,  "
                                    . " newsletter.date AS date, "
                                    . " newsletter.name AS name, "
                                    . " newsletter.body AS body, "
                                    . " newsletter.description AS description, "
                                    . " category.name AS category "
                                    . " FROM newsletter "
                                    . " LEFT JOIN category ON category.id=newsletter.category "
                                    . " WHERE newsletter.state = '2' " 
                                    . " AND category.state = '1' "
                                    . " ORDER BY newsletter.date DESC "
                ) or die(mysqli_error($con));
           //echo '<div class="row ">';
        $items = 1;
        while ($newsletter = $result->fetch_object()) {
            if($items == 1 ) echo '<div class="row row-eq-height">';
            echo '<div class="col-md-4">' 
                    . '<div class="thumbnail">'
                        . '<img alt="100%x200" src="images/newsletter.jpg" style="-webkit-filter: hue-rotate(' . rand(0,360). 'deg) saturate(' . rand(1,4) . ');">'
                            . '<div class="caption">'
                            . '<span>' . $newsletter->date . '<br/>' . $newsletter->category . '</span>'
                            . '<h3>' . $newsletter->description . '</h3>'
                            . '<p>' . $newsletter->body . '</p>'
                        . '</div>'
                    . '</div>'
                . '</div>'; 
            if($items == 3 ){ echo '</div>'; $items = 0; } $items++;
        }
        //echo '</div>';
        Configuration::dbDisconnect($con);
}

function categoryChekboxOptions($secret, $type){
        $con = Configuration::dbConnect();
        $email = getEmailBySecret($secret);
        $subscriberId = getSubscriberId($email);
        $result = mysqli_query($con, "SELECT "
                                    . " category.id AS id,  "
                                    . " category.name AS name "
                                    . " FROM category "
                                    . " WHERE category.state = '1' " 
                                    . " ORDER BY name ASC "
                ) or die(mysqli_error($con));
        $userResult = mysqli_query($con, "SELECT "
                                    . " subscriber_category_xref.category_id AS id  "
                                    . " FROM subscriber_category_xref "
                                    . " WHERE subscriber_category_xref.subscriber_id = '$subscriberId' " 
       ) or die(mysqli_error($con));
         while ($category = $userResult->fetch_object()) {
             $subscribedCategories[] = $category->id;
         }
        //print_r($subscribedCategories);
        //print_r("subid:" . $subscriberId . $email . $secret);
        while ($category = $result->fetch_object()) {
            echo '<div class="checkbox">'
                . '<label>'
                . '<input type="checkbox" name="category[]" '
                . 'value="' . $category->id . '"';
            switch($type){
                case 'subscribe':
                    if(in_array($category->id, $subscribedCategories)) echo ' CHECKED DISABLED ';
                break;
                case 'unsubscribe':
                   if(!(in_array($category->id, $subscribedCategories))) echo ' DISABLED '; 
                break;
            }
            echo '>' 
                . $category->name
                . '</label>'
                . '</div>'; 
        }
        Configuration::dbDisconnect($con);    
}

function confirmSubscription($email){
    if(sendConfirmation($email, 'subscribe'))
                return true;
    return false;
}

function addSubscription($secret, $categories){
    $email = getEmailBySecret($secret);
    if($email != NULL && !(empty($categories))){
        if(!empty($subscriberId = addSubscriber($email)))
        {
            $con = Configuration::dbConnect();
            foreach($categories as $category){
                mysqli_query($con, "INSERT IGNORE INTO subscriber_category_xref "
                                        . " SET subscriber_category_xref.subscriber_id = '$subscriberId',  "
                                        . " subscriber_category_xref.category_id = '$category'" 
                    ) or die(mysqli_error($con)); 
            }
            Configuration::dbDisconnect($con);
            if(markSecret($secret))
                return true;
        }
    }
    return false;
}

function removeSubscription($categories, $secret){
    if(!empty($categories)){
        $con = Configuration::dbConnect();
      
        $dateUsed = date('Y-m-d H:i:s');
        $email = getEmailBySecret($secret);
        if($email != NULL){
            $query = mysqli_query($con, "SELECT subscriber.id FROM subscriber WHERE email = '$email' AND state = '1'"
                ) or die(mysqli_error($con));
            if(mysqli_num_rows($query) > 0){
                $result = $query->fetch_object();
                $subscriberId = $result->id;
                foreach($categories as $category){
                      mysqli_query($con, "DELETE FROM subscriber_category_xref "
                                    . " WHERE subscriber_id = '$subscriberId' "
                                    . " AND category_id = '$category'" 
                          ) or die(mysqli_error($con)); 
                }
                
                // check if any subscribed categories left
                $query = mysqli_query($con, "SELECT COUNT(*) as count FROM subscriber_category_xref WHERE subscriber_id = '$subscriberId'"
                ) or die(mysqli_error($con));
                $result = $query->fetch_object();
                print_r($result);
                if($result->count == 0){
                    mysqli_query($con, "UPDATE subscriber SET state = '0', date_suspended = '$dateUsed' WHERE id = '$subscriberId'"
                    ) or die(mysqli_error($con));
                }
                markSecret($secret);
                return true;
            }
        }
        Configuration::dbDisconnect($con);
    }
    return false;
}

function confirmSubscriptionRemoval($email){
    if(checkSubscriber($email))
        if(sendConfirmation($email, 'unsubscribe'))
                return true;
    return false;
}

function checkSubscriber($email){
    $con = Configuration::dbConnect();
    $email =  $con->real_escape_string($email);
    $query = mysqli_query($con, "SELECT subscriber.id FROM subscriber WHERE email = '$email' AND state = '1'"
                ) or die(mysqli_error($con));
        Configuration::dbDisconnect($con);
    if(mysqli_num_rows($query) > 0) 
        return true;
    return false;
}

function getSubscriberId($email){
    $con = Configuration::dbConnect();
    $email =  $con->real_escape_string($email);
    $query = mysqli_query($con, "SELECT subscriber.id FROM subscriber WHERE email = '$email' AND state = '1'"
                ) or die(mysqli_error($con));
        Configuration::dbDisconnect($con);
    if(mysqli_num_rows($query) > 0){ 
        $result = $query->fetch_object();
        return $result->id;
    }
    return NULL;
}

function sendConfirmation($email, $type){
    $secret = generateRandomString(Configuration::$SECRET_SIZE);
    $con = Configuration::dbConnect();
    $email =  $con->real_escape_string($email);
    $date_sent = date("Y-m-d H:i:s");
    $subject = 'NEWS PIGeon | Confirmation check';
    $link = "http://$_SERVER[HTTP_HOST]/proginz/index.php?secret=" . $secret;
    mysqli_query($con, "INSERT INTO confirmation_link "
                                    . " SET is_used = '0',  "
                                    . " secret = '$secret', "
                                    . " email = '$email', "
                                    . " date_sent = '$date_sent'"
                ) or die(mysqli_error($con)); 
        switch ($type){
            case "unsubscribe":
                $body = 'We are sorry that you feel that way. To cancel your subscribtion please folow this link: <br/> ' . $link . '&view=confirmation&confirmation=unsubscribe';
            break;
            case "subscribe":
                $body = 'To confirm your subscription please folow this link: <br/>' . $link . '&view=confirmation&confirmation=subscribe';
            break;
        }
        if(sendEmail($email, $subject, $body))
                return true;
    return false;
}

function addSubscriber($email){
     $con = Configuration::dbConnect();
     $date = date("Y-m-d H:i:s");
        $result = mysqli_query($con, "SELECT "
                                    . " subscriber.id AS id,  "
                                    . " subscriber.state AS state  "
                                    . " FROM subscriber "
                                    . " WHERE subscriber.email = '$email' " 
                ) or die(mysqli_error($con));
        $subscriberid = $result->fetch_object();
        if(empty($subscriberid->id))
        {
            $result = mysqli_query($con, "INSERT INTO subscriber "
                                    . " SET subscriber.email = '$email', subscriber.state = '1', date_subscribed = '$date' "
                ) or die(mysqli_error($con));
            return mysqli_insert_id($con); 
        }else{
            if($subscriberid->state == 0){
                $result = mysqli_query($con, "UPDATE subscriber "
                                    . " SET subscriber.state = '1', date_subscribed = '$date'  WHERE id = '$subscriberid->id'"
                ) or die(mysqli_error($con));
            }
            return $subscriberid->id;
        }
        Configuration::dbDisconnect($con);    
}

function printSubscribers(){
     $con = Configuration::dbConnect();
        $query = mysqli_query($con, "SELECT "
                                    . " subscriber.id AS id,  "
                                    . " subscriber.email AS email, "
                                    . " subscriber.state AS state, "
                                    . " subscriber.date_subscribed AS dSubscribed, "
                                    . " subscriber.date_suspended AS dSuspended, "
                                    . " COUNT(*) AS mailsSent"
                                    . " FROM subscriber "
                                    . " LEFT JOIN subscriber_category_xref ON subscriber_category_xref.subscriber_id=subscriber.id "
                                    . " GROUP BY subscriber.id"
                                    . " ORDER BY subscriber.id ASC" 
                ) or die(mysqli_error($con));
        echo '<div class="table-responsive">'
             . '<table class="table">'
             . '<thead><tr>'
             . '<th>ID</th><th>EMAIL</th><th>STATE</th><th>DATE SUBSCRIBED</th><th>DATE SUSPENDED</th><th>LETTERS SENT</th><th>CATEGORIES</th>'
             . '<tr></thead>'
             ;
        while ($result = $query->fetch_object()){
            echo '<tr class="valign">'
                . '<td class="text-center valign">'
                . $result->id
                . '</td><td class="valign" >' 
                . $result->email
                . '</td><td class="text-center valign">'
                . $result->state
                . '</td><td class="text-center valign">' 
                . dateFormat($result->dSubscribed)
                . '</td><td class="text-center valign">'
                . dateFormat($result->dSuspended)
                . '</td><td class="text-center valign"><span class="badge ">' 
                . $result->mailsSent
                . '</span>'
                . '</td><td class="valign">' 
                . getCategoryListBySubscriber($result->id)
                . '</td></tr>'; 
        }
         echo '</table></div>';
       
        Configuration::dbDisconnect($con);    
}

function dateFormat($date){
    if($date == 0)
        return " - ";
    else
        return $date;
}

function getCategoryListBySubscriber($subscriberId)
{
    $con = Configuration::dbConnect();
    $categoryList = '';
    $query = mysqli_query($con, "SELECT category.name "
                       . " FROM subscriber_category_xref "
                       . " LEFT JOIN category ON category.id = subscriber_category_xref.category_id"
                       . " WHERE category.state = '1' "
                       . " AND subscriber_category_xref.subscriber_id = '$subscriberId' "
                       . " ORDER BY category.name ASC"
            ) or die(mysqli_error($con));
    print_r($result);
    while ($result = $query->fetch_object()){
        $categoryList .= $result->name . '<br/>';
    } 
     Configuration::dbDisconnect($con);
     if(!empty($categoryList))
        return $categoryList;
     return ' - ';
}
function printNewsletters(){
     $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " newsletter.id AS id,  "
                                    . " newsletter.date AS date, "
                                    . " newsletter.name AS name, "
                                    . " newsletter.description AS description, "
                                    . " newsletter.body AS body, "
                                    . " newsletter.state AS state, "
                                    . " category.id AS categoryId, "
                                    . " category.name AS category "
                                    . " FROM newsletter "
                                    . " LEFT JOIN category ON category.id=newsletter.category "
                                    . " ORDER BY newsletter.date DESC "
                ) or die(mysqli_error($con));
        echo '<div class="table-responsive">'
             . '<table class="table">'
             . '<thead><tr>'
             . '<th>ID</th><th>DATE</th><th>NAME</th><th>DESCRIPTION</th><th>CATEGORY</th><th>FUNCTIONS</th><th>STATE</th><th>SENT</th><th>SUBSCRIBERS</th>'
             . '<tr></thead>'
             ;
        while ($newsletter = $result->fetch_object()) {
             echo '<tr>'
                . '<td>'
                . $newsletter->id
                . '</td><td>' 
                . $newsletter->date
                . '</td><td><span data-toggle="tooltip" title="' . $newsletter->body . '">'
                . $newsletter->name
                . '</span></td><td>'
                . $newsletter->description
                . '</td><td>'
                . $newsletter->category
                . '</td><td>'
                . '<a href="?view=edit-newsletter&id=' 
                     . $newsletter->id 
                     . '" class="btn btn-warning" role="button"><span>' 
                     . 'EDIT'
                     . '</span></a>'
                . '<a href="lib/posthandler.php?sendNL=' . $newsletter->id . '" class="btn btn-danger" role="button">'
                     . 'SEND'
                     . '</a>'
                . '</td><td>'
                . Configuration::$BOOL_VISUAL[$newsletter->state]
                . '</td><td>'
                . '<span class="badge">' . getSentCount($newsletter->id, $newsletter->state) . '</span>'
                . '</td><td>'
                . '<span class="badge">' . getSubscribersCount($newsletter->categoryId) . '</span>'
                . '</td></tr>'; 
        }
        echo '</table></div>';
        Configuration::dbDisconnect($con);
}


function printCategories(){
     $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " category.id AS id,  "
                                    . " category.name AS name, "
                                    . " category.state AS state "
                                    . " FROM category "
                                    . " ORDER BY name ASC "
                ) or die(mysqli_error($con));
        echo '<div class="table-responsive">'
             . '<table class="table">'
             . '<thead><tr>'
             . '<th>ID</th><th>NAME</th><th>FUNCTIONS</th><th>STATE</th><th>SUBSCRIBERS</th>'
             . '<tr></thead>'
             ;
        while ($category = $result->fetch_object()) {
             echo '<tr>'
                . '<td>'
                . $category->id
                . '</td><td><span>'
                . $category->name
                . '</span></td><td>'
                . '<a href="?view=edit-category&id=' 
                     . $category->id 
                     . '"><span>' 
                     . 'EDIT'
                     . '</span></a>'
                . '</td><td>'
                . Configuration::$BOOL_VISUAL[$category->state]
                . '</td><td>'
                . getSubscribersCount($category->id)
                . '</td></tr>'; 
        }
        echo '</table></div>';
        Configuration::dbDisconnect($con);
}

function printAlertType(){
    switch($_GET['alert']){
        default:
            echo "alert-info";
        break;
        case "error":
            echo "alert-danger";
        break;
        case "success":
            echo "alert-success";
        break;
    }
}

function printAlertText(){
    if(array_key_exists($_GET['msg'], Configuration::$ALERTS_ARRAY)){
            echo Configuration::$ALERTS_ARRAY[$_GET['msg']];
    }else{
        echo $_GET['msg'];
    }
}

function getSentCount($id, $state){
    if($state != 2)
        return '-';
    $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " COUNT(*) AS total  "
                                    . " FROM delivery "
                                    . " WHERE newsletter = '$id'"
                                    . " AND is_sent = '1' "
                ) or die(mysqli_error($con));
    $count = $result->fetch_object()->total;
    Configuration::dbDisconnect($con); 
    return $count;
}

function getSubscribersCount($catId){
    $count = 0;
     $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " COUNT(*) AS total  "
                                    . " FROM subscriber_category_xref "
                                    . " WHERE category_id = '$catId'"
                ) or die(mysqli_error($con));
    $count = $result->fetch_object()->total;
    Configuration::dbDisconnect($con); 
    return $count;
}

function getEmailBySecret($secret){
    $con = Configuration::dbConnect();
    $secret =  $con->real_escape_string($secret);
    $query = mysqli_query($con, "SELECT confirmation_link.email FROM confirmation_link WHERE is_used = '0' AND secret = '$secret'"
                ) or die(mysqli_error($con));
    Configuration::dbDisconnect($con);
    if(mysqli_num_rows($query) > 0){
        return $query->fetch_object()->email; 
    }
    return NULL;
}
function printNewsletterForm(){
    if(ISSET($_GET['id'])){
        if($_GET['id'] > 0){
            $con = Configuration::dbConnect();
            $result = mysqli_query($con, "SELECT * "
                                    . " FROM newsletter "
                                    . " WHERE id = '$_GET[id]'"
                ) or die(mysqli_error($con));
            $newsletter = $result->fetch_object();  
        }
    }
    echo '<div class="col-lg-2">'
        . '<form action="lib/posthandler.php" method="POST">'
        . '<div class="form-group"><label for="date">Date:</label><input type="date" class="form-control" id="date" name="date" value="' 
            . ($newsletter ? $newsletter->date : date("Y-m-d")) . '"/></div>'
        . '<div class="form-group"><label for="name">Name:</label><input type="text" class="form-control" id="name" name="name" value="'
            . ($newsletter ? $newsletter->name : "") . '"/></div>'
        . '<div class="form-group"><label for="desc">Description:</label><input type="text" class="form-control" id="desc" name="desc" value="'
            . ($newsletter ? $newsletter->description : "") . '"/></div>'
        . '<div class="form-group"><label for="cat">Category:</label>' . getCategorySelection($newsletter->category) . '</div>'
        . '<div class="form-group"><label for="body">Newsletter:</label><textarea class="form-control" rows="10" name="body" id="body" maxlength="5000">'
            . ($newsletter ? $newsletter->body : "") . '</textarea></div>'
        . '<input type="hidden" name="nlid" value="' . $_GET['id'] . '"/>'
        . '<div class="form-group"><button type="submit" class="btn btn-default" name="edit-newsletter-submit">SAVE</button></div>'
        . '</div></form>'
    ;
    
}

function printCategoryForm(){
    if(ISSET($_GET['id'])){
        if($_GET['id'] > 0){
            $con = Configuration::dbConnect();
            $result = mysqli_query($con, "SELECT * "
                                    . " FROM category "
                                    . " WHERE id = '$_GET[id]'"
                ) or die(mysqli_error($con));
            $category = $result->fetch_object();  
        }
    }
    echo '<div class="col-lg-2">'
        . '<form action="/lib/posthandler.php" method="POST">'
        . '<div class="form-group"><label for="name">Name:</label><input type="text" class="form-control" id="name" name="name" value="'
            . ($category ? $category->name : "") . '"/></div>'
        . '<input type="hidden" name="categoryId" value="' . $_GET['id'] . '"/>'
        . '<div class="form-group"><button type="submit" class="btn btn-default" name="edit-category-submit">SAVE</button></div>'
        . '</div></form></div>'
    ;
    
}

function getCategorySelection($id){
    $selection = '';
     $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT *"
                                    . " FROM category "
                                    . " ORDER BY name ASC"
                ) or die(mysqli_error($con));
    $selection =  '<select class="form-control" name="cat" id="cat">';
    while ($category = $result->fetch_object()){
        $selection .= '<option value="' . $category->id . '" ' . ($id == $category->id ? ' SELECTED ' : ''). '>' . $category->name. '</option>';
    } 
    $selection .= '</select>';
    Configuration::dbDisconnect($con); 
    return $selection;
}

function printAddNewNewsletterButton(){
    echo '<a href="?view=edit-newsletter&id=0" class="btn btn-info" role="button">'
        . 'ADD NEW'
        . '</a>';
}

function printAddNewCategoryButton(){
    echo '<a href="?view=edit-category&id=0" class="btn btn-info" role="button">'
        . 'ADD NEW'
        . '</a>';
}


function checkAdminPassword($password){
    if($password == Configuration::$ADMIN_PASSWORD)
        return true;
    return false;
}

function setLoggedon(){
    $_SESSION["logged"] = true;
}

function setLoggedoff(){
    $_SESSION["logged"] = false;
}

function checkLoginState(){
    if(ISSET($_SESSION["logged"]))
        if($_SESSION["logged"])
            return true;
        return false;
    return false;
}

function sendNewsletters($id){
    $situation = false;
    $con = Configuration::dbConnect();
    $result = mysqli_query($con, "SELECT "
                                . " delivery.id AS did, "
                                . " subscriber.email AS email, "
                                . " newsletter.description AS description, "
                                . " newsletter.body AS body "
                                . " FROM delivery "
                                . " LEFT JOIN subscriber ON delivery.subscriber=subscriber.id "
                                . " LEFT JOIN newsletter ON delivery.newsletter=newsletter.id "
                                . " WHERE delivery.newsletter = '$id'"
                                . " AND is_sent = 0"
                ) or die(mysqli_error($con)); 
    while($delivery = $result->fetch_object()){
        if(sendEmail($delivery->email, $delivery->description, $delivery->body)){
                if(markDelivery($delivery->did)){
                    $situation = true;
                }
        }    
    }
    Configuration::dbDisconnect($con); 
    if($situation)
        return true;
    return false;
}

function sendEmail($email, $subject, $body){
    $mail = new PHPMailer;
    setMailReady($mail);
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $body;
    if(!$mail->send()){
        return false;
    }else{
        return true;
    }
}

function setMailReady($mail){
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();
    $mail->Host = Configuration::$MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = Configuration::$MAIL_USERNAME;
    $mail->Password = Configuration::$MAIL_PASSWORD;
    $mail->SMTPSecure = Configuration::$MAIL_ENCRYPTION;
    $mail->Port = Configuration::$MAIL_PORT;
    $mail->isHTML(true);
    $mail->setFrom(Configuration::$MAIL_ADDRESS_FROM, Configuration::$MAIL_FROM);
    $mail->addReplyTo(Configuration::$MAIL_ADDRESS_FROM);
}

function markDelivery($id){
    $con = Configuration::dbConnect();
    $result = mysqli_query($con, "UPDATE delivery SET "
                                . " is_sent = '1', "
                                . " date_sent = '" .  date("Y-m-d H:i:s") . "' "
                                . " WHERE id = '$id'"
                ) or die(mysqli_error($con)); 
    Configuration::dbDisconnect($con); 
    if($result)
        return true;
    return false;
}

function markSecret($secret){
    $con = Configuration::dbConnect();
    $date = date ("Y-m-d H:i:s");
    $result = mysqli_query($con, "UPDATE confirmation_link SET is_used = '1', date_used = '$date' WHERE secret = '$secret'"
    ) or die(mysqli_error($con));
    Configuration::dbDisconnect($con);
    if($result)
        return true;
    return false;
}

function createNewsLetterQueue($id){
    $con = Configuration::dbConnect();
    $result = mysqli_query($con, "SELECT subscriber_category_xref.subscriber_id AS id"
                                    . " FROM subscriber_category_xref "
                                    . " LEFT JOIN newsletter ON subscriber_category_xref.category_id=newsletter.category "
                                    . " WHERE newsletter.id = '$id'"
                ) or die(mysqli_error($con)); 
    while($subscriber = $result->fetch_object()){
      $deliveryResult = mysqli_query($con, "INSERT INTO delivery "
                                    . " (is_sent, date_added, subscriber, newsletter) "
                                    . " VALUES ('0','" . date("Y-m-d H:i:s") . "', '" . $subscriber->id . "', '$id')"
                ) or die(mysqli_error($con));   
    }
    Configuration::dbDisconnect($con); 
    return true; 
}

function changeNewsLetterState($id,$state){
    $con = Configuration::dbConnect();
    $result = mysqli_query($con, "UPDATE newsletter SET "
                                    . " state = '$state' "
                                    . " WHERE id = '$id'"
                ) or die(mysqli_error($con)); 
    Configuration::dbDisconnect($con); 
    if($result)
        return true;
    return false;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}