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

$idUser = $_SESSION['id'];


$user = new User();
$item = new Item();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Mes cartes</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>
        <h1>Mes cartes crées</h1>
        <section class="listItemUser">


            <?php

            $userCard = $item->getCarteByColumn($db, 'id_user', $idUser);

            for ($i = 0; $i < count($userCard); $i++) : ?>
                <div class="divListItem">
                    <p>Recto : <?php echo $userCard[$i]['recto'];  ?></p>
                    <p>Verso : <?php echo $userCard[$i]['verso']; ?></p>
                    <p>Img Recto : <br>  <img src="imgCarte/recto/<?php echo $userCard[$i]['imgRecto'];  ?>" alt=""></p>
                    <p>Img Verso : <br> <img src="imgCarte/verso/<?php echo $userCard[$i]['imgVerso'];  ?>" alt=""></p>
                    <p>Date de creation : <?php echo $userCard[$i]['date_creation'];  ?></p>
                    <p>Date de modification : <?php echo $userCard[$i]['date_modification'];  ?></p>
                    <p class="button"><a href="updateCarte.php?idCarte=<?php echo $userCard[$i]['id']; ?>&&idUser=<?php echo $userCard[$i]['id_user']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p class="button"><a class="hrefDelete" data-id="<?php echo $userCard[$i]['id']; ?>"><i class="fa-solid fa-trash"></i></a></p>
                </div>

            <?php endfor; ?>



        </section>

    </main>
    <script type="text/javascript">
        const buttonsDelete = document.querySelectorAll('.hrefDelete');


        const id = <?php echo $id; ?>

        buttonsDelete.forEach((e) => {

            e.addEventListener('click', (event) => {
                const idCarte = e.dataset.id;
                if (confirm("Voulez vous vraiment supprimer votre carte ? ") == true) {
                    window.location = 'deleteCarte.php?idCarte=' + idCarte + ''


                } else {
                    window.location = "listCarte.php?id=" + $id + "";
                }
            })
        })
    </script>

</body>

</html>