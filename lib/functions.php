<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printAllNewsletters(){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " newsletter.id AS id,  "
                                    . " newsletter.date AS date, "
                                    . " newsletter.name AS name, "
                                    . " newsletter.description AS description, "
                                    . " category.name AS category "
                                    . " FROM newsletter "
                                    . " LEFT JOIN category ON category.id=newsletter.category "
                                    . " WHERE newsletter.state = '2' " 
                                    . " AND category.state = '1' "
                ) or die(mysqli_error($con));
        while ($newsletter = $result->fetch_object()) {
            echo '<div class="col-sm-6 col-md-4">' 
                    . '<div class="thumbnail">'
                        . '<img alt="100%x200" data-src="holder.js/100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTkyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDE5MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTViMzAyMDQ4M2UgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWIzMDIwNDgzZSI+PHJlY3Qgd2lkdGg9IjE5MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI3MS41IiB5PSIxMDQuNSI+MTkyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">'
                        . '<div class="caption">'
                            . '<span>' . $newsletter->date . '<br/>' . $newsletter->category . '</span>'
                            . '<h3>' . $newsletter->name . '</h3>'
                            . '<p>' . $newsletter->description . '</p>'
                        . '</div>'
                    . '</div>'
                . '</div>'; 
        }
        Configuration::dbDisconnect($con);
}

function categoryChekboxOptions(){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " category.id AS id,  "
                                    . " category.name AS name "
                                    . " FROM category "
                                    . " WHERE category.state = '1' " 
                                    . " ORDER BY name ASC "
                ) or die(mysqli_error($con));
        while ($category = $result->fetch_object()) {
            echo '<div class="checkbox">'
                . '<label>'
                . '<input type="checkbox" name="category[]" '
                . 'value="' . $category->id . '">' 
                . $category->name
                . '</label>'
                . '</div>'; 
        }
        Configuration::dbDisconnect($con);    
}

function addSubscription($email, $categories){
    print_r($categories);
    if(!empty($subscriberId = addSubscriber($email)))
    {
        $con = Configuration::dbConnect();
        foreach($categories as $category){
            mysqli_query($con, "INSERT INTO subscriber_category_xref "
                                    . " SET subscriber_category_xref.subscriber_id = '$subscriberId',  "
                                    . " subscriber_category_xref.category_id = '$category'" 
                ) or die(mysqli_error($con)); 
        }
        Configuration::dbDisconnect($con); 
        return true;
    }
    Configuration::dbDisconnect($con); 
    return false;
}


function addSubscriber($email){
     $con = Configuration::dbConnect();
        $result = mysqli_query($con, "SELECT "
                                    . " subscriber.id AS id  "
                                    . " FROM subscriber "
                                    . " WHERE subscriber.email = '$email' " 
                ) or die(mysqli_error($con));
        $subscriberid = $result->fetch_object();
        if(empty($subscriberid->id))
        {
            $result = mysqli_query($con, "INSERT INTO subscriber "
                                    . " SET subscriber.email = '$email', subscriber.state = '1' "
                ) or die(mysqli_error($con));
            return mysqli_insert_id($con); 
        }else{
            return $subscriberid->id;
        }
        Configuration::dbDisconnect($con);    
}

function printSubscribers(){
     $con = Configuration::dbConnect();
        $query = mysqli_query($con, "SELECT "
                                    . " subscriber.id AS id,  "
                                    . " subscriber.email AS email, "
                                    . " subscriber.state AS state "
                                    . " FROM subscriber "
                                    . " ORDER BY id " 
                ) or die(mysqli_error($con));
        echo '<div class="table-responsive">'
             . '<table class="table">'
             . '<thead><tr>'
             . '<th>ID</th><th>EMAIL</th><th>STATE</th>'
             . '<tr></thead>'
             ;
        while ($result = $query->fetch_object()){
            echo '<tr>'
                . '<td>'
                . $result->id
                . '</td><td>' 
                . $result->email
                . '</td><td>'
                . $result->state
                . '</td></tr>'; 
        }
         echo '</table></div>';
       
        Configuration::dbDisconnect($con);    
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
                                    . " ORDER BY date DESC "
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
                     . '"><span>' 
                     . 'EDIT'
                     . '</span></a>'
                . '<form action="lib/posthandler.php" method="POST"><button class="button" type="submit" name="sendNL" value="' . $newsletter->id . '"><span>'
                     . 'SEND'
                     . '</span></button></form>'
                . '</td><td>'
                . Configuration::$BOOL_VISUAL[$newsletter->state]
                . '</td><td>'
                . getSentCount($newsletter->id, $newsletter->state)
                . '</td><td>'
                . getSubscribersCount($newsletter->categoryId)
                . '</td></tr>'; 
        }
        echo '</table></div>';
        Configuration::dbDisconnect($con);
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
        . '<form action="/lib/posthandler.php" method="POST">'
        . '<div class="form-group"><label for="date">Date:</label><input type="date" class="form-control" id="date" name="date" value="' 
            . ($newsletter ? $newsletter->date : date("Y-m-d")) . '"/></div>'
        . '<div class="form-group"><label for="name">Name:</label><input type="text" class="form-control" id="name" name="name" value="'
            . ($newsletter ? $newsletter->name : "") . '"/></div>'
        . '<div class="form-group"><label for="desc">Description:</label><input type="text" class="form-control" id="desc" name="desc" value="'
            . ($newsletter ? $newsletter->description : "") . '"/></div>'
        . '<div class="form-group"><label for="cat">Category:</label>' . getCategorySelection($newsletter->category) . '</div>'
        . '<div class="form-group"><label for="body">Newsletter:</label><textarea class="form-control" rows="10" name="body" id="body">'
            . ($newsletter ? $newsletter->body : "") . '</textarea></div>'
        . '<input type="hidden" name="nlid" value="' . $_GET['id'] . '"/>'
        . '<div class="form-group"><button type="submit" class="btn btn-default" name="edit-newsletter-submit">SAVE</button></div>'
        . '</div></form>'
    ;
    
}
function updateNewsletterInDB($nlid,$date,$name,$desc,$cat,$body){
        $con = Configuration::dbConnect();
        $result = mysqli_query($con, "UPDATE newsletter SET"
                                    . " date = '$date', "
                                    . " name = '$name', "
                                    . " description = '$desc', "
                                    . " category = '$cat', "
                                    . " body = '$body' "
                                    . " WHERE id= '$nlid'"
                );
    Configuration::dbDisconnect($con); 
    if($result == true)
        return true;
    return false;
}
function insertNewsletterToDB($date,$name,$desc,$cat,$body){
    $con = Configuration::dbConnect();
    $result = mysqli_query($con, "INSERT INTO newsletter  "
                                    . " (date,name,description,category,body,state)  "
                                    . " VALUES ('$date','$name','$desc','$cat','$body','3')"
                );
    Configuration::dbDisconnect($con); 
    if($result == true)
        return true;
    return false;
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
    echo '<a href="?view=edit-newsletter&id=0">'
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
    //SEND EMAIL
    return true;
}

function markDelivery($id){
    $con = Configuration::dbConnect();
    $result = mysqli_query($con, "UPDATE delivery SET "
                                . " is_sent = '1', "
                                . " date_sent = '" .  date("Y-m-d H:i:s") . "' "
                                . " WHERE id = '$id'"
                ) or die(mysqli_error($con)); 
    Configuration::dbDisconnect($con); 
    echo $result;
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