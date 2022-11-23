<?php

DEFINE('DB_USER', 'memory'); 
DEFINE('DB_PASS', 'memory13'); 
DEFINE('DSN', 'mysql:host=localhost;dbname=memory;port=3306;charset=utf8'); 

$pdo_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
$db = new PDO(DSN, DB_USER, DB_PASS, $pdo_options);


?>