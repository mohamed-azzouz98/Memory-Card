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
    <title>Mes Categorie</title>
</head>

<body>
    <?php include('header/header.php'); ?>
    <main>
        <h1>Mes catégories crées</h1>
        <section class="listItemUser"">
            
                    <?php

                    $userCat = $item->myCategorie($db, $idUser, 'id_user');

                    for ($i = 0; $i < count($userCat); $i++) : ?>
                       <div class="divListItem">
                        <p>Nom : <?php echo $userCat[$i]['nom'];  ?></p>
                        <p><a href="updateCategorie.php?idCat=<?php echo $userCat[$i]['id']; ?>&&idUser=<?php echo $userCat[$i]['id_user']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></p>
                        <p><a class="hrefDelete" data-id="<?php echo $userCat[$i]['id']; ?>"><i class="fa-solid fa-trash"></i></a></p>

                       </div>
                            <td></td>
                           
                            <td class="button"></td>

                            <td class="button"></td>
                          
                            <input type=hidden id="idCarte" value=<?php echo $userCat[$i]['id']; ?>/>
                            
                        </tr>
                    <?php endfor; ?>

                </tbody>
               


            </table>
            
        </section>

    </main>
    <script type="text/javascript">
        const buttonsDelete = document.querySelectorAll('.hrefDelete');
        
        
        const id = <?php echo $id; ?>
        
        buttonsDelete.forEach((e)=> {

            e.addEventListener('click', (event) => {
            const idCarte = e.dataset.id;
            if (confirm("Voulez vous vraiment supprimer votre categorie ? ") == true) {
                window.location = 'deleteCategorie.php?idCat=' + idCarte + ''
                
                
            } else {
                window.location = "listCategorie.php?id=" + $id + "";
            }
        })
    })
    </script>

</body>

</html>