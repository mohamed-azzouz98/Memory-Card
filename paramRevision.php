<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');
require_once('class/revision.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

if (empty($_GET['idUser']) || empty($_GET['idTheme']) || empty($_SESSION['id'])) {
    header('Location: index.php');
}


$idUser = $_GET['idUser'];
$idTheme = $_GET['idTheme'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Parametre revision</title>
</head>
<body>
    <?php include('header/header.php'); ?>
    <main>
    <section id="paramRevision">
            <form action="" method="post" id="formParam">
                <div class="slider">
                    <p>NB CARTE :</p>
                    <input type="range" name="nbCarte" min="1" max="10" value="0" oninput="carteValue.innerText = this.value">
                    <p id="carteValue">1</p>
                </div>

                <br>
                <div class="slider">
                    <p>NB LVL :</p>
                    <input type="range" name="nbLvl" min="1" max="7" value="0" oninput="lvlValue.innerText = this.value">
                    <p id="lvlValue">1</p>
                </div>
                <br>

                <input type="submit" id="begin" name="beginRevision" value="Commencer">

            </form>

            <?php 
            
            if(isset($_POST['beginRevision'])){
                $nbCarte = $_POST['nbCarte'];
                $nbLvl = $_POST['nbLvl'];
                header('Location: revision.php?nbCarte='.$nbCarte.'&&nbLvl='.$nbLvl.'');
            }
            ?>


        </section>
    </main>
    
</body>
</html>