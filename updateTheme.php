<?php
require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

if (empty($_GET['idTheme']) && empty($_GET['idUser']) && empty($_SESSION['id'])) {
    header('Location: index.php');
}

$idTheme = $_GET['idTheme'];
$id = $_SESSION['id'];

$user = new User();
$item = new Item();

$updateTheme = $item->getThemeCategorie($db, $idTheme);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Update Theme</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>
        <section class="updateItem">
            <div class="divListItem">
                Categorie : <?php echo $updateTheme[0]['nomCategorie']; ?>
                <br>
                <br>
                Nom: <?php echo $updateTheme[0]['nomTheme']; ?>
                <br>
                <br>
                Description : <?php echo $updateTheme[0]['description']; ?>
                <br>
                <br>
                Statut :
                <?php
                if ($updateTheme[0]['public'] == 0) {
                    echo 'Prive';
                } else {
                    echo 'Public';
                }
                ?>

            </div>

            <div>
                <form action="" method="post">
                    <div class="inputContainer ic1">


                        <input type="text" name="nameTheme" id="nameTheme" class="input" placeholder=" ">
                        <div class="cut cut-short"></div>
                        <label for="nameTheme" class="placeholder">Nom : </label>
                    </div>

                    <div class="inputContainer ic1">


                        <input type="text" name="descTheme" id="descTheme" class="input" placeholder=" ">
                        <div class="cut cut-short"></div>
                        <label for="descTheme" class="placeholder">Description : </label>
                    </div>

                    <br>

                    <div class="selectItem">
                        <label for="listCat">Categorie : </label>
                        <select name="listCat" id="listCat">
                            <option value="">---Categorie---</option>
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
                        <?php if ($updateTheme[0]['public'] == 0) : ?>
                            <input type="checkbox" name="publicTheme" id="publicTheme">
                        <?php endif;
                        if ($updateTheme[0]['public'] == 1) : ?>
                            <input type="checkbox" name="publicTheme" id="publicTheme" checked>
                        <?php endif; ?>
                    </div>

                    <input type="submit" value="Update" name="updateTheme" class="submit">
                    <?php

                    $idCategorie = $_POST['listCat'];
                    $public = $_POST['publicTheme'];
                    $nom = $_POST['nameTheme'];
                    $desc = $_POST['descTheme'];

                    $showError = 0;


                    filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);



                    if (isset($_POST['updateTheme']) && ($id == $_GET['idUser'])) {



                        if (!empty($nom)) {
                            $sansAccent = $item->deleteAccent($nom);
                            $theme = strtolower($sansAccent);
                            $getTheme = $item->getTheme($db);
                            $allName = [];


                            for ($i = 0; $i < count($getTheme); $i++) {

                                array_push($allName, $getTheme[$i]['nom']);
                            }


                            json_encode(array_values($allName));


                            if (in_array($theme, $allName)) {
                                echo "<div class='error'>Ce nom de theme existe déja</div>";
                                $showError++;
                            } else {
                                $update = $item->updateTheme($db, $idTheme, $id, 'nom', $nom);
                            }
                        }

                        if (!empty($desc)) {
                            $update = $item->updateTheme($db, $idTheme, $id, 'description', $desc);
                        }

                        if (isset($public)) {
                            $public = 1;
                            $update = $item->updateTheme($db, $idTheme, $id, 'public', $public);
                        } else {
                            $public = 0;
                            $update = $item->updateTheme($db, $idTheme, $id, 'public', $public);
                        }

                        if (!empty($idCategorie)) {
                            $update = $item->updateTheme($db, $idTheme, $id, 'id_categorie', $idCategorie);
                        }


                        if($showError == 0){
                            header('Location: listTheme.php?id=' . $id . '');
                        }
                        
                    }
                    ?>
                </form>

            </div>

        </section>
    </main>

</body>

</html>