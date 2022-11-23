<?php
if (isset($_POST['submitC'])) {

    $emailC = $_POST['emailC'];
    $passwordC = $_POST['passwordC'];
    

    if (!empty($emailC) && !empty($passwordC) && filter_input(INPUT_POST, 'emailC', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL)) {
        
       
           
            $connect = $user->connect($db, $emailC);
            
            if ($connect['email']) {
               
                if (password_verify($passwordC, $connect['password'])) {
                    
                    $_SESSION = [
                        'id' => $connect['id'],
                        'pseudo' => $connect['pseudo'],
                        'email' => $connect['email'],
                        
                    ];                                 
                    
                    
                    header('Location:profil.php?id="'.$_SESSION['id'].'"');

                } else {
                    echo "Mot de passe ou mail incorrect";
                }
            } else {
                echo "Mot de passe ou mail incorrect";
            }
        
        
    }
}




?>