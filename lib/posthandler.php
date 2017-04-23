<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
foreach ($_POST as $key => $value){
    echo $key . ' - ' . $value . ' <br/>';
}
*/
require_once '../lib/functions.php';
spl_autoload_register(function ($class_name) {
    require_once '../lib/' . $class_name . '.class.php';
});

if(isset($_POST['subscribe'])){
    if(isset($_POST['email']) && isset($_POST['category'])){
        if(addSubscription($_POST['email'], $_POST['category'])){
            header('Location: ../index.php?msg=successful-subscription');
        }
    }
}

if(isset($_POST['login'])){
    if(isset($_POST['password'])){
        if(checkAdminPassword($_POST['password'])){
            setLoggedon();
            header('Location: ../adminsite.php');
        }else{
            header('Location: ../index.php?msg=bad-password');
        }
    }
}

if(isset($_POST['edit-newsletter-submit'])){
    if($_POST['nlid'] > 0){
        if(updateNewsletterInDB($_POST['nlid'],$_POST['date'],$_POST['name'],$_POST['desc'],$_POST['cat'],$_POST['body'])){
            header('Location: ../adminsite.php?view=newsletters&msg=success-updating-newsletter');
        }else{
            echo '<script type="text/javascript">alert("KLAIDA !"); history.go(-1)</script>';
        }
        
    }
    if($_POST['nlid'] == 0){
        if(insertNewsletterToDB($_POST['date'],$_POST['name'],$_POST['desc'],$_POST['cat'],$_POST['body'])){
            header('Location: ../adminsite.php?view=newsletters&msg=success-inserting-newsletter');
        }else{
            echo '<script type="text/javascript">alert("KLAIDA !"); history.go(-1)</script>';
        }
    }
}

if(isset($_POST['sendNL'])){
    createNewsLetterQueue($_POST['sendNL']);
    if(sendNewsLetters($_POST['sendNL'])){
        changeNewsLetterState($_POST['sendNL'],'2');
        header('Location: ../adminsite.php?view=newsletters&msg=success-sending-newsletter');
    }else{
        header('Location: ../adminsite.php?view=newsletters&msg=error-sending-newsletter');
    }
    
}

if(isset($_POST['logout'])){
    setLoggedoff();
    header('Location: ../index.php?msg=logged-off');
}