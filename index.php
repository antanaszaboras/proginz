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
      <a class="navbar-brand" href="#">NEWS PIGoen</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="?view=newsletter-list">Newsletters</a></li>
      <li onclick="showForm('signup-form');"><a href="#">SUBSCRIBE</a></li>
      <li onclick="showForm('unsign-form');"><a href="#">UNSUBSCRIBE</a></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
           <li onclick="showForm('adminlogin-form');"><a href="#">ADMIN</a></li>
      </ul>
  </div>
</nav>
<div class="container-fluid">
    <?php if($_GET['msg']){ ?>
    <div class="alert <?php printAlertType();?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php printAlertText(); ?>
    </div>
    <?php } ?>
    <?php 
    switch ($_GET['view']):
        
    default:
        ?>
        <div class="row row-eq-height">
                    <?php printAllNewsletters();?>
        </div>
        <?php
    endswitch;
    ?>
    <div id="signup-form" class="signupform-main">
        <div class="signupform-inner">
            <div class="row top-buffer">
                <div class="col-lg-1 col-centered">
                    <form class="form" id="subscribe-form" action="lib/posthandler.php" method="POST">
                        <div class="col-lg-1 text-right top10"><span onclick="removeFormOverlay('signup-form');">×</span></div>
                        <div class="col-lg-1 col-centered top10"><input placeholder="Your E-Mail" title="Your E-Mail" name="email" type="email" required></div>
                        <div class="col-lg-1 col-centered top10"><button class="btn btn-primary" type="submit" name="subscribe-step1" ><span>SUBSCRIBE</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>   
                    </form>
                 </div>
             </div>
        </div>  
    </div>
    <div id="unsign-form" class="signupform-main">
        <div class="signupform-inner">
            <div class="row top-buffer">
                <div class="col-lg-1 col-centered">
                    <form class="form" id="unsign-form" action="lib/posthandler.php" method="POST">
                        <div class="col-lg-1 text-right top10"><span onclick="removeFormOverlay('unsign-form');">×</span></div>
                        <div class="col-lg-1 col-centered top10"><input placeholder="Your E-Mail" title="Your E-Mail" name="email" type="email"></div>
                        <div class="col-lg-1 col-centered top10"><button class="btn btn-primary" type="submit" name="unsubscribe-step1" ><span>UNSUBSCRIBE</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>   
                    </form>
                </div>
             </div>
        </div>  
    </div>
    <div id="adminlogin-form" class="signupform-main">
        <div class="signupform-inner"> 
             <div class="row">
                <div class="col-lg-1 col-centered">
                        <form class="form" id="adminlogin-form" action="lib/posthandler.php" method="POST">
                            <div class="col-lg-1 text-right top10"><span onclick="removeFormOverlay('adminlogin-form');">×</span></div>
                            <div class="col-lg-1 col-centered text-left top10"><input placeholder="Password" title="Password" name="password" type="password"></div>
                            <div class="col-lg-1 col-centered top10"><button class="btn btn-primary" type="submit" name="login" ><span>LOGIN</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>   
                        </form>
                </div>
             </div>
        </div>  
    </div>
    <?php
    if($_GET['view'] == 'confirmation'){
        switch ($_GET['confirmation']){
            case 'unsubscribe':
            ?>
            <div id="unsubscribe-form" class="signupform-main">
                <div class="signupform-inner">
                    <div class="row">
                        <div class="col-lg-1 col-centered">
                            <form class="form" id="unsubscribe-form" action="lib/posthandler.php" method="POST">
                                <div class="col-lg-1 text-right" role="button"><span onclick="removeFormOverlay('unsubscribe-form');">×</span></div>
                                <input type="hidden" name="secret" value="<?php echo $_GET['secret']; ?>"/>
                                <div class="col-lg-1 col-centered text-left"><?php categoryChekboxOptions($_GET['secret'], 'unsubscribe'); ?></div>
                                <div class="col-lg-1 col-centered"><button class="btn btn-primary" type="submit" name="unsubscribe-step2" ><span>UNSUBSCRIBE</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>   
                            </form> 
                        </div>
                    </div>
                </div>  
            </div>
            <script>showForm('unsubscribe-form')</script>
            <?php
            break;
            case 'subscribe':
            ?>
            <div id="subscribe-select-form" class="signupform-main">
                <div class="signupform-inner">
                     <div class="row">
                        <div class="col-lg-1 col-centered">
                            <form class="form" id="unsubscribe-form" action="lib/posthandler.php" method="POST">
                                <div class="col-lg-1 text-right"><span onclick="removeFormOverlay('subscribe-select-form');">×</span></div>
                                <input type="hidden" name="secret" value="<?php echo $_GET['secret']; ?>"/>
                                <div class="col-lg-1 col-centered text-left"><?php categoryChekboxOptions($_GET['secret'], 'subscribe'); ?></div>
                                <div class="col-lg-1 col-centered"><button class="btn btn-primary" type="submit" name="subscribe-step2" ><span>SUBSCRIBE</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>   
                            </form> 
                        </div>
                    </div>
                </div>  
            </div>
            <script>showForm('subscribe-select-form')</script>
            <?php
            break;
        }
    }
    ?>
</div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>