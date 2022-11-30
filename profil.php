<?php
require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

if (empty($_GET['id']) && empty($_SESSION['id'])) {
    header('Location: index.php');
}

$id = $_SESSION['id'];

$user = new User();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Profil</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>

        <section id="dataUser">
            <section id="leftSection">

                <div class="tilte">Modifiez vos information</div>
                

                <form action="" method="post" id="modifyInfo">
                    <div class="inputContainer ic1">


                        <input type="text" name="pseudo" id="pseudo" class="input">
                        <div class="cut cut-short"></div>
                        <label for="pseudo" class="placeholder">Pseudo : </label>
                    </div>

                    <div class="inputContainer ic1">


                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" name="email" id="email" class="input">
                        <div class="cut cut-short"></div>
                        <label for="email" class="placeholder">Email : </label>
                    </div>




                    <input type="submit" name="submitInfo" class="submit" value="Update">

                </form>
                <?php 
                
                include('modifyInfoUser.php');
                
                
                ?>


                <div class="title">Modifiez votre Mot de passe</div>

                <form action="profil.php?id=<?php echo $id; ?>" method="post">
                    <div class="inputContainer ic1">


                        <input type="password" name="oldPassword" id="oldPassword" class="input" required>
                        <div class="cut cut-short2"></div>
                        <label for="oldPassword" class="placeholder">Ancien Mot de passe : </label>
                    </div>

                    <div class="inputContainer ic1">


                        <input type="password" name="newPassword" id="newPassword" class="input" required>
                        <div class="cut cut-short2"></div>
                        <label for="newPassword" class="placeholder">Nouveau Mot de passe : </label>
                    </div>

                    <div class="inputContainer ic1">


                        <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="input" required>
                        <div class="cut cut-short2"></div>
                        <label for="confirmNewPassword" class="placeholder">Confirmer Mot de passe : </label>
                    </div>

                    <input type="submit" name="submitPassword" class="submit" value="Update">

                </form>
                <?php include('modifyPassword.php'); ?>
            </section>


            <section id="rightSection">
                <div id="listData">

                    <div class="myItems"><a href="listCarte.php?id=<?php echo $id; ?>">Mes cartes</a></div>
                    <div class="myItems"><a href="listTheme.php?id=<?php echo $id; ?>">Mes Themes</a></div>
                    <div class="myItems"><a href="listCategorie.php?id=<?php echo $id; ?>">Mes Categorie</a></div>
                  
                    
                </div>

            </section>

        </section>


    </main>

</body>

</html>