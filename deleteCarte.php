<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}



if (empty($_GET['idCarte']) || empty($_SESSION['id'])) {
    header('Location: index.php');
}

$idCarte = $_GET['idCarte'];

$id = $_SESSION['id'];


$item = new Item();

$deleteCarte = $item->deleteTable($db, $idCarte, 'carte');



header('Location: listCarte.php?id=' . $id . '');


?>

