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
    <link rel="stylesheet" href="css/main.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
 
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">NEWSLETTERER</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="?view=newsletter-list">Newsletters</a></li>
      <li><a href="#" onclick="showSignupForm()">SIGN UP</a></li>
      <li><a href="#" onclick="showAdminForm()">ADMIN</a></li>
    </ul>
  </div>
</nav>
    <?php 
    switch ($_GET['view']):
        case 'newsletter-list':
            ?>
            <div class="row">
                    <?php printAllNewsletters();?>
            </div>
    
            <?php
        break;
    endswitch;
    ?>
</body>
</html>