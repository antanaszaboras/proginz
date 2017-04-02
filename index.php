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
$newsletter->insertItemToDB();


//set variables

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Newsletters site</title>
    <link rel="stylesheet" href="css/main.css" type="text/css" />
</head>
 
<body>
    <?php 
    switch ($_GET['view']):
        case 'newsletter-list':
           printAllNewsletters();
        break;
    endswitch;
    ?>
</body>
</html>