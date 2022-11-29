<?php
require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

if (empty($_GET['idCarte']) && empty($_GET['idUser']) && empty($_SESSION['id'])) {
    header('Location: index.php');
}

$idCarte = $_GET['idCarte'];

$id = $_SESSION['id'];

$user = new User();
$item = new Item();

$updateCard = $item->getCarteTheme($db, $idCarte);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Update Carte</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>
        <section class="updateItem">
            <div class="divListItem">
                Question : <?php echo $updateCard[0]['recto']; ?>
                <br>
                <br>
                imgRecto : <img src="imgCarte/recto/<?php echo $updateCard[0]['imgRecto']; ?>" alt="">
                <br>
                <br>
                Reponse : <?php echo $updateCard[0]['verso']; ?>
                <br>
                <br>
                imgVerso : <img src="imgCarte/verso/<?php echo $updateCard[0]['imgVerso']; ?>" alt="">
                <br>
                <br>
                Theme : <?php echo $updateCard[0]['nom']; ?>
            </div>

            <div id="formUpdate">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="inputContainer ic1">
                        <input type="text" name="carteRecto" id="carteRecto" class="input" placeholder=" ">
                        <div class="cut cut-short"></div>
                        <label for="carteRecto" class="placeholder">Recto :</label>
                    </div>

                    <div class="inputContainer ic1">
                        <input type="text" name="carteVerso" id="carteVerso" class="input" placeholder=" ">
                        <div class="cut cut-short"></div>
                        <label for="carteVerso" class="placeholder">Verso : </label>
                    </div>

                    <br>

                    <div>
                        <label for="imgRecto">Image Recto : </label>
                        <input type="file" name="imgRecto" id="imgRecto">
                    </div>

                    <br>

                    <div>
                        <label for="imgVerso">Image Verso : </label>
                        <input type="file" name="imgVerso" id="imgVerso">
                    </div>

                    <br>

                    <div>
                        <label for="listTheme">Theme : </label>
                        <select name="listTheme" id="listTheme">
                            <option value="">-----Theme-----</option>
                            <?php
                            $getTheme = $item->getTheme($db);


                            for ($i = 0; $i < count($getTheme); $i++) : ?>
                                <option value='<?php echo $getTheme[$i]['id']; ?>'><?php echo $getTheme[$i]['nom']; ?></option>
                            <?php
                            endfor;

                            ?>
                        </select>
                    </div>


                    <input type="submit" value="Update" name="updateCarte" class="submit">


                    <?php


                    $time = time();

                    $dateModification = date('Y-m-d');


                    $idTheme = $_POST['listTheme'];

                    $recto = $_POST['carteRecto'];
                    $verso = $_POST['carteVerso'];

                        
                    filter_input(INPUT_POST, 'recto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    filter_input(INPUT_POST, 'verso', FILTER_SANITIZE_FULL_SPECIAL_CHARS);     


                    $tailleMax = 2097152;
                    $extensionsValides = $arrayName = array('jpg', 'jpeg', 'gif', 'png');


                    if (isset($_POST['updateCarte']) && ($id == $_GET['idUser'])) {

                        if (!empty($recto)) {
                            $update = $item->updateCarte($db, $idCarte, $id, 'recto', $recto, $dateModification);
                        }

                        if (!empty($verso)) {
                            $update = $item->updateCarte($db, $idCarte, $id, 'verso', $verso, $dateModification);
                        }

                        if (!empty($idTheme)) {
                            $update = $item->updateCarte($db, $idCarte, $id, 'id_theme', $idTheme, $dateModification);
                        }

                        if (!empty($_FILES['imgRecto']['name'])) {
                            if ($_FILES['imgRecto']['size'] <= $tailleMax) {
                                $extensionsUpload = strtolower(substr(strrchr($_FILES['imgRecto']['name'], '.'), 1));
                                if (in_array($extensionsUpload, $extensionsValides)) {
                                    $chemin = "imgCarte/recto/" . $time . "." . $extensionsUpload;

                                    $deplacement = move_uploaded_file($_FILES['imgRecto']['tmp_name'], $chemin);
                                    if ($deplacement) {
                                        $imgRecto = $time . "." . $extensionsUpload;
                                        $update = $item->updateCarte($db, $idCarte, $id, 'imgRecto', $imgRecto, $dateModification);
                                    } else {
                                        echo "Erreur durant l'importation de votre image";
                                    }
                                } else {
                                    echo "Votre image recto doit être au format jpg, jpeg, gif ou png. ";
                                }
                            } else {
                                echo "Votre image recto ne doit pas dépasser 2Mo";
                            }
                        }

                        if (!empty($_FILES['imgVerso']['name'])) {
                            if ($_FILES['imgVerso']['size'] <= $tailleMax) {
                                $extensionsUpload = strtolower(substr(strrchr($_FILES['imgVerso']['name'], '.'), 1));
                                if (in_array($extensionsUpload, $extensionsValides)) {
                                    $chemin = "imgCarte/verso/" . $time . "." . $extensionsUpload;

                                    $deplacement = move_uploaded_file($_FILES['imgVerso']['tmp_name'], $chemin);
                                    if ($deplacement) {
                                        $imgVerso = $time . "." . $extensionsUpload;
                                        $update = $item->updateCarte($db, $idCarte, $id, 'imgVerso', $imgVerso, $dateModification);
                                    } else {
                                        echo "Erreur durant l'importation de votre image";
                                    }
                                } else {
                                    echo "Votre image verso doit être au format jpg, jpeg, gif ou png. ";
                                }
                            } else {
                                echo "Votre image verso ne doit pas dépasser 2Mo";
                            }
                        }


                        header('Location: listCarte.php?id='.$id.'');

                    }



                    ?>
                </form>
            </div>

        </section>


    </main>

</body>

</html>