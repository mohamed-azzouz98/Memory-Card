<?php

require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}


$id_User = $_SESSION['id'];


if (empty($id_User)) {
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
    <title>Ajout de carte</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>
        <section class="formAddNew">
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
                    <select name="listTheme" id="listTheme" required>
                        <?php
                        $getTheme = $item->getTheme($db);


                        for ($i = 0; $i < count($getTheme); $i++) : ?>
                            <option value='<?php echo $getTheme[$i]['id']; ?>'><?php echo $getTheme[$i]['nom']; ?></option>
                        <?php
                        endfor;

                        ?>
                    </select>
                </div>


                <input type="submit" value="Ajouter" name="newCarte" class="submit">


                <?php


                $time = time();

                $dateCreation = date('Y-m-d');
                

                $idTheme = $_POST['listTheme'];

                $recto = $_POST['carteRecto'];
                $verso = $_POST['carteVerso'];

                filter_input(INPUT_POST, 'recto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                filter_input(INPUT_POST, 'verso', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                



                if (isset($_POST['newCarte'])) 
                {
                    $tailleMax = 2097152;
                    $extensionsValides = $arrayName = array('jpg', 'jpeg', 'gif', 'png');
                    
                    
                    if ($_FILES['imgRecto']['size'] < $tailleMax) {
                        echo $_FILES['imgRecto']['size'];
                        $extensionsUpload = strtolower(substr(strrchr($_FILES['imgRecto']['name'], '.'), 1));
                        if (in_array($extensionsUpload, $extensionsValides)) {
                            $chemin = "imgCarte/recto/" . $time . "." . $extensionsUpload;
                            
                            $deplacement = move_uploaded_file($_FILES['imgRecto']['tmp_name'], $chemin);
                            if ($deplacement) {
                                $imgRecto = $time . "." . $extensionsUpload;
                                $flagRecto = '1';
                                
                            } else {
                                
                                echo "Erreur durant l'importation de votre image Recto<br>";
                            }
                        } else {
                            echo "Votre image recto doit être au format jpg, jpeg, gif ou png.<br> ";
                        }
                    } else {
                        echo "Votre image recto ne doit pas dépasser 2Mo<br>";
                    }

                    if ($_FILES['imgVerso']['size'] < $tailleMax) {
                        $extensionsUpload = strtolower(substr(strrchr($_FILES['imgVerso']['name'], '.'), 1));
                        if (in_array($extensionsUpload, $extensionsValides)) {
                            $chemin = "imgCarte/verso/" . $time . "." . $extensionsUpload;

                            $deplacement = move_uploaded_file($_FILES['imgVerso']['tmp_name'], $chemin);
                            if ($deplacement) {
                                $imgVerso = $time . "." . $extensionsUpload;
                                $flagVerso = '1';


                                
                            } else {
                               
                                echo "Erreur durant l'importation de votre image verso<br>";
                            }
                        } else {
                            echo "Votre image verso doit être au format jpg, jpeg, gif ou png.<br> ";
                        }
                    } else {
                        echo "Votre image verso ne doit pas dépasser 2Mo<br>";
                    }

                    if($flagRecto == 1 && $flagVerso == 1){
                        $newCarte = $item->addCarte($db, $id_User, $idTheme, $recto, $verso, $imgRecto, $imgVerso, $dateCreation, $dateCreation);
                        header('Location: index.php');
                    }
                    
                    
                }



                ?>
            </form>
        </section>


    </main>

</body>

</html>