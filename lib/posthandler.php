<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach ($_POST as $key => $value){
    echo $key . ' - ' . $value . ' <br/>';
}

require_once '../lib/functions.php';
spl_autoload_register(function ($class_name) {
    require_once '../lib/' . $class_name . '.class.php';
});

if(isset($_POST['subscribe-step1'])){
    if(isset($_POST['email'])){
        if(confirmSubscription($_POST['email'])){
            header('Location: ../index.php?alert=success&msg=successful-subscription-email');
        }
        else{
            header('Location: ../index.php?alert=error&msg=failed-subscribtion-email'); 
        }
    }
}

if(isset($_POST['subscribe-step2'])){
    if(isset($_POST['category'])){
        if(addSubscription($_POST['secret'], $_POST['category'])){
            header('Location: ../index.php?alert=success&msg=successful-subscription');
        }
        else{
            header('Location: ../index.php?alert=error&msg=failed-subscribtion'); 
        }
    }else{
        header('Location: ../index.php?alert=error&msg=no-categories-selected');
    }
}

if(isset($_POST['unsubscribe-step1'])){
    if(isset($_POST['email'])){
        if(confirmSubscriptionRemoval($_POST['email'])){
            header('Location: ../index.php?alert=success&msg=unsubscribe-letter');
        }
        else{
            header('Location: ../index.php?alert=error&msg=failed-unsubscribe'); 
        }
    }
}

if(isset($_POST['unsubscribe-step2'])){
    if(isset($_POST['category'])){
        if(removeSubscription($_POST['category'], $_POST['secret'])){
            header('Location: ../index.php?alert=success&msg=unsubscribe-succseful');
        }
        else{
            header('Location: ../index.php?alert=error&msg=failed-unsubscribe'); 
        }
    }
}

if(isset($_POST['login'])){
    if(isset($_POST['password'])){
        if(checkAdminPassword($_POST['password'])){
            setLoggedon();
            header('Location: ../adminsite.php?view=newsletters');
        }else{
            header('Location: ../index.php?alert=error&msg=bad-password');
        }
    }
}

if(isset($_POST['edit-newsletter-submit'])){
    $newsletter = new Newsletter(array('date' => $_POST['date'],'name' => $_POST['name'],'description' => $_POST['desc'],'category' => $_POST['cat'],'body' => $_POST['body']));
    if($_POST['nlid'] > 0){
        if($newsletter->updateInDB($_POST['nlid'])){
            header('Location: ../adminsite.php?view=newsletters&alert=success&msg=success-updating-newsletter');
        }else{
            echo '<script type="text/javascript">alert("KLAIDA !"); history.go(-1)</script>';
        }
        
    }
    if($_POST['nlid'] == 0){
        if($newsletter->AddToDB()){
            header('Location: ../adminsite.php?view=newsletters&alert=success&msg=success-inserting-newsletter');
        }else{
           echo '<script type="text/javascript">alert("KLAIDA !"); history.go(-1)</script>';
        }
    }
}

if(isset($_POST['edit-category-submit'])){
    $category = new Category(array('name' => $_POST['name']));
    if($_POST['categoryId'] > 0){
        if($category->updateInDB($_POST['categoryId'])){
            header('Location: ../adminsite.php?view=categories&alert=success&msg=success-updating-category');
        }else{
            echo '<script type="text/javascript">alert("KLAIDA !"); history.go(-1)</script>';
        }
        
    }
    if($_POST['categoryId'] == 0){
        if($category->AddToDB()){
            header('Location: ../adminsite.php?view=categories&alert=success&msg=success-inserting-category');
        }else{
           echo '<script type="text/javascript">alert("KLAIDA !"); history.go(-1)</script>';
        }
    }
}

if(isset($_GET['sendNL'])){
    createNewsLetterQueue($_GET['sendNL']);
    if(sendNewsLetters($_GET['sendNL'])){
        changeNewsLetterState($_GET['sendNL'],'2');
        header('Location: ../adminsite.php?view=newsletters&alert=success&msg=success-sending-newsletter');
    }else{
        header('Location: ../adminsite.php?view=newsletters&alert=error&msg=error-sending-newsletter');
    }
    
}

if(isset($_GET['logout'])){
    setLoggedoff();
    header('Location: ../index.php?msg=logged-off');
}