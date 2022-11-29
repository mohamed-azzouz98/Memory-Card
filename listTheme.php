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
    <title>Mes Themes</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>
        <h1>Mes themes crées</h1>
        <section class="listItemUser">

            <?php

            $userTheme = $item->getThemeByColumn($db, 'id_user', $idUser);


            for ($i = 0; $i < count($userTheme); $i++) : ?>
                <div class="divListItem">
                    <p>Nom : <?php echo $userTheme[$i]['nom'];  ?></p>
                    <p>Description : <?php echo $userTheme[$i]['description']; ?></p>
                    <p>Statut : <?php if ($userTheme[$i]['public'] == 0) { ?>
                            Privé
                        <?php
                                } else {
                                    echo 'Public';
                                }
                        ?></p>
                    <p>Date De creation : <?php echo $userTheme[$i]['date_creation'];  ?> </p>
                    <p class="button"><a href="updateTheme.php?idTheme=<?php echo $userTheme[$i]['id']; ?>&&idUser=<?php echo $userTheme[$i]['id_user']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></p>
                    <p class="button"><a class="hrefDelete" data-id="<?php echo $userTheme[$i]['id']; ?>"><i class="fa-solid fa-trash"></i></a></p>
                </div>

            <?php endfor; ?>



        </section>

    </main>
    <script type="text/javascript">
        const buttonsDelete = document.querySelectorAll('.hrefDelete');


        const id = <?php echo $id; ?>

        buttonsDelete.forEach((e) => {

            e.addEventListener('click', (event) => {
                const idTheme = e.dataset.id;
                if (confirm("Voulez vous vraiment supprimer votre theme ? ") == true) {
                    window.location = 'deleteTheme.php?idTheme=' + idTheme + ''


                } else {
                    window.location = "listTheme.php?id=" + $id + "";
                }
            })
        })
    </script>

</body>

</html>