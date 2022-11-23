<?php

// Déconnecte l'utilisateur : 
if(session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}
// supprime les variables de sessions
session_unset(); 
// détruit la session 
session_destroy();
// indique au navigateur qu'il faut supprimer le cookie de session
setcookie(session_name(), '', strtotime('-1 day'));
header('Location: index.php');


?>