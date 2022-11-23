<?php
require_once('database/db_config.php');
require_once('class/user.php');
require_once('class/item.php');

if (session_status() !== PHP_SESSION_ACTIVE) { // si la session n'est pas active 
    session_start(); // on la démarre 
}

if (empty($_GET['id'])) {
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
        <section id="themeUser">
            <table class="tableListItem">
                <thead>
                    <tr>
                        <th colspan="8">Liste de themes crée</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nom </td>
                        <td>Description</td>
                        <td>Statue</td>
                        <td>Date de Creation</td>
                   
                        <td></td>
                        <td></td>
                    </tr>
                    <?php

                    $userTheme = $item->getThemeByColumn($db, 'id_user', $idUser);
                   

                    for ($i = 0; $i < count($userTheme); $i++) : ?>
                        <tr>
                            <td><?php echo $userTheme[$i]['nom'];  ?></td>
                            <td><?php echo $userTheme[$i]['description']; ?></td>
                            <?php if($userTheme[$i]['public'] == 0 ){?>
                                <td>Privé</td>
                            <?php 
                            }
                            else{
                                echo '<td>Public</td>';
                            }                           
                            ?>
                            <td><?php echo $userTheme[$i]['date_creation'];  ?></td>
                           
                            <td class="button"><a href="updateTheme.php?idTheme=<?php echo $userTheme[$i]['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>

                            <td class="button"><a id="hrefDelete"><i class="fa-solid fa-trash"></i></a></td>
                          
                            <input type=hidden id="idTheme" value=<?php echo $userTheme[$i]['id']; ?>/>
                            
                        </tr>
                    <?php endfor; ?>

                </tbody>
               


            </table>
            
        </section>

    </main>
    <script type="text/javascript">
        const buttonDelete = document.querySelector('#hrefDelete');
        const idTheme = document.querySelector('#idTheme').value;
        const id = <?php echo $id; ?>
        
        buttonDelete.addEventListener('click', () => {
            
            if (confirm("Voulez vous vraiment supprimer votre Theme ? Cela supprimera egalement les cartes presentes dans celui-ci ") == true) {
                buttonDelete.setAttribute('href', 'deleteTheme.php?idTheme=' + idTheme + '')
                
                
            } else {
                window.location = "listTheme.php?id=" + $id + "";
            }
        });
    </script>

</body>

</html>