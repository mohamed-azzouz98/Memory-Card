<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

$user = new User();
$item = new Item();


$id = $_SESSION['id'];

if (empty($id) && empty($_SESSION['id'])) {
    header('Location: index.php');
}


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


                    <input type="text" name="nameTheme" id="nameTheme" class="input" placeholder=" " required>
                    <div class="cut cut-short"></div>
                    <label for="nameTheme" class="placeholder">Nom : </label>
                </div>

                <div class="inputContainer ic1">


                    <input type="text" name="descTheme" id="descTheme" class="input" placeholder=" ">
                    <div class="cut cut-short"></div>
                    <label for="descTheme" class="placeholder">Description : </label>
                </div>

                <br>

                <div class="selecItem">
                    <label for="listCat">Categorie : </label>
                    <select name="listCat" id="listCat" required>
                        <?php
                        $getCategorie = $item->getCategorie($db);


                        for ($i = 0; $i < count($getCategorie); $i++) : ?>
                            <option value='<?php echo $getCategorie[$i]['id']; ?>'><?php echo $getCategorie[$i]['nom']; ?></option>
                        <?php
                        endfor;

                        ?>
                    </select>
                </div>

                <br>

                <div>
                    <label for="publicTheme">Public ? : </label>
                    <input type="checkbox" name="publicTheme" id="publicTheme">
                </div>

                <input type="submit" value="Ajouter" name="newTheme" class="submit">
                <?php
                if (isset($_POST['newTheme'])) {
                    $nameTheme = $_POST['nameTheme'];
                    $descTheme = $_POST['descTheme'];
                    $idCategorie = $_POST['listCat'];

                    if (isset($_POST['publicTheme'])) {
                        $public = 1;
                    } else {
                        $public = 0;
                    }

                    $dateCreation = date('Y-m-d');



                    if (!empty($nameTheme) && filter_input(INPUT_POST, 'nameTheme', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {

                        $sansAccent = $item->deleteAccent($nameTheme);
                        $theme = strtolower($sansAccent);
                        $getTheme = $item->getTheme($db);
                        $allName = [];


                        for ($i = 0; $i < count($getTheme); $i++) {

                            array_push($allName, $getTheme[$i]['nom']);
                        }


                        json_encode(array_values($allName));


                        if (in_array($theme, $allName)) {
                            echo "<div class='error'>Ce nom de theme existe déja</div>";
                        } else {
                            $addTheme = $item->addTheme($db, $id, $idCategorie, $theme, $descTheme, $public, $dateCreation);

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