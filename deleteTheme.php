<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}



if (empty($_GET['idTheme']) || empty($_SESSION['id'])) {
    header('Location: index.php');
}

$idTheme = $_GET['idTheme'];

$id = $_SESSION['id'];


$item = new Item();

$deleteCarte = $item->deleteTable($db, $idTheme, 'theme');



header('Location: listTheme.php?id=' . $id . '');


?>

