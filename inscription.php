<?php
if (isset($_POST['submitI'])) {
    $pseudoI = $_POST['pseudoI'];
    $emailI = $_POST['emailI'];
    $passwordI = $_POST['passwordI'];
    $confirmPassword = $_POST['confirmPasswordI'];

   



    if (!empty($pseudoI) and !empty($emailI) and !empty($passwordI) and !empty($confirmPassword) and filter_input(INPUT_POST, 'pseudoI', FILTER_SANITIZE_FULL_SPECIAL_CHARS) and filter_input(INPUT_POST, 'emailI', FILTER_VALIDATE_EMAIL)) {
        $alreadyExist = $user->alreadyExist($db, $pseudoI, $emailI);


        if ($alreadyExist['count(*)'] == 0) {

            if ($passwordI == $confirmPassword) {

                $passwordHash = password_hash($passwordI, PASSWORD_DEFAULT);

                $newUser = $user->add($db, $pseudoI, $emailI, $passwordHash);                
            } else {
                echo 'Les Mot de passes ne correspondent pas';
            }
        } else {
            echo 'PSEUDO ou Email deja existant';
        }
    } else {
        echo 'Veuillez remplir tout les champs';
    }
}
