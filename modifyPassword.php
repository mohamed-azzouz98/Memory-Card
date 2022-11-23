<?php 

if (isset($_POST['submitPassword'])) {

    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirm = $_POST['confirmNewPassword'];

    if(!empty($oldPassword) && !empty($newPassword) && !empty($confirm)){
        $getPassword = $user->getPassword($db, $id);
        var_dump($getPassword);
        if (password_verify($oldPassword, $getPassword['password'])) {
            if($newPassword == $confirm){
                $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $update = $user->updatePassword($db, $id, $passwordHash);
            }else{
                echo 'Les Mots de passe ne correspondent pas ';
            }
        }else{
            echo 'Mauvais ancien mot de passe';
        }
    }


}


?>