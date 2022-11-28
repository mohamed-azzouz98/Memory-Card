<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}



if (empty($_GET['idCat']) && empty($_SESSION['id'])) {
    header('Location: index.php');
}

$idCat = $_GET['idCat'];

$id = $_SESSION['id'];


$item = new Item();

$deleteCat = $item->deleteTable($db, $idCat, $id, 'categorie');



header('Location: listCategorie.php?id=' . $id . '');


?>
