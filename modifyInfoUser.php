<?php
if (isset($_POST['submitInfo'])) {
    

    $pseudo = $_POST['pseudo'];
    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);



    $email = $_POST['email'];
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    $getPseudo = $user->getPseudo($db, $pseudo);
    $getEmail = $user->getEmail($db, $email);
  

    if(!empty($pseudo) && ($id == $_GET['id'])){
        if($getPseudo['count(pseudo)'] == 0){
            $updatePseudo = $user->updateUser($db, $id, 'pseudo', $pseudo);
            
            $_SESSION['pseudo'] = $pseudo;
        }else{
            echo 'Pseudo déja existant';
        }
        

    }else{
        echo 'Ce n\'est pas votre compte';
    }

    if(!empty($email) && ($id == $_GET['id'])){
        if($getEmail['count(email)'] == 0){
            $updateEmail = $user->updateUser($db, $id, 'email', $email);
            $_SESSION['email'] = $email;
        }else{
            echo 'Email déja existant';
        }
        

    }else{
        echo 'Ce n\'est pas votre compte';
    }


    header('Location: profil.php?id="'.$id.'"');



   
}
