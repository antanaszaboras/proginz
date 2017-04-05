<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'lib/functions.php';
spl_autoload_register(function ($class_name) {
    require_once 'lib/' . $class_name . '.class.php';
});

$newsletter = new Newsletter();
$newsletter->setId(1);
$newsletter->setDate('2017-01-01');
$newsletter->setCategory(1);
$newsletter->setDescription('Newspeipis');
$newsletter->setBody("blasf anf asfabshfbhasf bhasf ");
//$newsletter->insertItemToDB();


//set variables

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Newsletters site</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
      <li onclick="showSignupForm();"> SIGN UP</li>
      <li><a href="?view=admin-site" onclick="showAdminForm()">ADMIN</a></li>
    </ul>
  </div>
</nav>
    <?php 
    switch ($_GET['view']):
        
    default:
        ?>
        <div class="row">
                    <?php printAllNewsletters();?>
        </div>
        <?php
    endswitch;
    ?>
    <div id="signup-form" class="signupform-main">
        <div class="signupform-inner">
            <h2></h2><em class="erroras" style="color:red;display:none;">Please fill all fields.</em>
            <form class="foxform" id="personaldata" method="GET">
                <div class="close-button"><span onclick="removeGuestFormOverlay();">×</span></div>
                <div><input placeholder="El. pašto adresas arba telefonas" title="El. pašto adresas arba telefonas" style="display:block;float:none;margin:0 auto 15px !important;border:1px solid #b0b0b0;color: gray;" name="email" type="text"></div>
                <div><button class="btn red" type="submit"><span>Siųsti</span><i class="fa fa-angle-right fa-lg fa-inverse"></i></button></div>
                <input type="hidden" name="location" value="zzz">        
            </form> 
        </div>  
    </div>
</body>
</html>