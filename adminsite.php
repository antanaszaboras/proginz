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

if(!(checkLoginState()))
    header('Location: index.php?alert=error&msg=login-first');

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
      <a class="navbar-brand" href="#">NEWS PIGeon</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="?view=categories">Categories</a></li>
      <li><a href="?view=newsletters">Newsletters</a></li>
      <li><a href="?view=subscribers">Subscribers</a></li>
      
    </ul>
      <ul class="nav navbar-nav navbar-right">
         <li><a href="lib/posthandler.php?logout=true">LOGOUT</a></li> 
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
    case "subscribers":
        ?>
        <div class="row content">
            <?php printSubscribers(); ?>
        </div>
        <?php
    break;
    case "newsletters":
        ?>
        <div class="row content">
            <?php printAddNewNewsletterButton(); ?>
        </div>
        <div class="row content">
            <?php printNewsletters(); ?>
        </div>
        <?php
    break;
    case "categories":
        ?>
        <div class="row content">
            <?php printAddNewCategoryButton(); ?>
        </div>
        <div class="row content">
            <?php printCategories(); ?>
        </div>
        <?php
    break;
    case "edit-newsletter":
        ?>
        <div class="row content">
            <?php printNewsletterForm(); ?>
        </div>
        <?php
    break;
    case "edit-category":
        ?>
        <div class="row content">
            <?php printCategoryForm(); ?>
        </div>
        <?php
    break;
    default:
        ?>
        <div class="row content">
            <?php echo "ADMIN AREA";?>
        </div>
        <?php
    endswitch;
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
</body>
</html>