<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}


$id = $_SESSION['id'];


if (empty($id) && empty($_SESSION['id'])) {
    header('Location: index.php');
}

$user = new User();
$item = new Item();





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ajout Categorie</title>
</head>

<body>
    <?php include('header/header.php') ?>
    <main>
        <section class="formAddNew">
            <form action="" method="post">
                <div class="inputContainer ic1">


                    <input type="text" name="nameCategorie" id="nameCategorie" class="input" placeholder=" " required>
                    <div class="cut cut-short"></div>
                    <label for="nameCategorie" class="placeholder">Nom : </label>
                </div>

                <input type="submit" value="Ajouter" name="newCategorie" class="submit">
                <?php

                if (isset($_POST['newCategorie'])) {
                    $nameCategorie = $_POST['nameCategorie'];

                    if (!empty($nameCategorie) && filter_input(INPUT_POST, 'nameCategorie', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                        $sansAccent = $item->deleteAccent($nameCategorie);
                        $categorie = strtolower($sansAccent);
                        $getCategorie = $item->getCategorie($db);
                        $allName = [];


                        for ($i = 0; $i < count($getCategorie); $i++) {

                            array_push($allName, $getCategorie[$i]['nom']);
                        }


                        json_encode(array_values($allName));

                        if (in_array($categorie, $allName)) {
                            echo "Ce nom de categorie existe déja";
                        } else {
                            $addCategorie = $item->addCategorie($db, $categorie, $id);
                            header('Location: index.php?id="' . $id . '"');
                        }

                       

                    }
                }
                ?>



            </form>


        </section>

    </main>

</body>

</html>