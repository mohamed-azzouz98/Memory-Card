<?php
require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

if (empty($_GET['id']) || empty($_SESSION['id'])) {
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
        <section id="userCard">
            <table class="tableListItem">
                <thead>
                    <tr>
                        <th colspan="8">Liste de cartes crée</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Question </td>
                        <td>Reponse</td>
                        <td>Img Recto</td>
                        <td>Img Verso</td>
                        <td>Date de Creation</td>
                        <td>Date de modification</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php

                    $userCard = $item->getCarte($db, 'id_user', $idUser);

                    for ($i = 0; $i < count($userCard); $i++) : ?>
                        <tr>
                            <td><?php echo $userCard[$i]['recto'];  ?></td>
                            <td><?php echo $userCard[$i]['verso']; ?></td>
                            <td><img src="imgCarte/recto/<?php echo $userCard[$i]['imgRecto'];  ?>" alt=""></td>
                            <td><img src="imgCarte/verso/<?php echo $userCard[$i]['imgVerso'];  ?>" alt=""></td>
                            <td><?php echo $userCard[$i]['date_creation'];  ?></td>
                            <td><?php echo $userCard[$i]['date_modification'];  ?></td>
                            <td class="button"><a href="updateCarte.php?idCarte=<?php echo $userCard[$i]['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>

                            <td class="button"><a id="hrefDelete"><i class="fa-solid fa-trash"></i></a></td>
                          
                            <input type=hidden id="idCarte" value=<?php echo $userCard[$i]['id']; ?>/>
                            
                        </tr>
                    <?php endfor; ?>

                </tbody>
               


            </table>
            
        </section>

    </main>
    <script type="text/javascript">
        const buttonDelete = document.querySelector('#hrefDelete');
        const idCarte = document.querySelector('#idCarte').value;
        
        const id = <?php echo $id; ?>
        
        buttonDelete.addEventListener('click', () => {
            
            if (confirm("Voulez vous vraiment supprimer votre carte ? ") == true) {
                buttonDelete.setAttribute('href', 'deleteCarte.php?idCarte=' + idCarte + '')
                
                
            } else {
                window.location = "listCarte.php?id=" + $id + "";
            }
        });
    </script>

</body>

</html>