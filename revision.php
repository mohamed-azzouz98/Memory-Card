<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');
require_once('class/revision.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

if (empty($_GET['nbCarte']) || empty($_GET['nbLvl']) && empty($_SESSION['id'])) {
    header('Location: index.php');
}


$nbCarte = $_GET['nbCarte'];
$nbLvl = $_GET['nbLvl'];

$revision = new Revision();



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    
    <title>Revision Theme</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>
        <section>
          
            
           
            
        </section>
        
        
    </main>


</body>

</html>