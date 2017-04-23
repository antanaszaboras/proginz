<?php
session_start();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'lib/functions.php';
spl_autoload_register(function ($class_name) {
    require_once 'lib/' . $class_name . '.class.php';
});
/*
$newsletter = new Newsletter(array("name"=>"Kodėlčiukas"));
$newsletter->printItem();
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Newsletters site</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="scripts/functions.js"></script>
</head>
 
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">NEWSLETTERER</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="?view=newsletter-list">Newsletters</a></li>
      <li class="button" onclick="showSignupForm();"><a>SUBSCRIBE</a></li>
      <li class="button" onclick="showAdminLogin();"><a>ADMIN</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid">
    <?php 
    switch ($_GET['view']):
        
    default:
        ?>
        <div class="row content"
                    <?php printAllNewsletters();?>
        </div>
        <?php
    endswitch;
    ?>
    <div id="signup-form" class="signupform-main">
        <div class="signupform-inner">
            <form class="form" id="subscribe-form" action="lib/posthandler.php" method="POST">
                <div class="close-button"><span onclick="removeGuestFormOverlay();">×</span></div>
                <div><input placeholder="Your E-Mail" title="Your E-Mail" name="email" type="email"></div>
                <div><?php categoryChekboxOptions(); ?></div>
                <div><button class="btn btn-primary" type="submit" name="subscribe" ><span>Send</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>   
            </form> 
        </div>  
    </div>
    <div id="adminlogin-form" class="signupform-main">
        <div class="signupform-inner"> 
            <form class="form" id="adminlogin-form" action="lib/posthandler.php" method="POST">
                <div class="close-button"><span onclick="removeLoginFormOverlay();">×</span></div>
                <div><input placeholder="Password" title="Password" name="password" type="password"></div>
                <div><button class="btn btn-primary" type="submit" name="login" ><span>Login</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>   
            </form> 
        </div>  
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>