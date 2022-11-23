<?php

class User {
    


    public function getPseudo($db, $pseudo){
        $requeteSQL = "SELECT count(pseudo) FROM user WHERE pseudo = :pseudo";
        $requetePreparee =$db->prepare($requeteSQL);

        $requetePreparee->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);

        $requetePreparee->execute();
        return $requetePreparee->fetch(PDO::FETCH_ASSOC);
    }

    public function getEmail($db, $email){
        $requeteSQL = "SELECT count(email) FROM user WHERE email = :email";
        $requetePreparee =$db->prepare($requeteSQL);

        $requetePreparee->bindParam(":email", $email, PDO::PARAM_STR);

        $requetePreparee->execute();
        return $requetePreparee->fetch(PDO::FETCH_ASSOC);
    }

    public function getPassword($db, $id){
        $requeteSQL = "SELECT password FROM user WHERE id = :id";
        $requetePreparee =$db->prepare($requeteSQL);

        $requetePreparee->bindParam(":id", $id, PDO::PARAM_STR);

        $requetePreparee->execute();
        return $requetePreparee->fetch(PDO::FETCH_ASSOC);
    }


    public function alreadyExist($db, $pseudo, $email)
    {
        $requeteSQL = "SELECT count(*) FROM user WHERE email = :email OR pseudo = :pseudo";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $requetePreparee->bindParam(":email", $email, PDO::PARAM_STR);
       
        $requetePreparee->execute();

        return $requetePreparee->fetch(PDO::FETCH_ASSOC);

    }
    

    
    public function add($db, $pseudo, $email, $password)
    {
        $requeteSQL = "INSERT INTO user (pseudo, password, email) VALUES (:nom, :password, :email)";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':nom', $pseudo, PDO::PARAM_STR);
        $requetePreparee->bindValue(':password', $password, PDO::PARAM_STR);
        $requetePreparee->bindValue(":email", $email, PDO::PARAM_STR);
 
        
        $requetePreparee->execute();
    }


    public function connect($db, $email)
    {
        $getUser = "SELECT * FROM user WHERE email = :email";
        $prepareGetUser = $db->prepare($getUser);
        $prepareGetUser->bindParam(":email", $email, PDO::PARAM_STR);
       
        $prepareGetUser->execute();
      
        return $prepareGetUser->fetch(PDO::FETCH_BOTH);
    }


    public function updateUser($db, $id, $column, $value)
    {
        $requeteSQL = "UPDATE user SET $column = :value WHERE id = :id ";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindParam(':id', $id, PDO::PARAM_INT);
        $requetePreparee->bindParam(':value', $value, PDO::PARAM_STR);
        
        $requetePreparee->execute();
        
    }


    public function updatePassword($db, $id, $password)
    {
        $requeteSQL = "UPDATE user SET password = :password WHERE id = :id ";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindParam(':id', $id, PDO::PARAM_STR);
        $requetePreparee->bindParam(':password', $password, PDO::PARAM_STR);

        $requetePreparee->execute();
    }

    public function delete()
    {

    }


}





?>