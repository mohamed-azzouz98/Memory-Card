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


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/showForm.js" defer></script>
    <script src="js/showModalIndex.js" defer></script>
    <title>Index</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>

        <!-- Affichage des formulaire d'inscription & connexion -->
        <?php
        if (empty($_SESSION['id'])) :
        ?>
            <h1>Veuillez vous inscrire et ensuite vous connectez</h1>
            <section id="containerIndex">

                <section class="sectionForm">
                    <button class="titleIndex" id="buttonInscription">Inscription</button>

                    <br>
                    <form action="index.php" method="post" id="inscriptionForm" enctype="multipart/form-data">
                        <div class="inputContainer ic1">


                            <input type="text" name="pseudoI" id="pseudoI" class="input" placeholder=" " required>
                            <div class="cut cut-short"></div>
                            <label for="pseudoI" class="placeholder">Pseudo : </label>
                        </div>

                        <div class="inputContainer ic1">


                            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" name="emailI" id="emailI" class="input" placeholder=" " required>
                            <div class="cut cut-short"></div>
                            <label for="emailI" class="placeholder">Email : </label>
                        </div>

                        <div class="inputContainer ic1">


                            <input type="password" name="passwordI" id="passwordI" class="input" placeholder=" " required>
                            <div class="cut cut-short2"></div>
                            <label for="passwordI" class="placeholder">Mot de passe : </label>

                        </div>

                        <div class="inputContainer ic1">


                            <input type="password" name="confirmPasswordI" id="confirmPasswordI" class="input" placeholder=" " required>
                            <div class="cut cut-short2"></div>
                            <label for="confirmPasswordI" class="placeholder">Confirmez Votre Mot de passe : </label>
                        </div>




                        <input type="submit" name="submitI" class="submit" value="Inscription">

                    </form>
                </section>

                <?php include('inscription.php'); ?>

                <section class="sectionForm">
                    <button class="titleIndex" id="buttonConnexion">Connexion</button>
                    <br>
                    <form action="index.php" method="post" id="connexionForm">

                        <div class="inputContainer ic1">


                            <input type="email" name="emailC" id="emailC" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" class="input" placeholder=" " required>
                            <div class="cut cut-short"></div>
                            <label for="emailC" class="placeholder">Email : </label>

                        </div>

                        <div class="inputContainer ic1">


                            <input type="password" name="passwordC" id="passwordC" class="input" placeholder=" " required>
                            <div class="cut cut-short2"></div>
                            <label for="passwordC" class="placeholder">Mot de passe : </label>

                        </div>


                        <input type="submit" name="submitC" class="submit" value="Connexion">

                    </form>
                </section>
                <?php include('connexion.php'); ?>
            </section>
        <?php
        endif;
        if (!empty($_SESSION['id'])) :
        ?>
            <!-- Affichage des catégorie & theme ainsi que des formulaire pour en ajouter-->
            <section id="listCatTheme">
                <h1>Liste des Catégories & Thèmes</h1>
                <br>

                <button class="buttonAdd" id="addCat"><i class="fa-solid fa-square-plus"></i> <a href="addCategorie.php">Ajouter une catégorie</a></button>
                <button class="buttonAdd" id="addTheme"><i class="fa-solid fa-square-plus"></i> <a href="addTheme.php">Ajouter un theme</a></button>
                <button class="buttonAdd" id="addTheme"><i class="fa-solid fa-square-plus"></i> <a href="addCarte.php">Ajouter une carte</a></button>

                <?php include('listItem.php') ?>
            </section>
        <?php
        endif;
        ?>






    </main>

</body>

</html>