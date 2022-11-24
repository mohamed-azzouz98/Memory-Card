<?php

class User {
    

    /**
     * Fonction qui permet de savoir si un pseudo exist ou pas
     * 
     * @param PDO $db
     * @param STRING $pseudo
     * 
     * @return ARRAY Tableau qui compte le nombre de pseudo
     */
    public function getPseudo($db, $pseudo){
        $requeteSQL = "SELECT count(pseudo) FROM user WHERE pseudo = :pseudo";
        $requetePreparee =$db->prepare($requeteSQL);

        $requetePreparee->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);

        $requetePreparee->execute();
        return $requetePreparee->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fonction qui permet de savoir si un email exist ou pas
     * 
     * @param PDO $db
     * @param STRING $email
     * 
     * @return ARRAY Tableau qui compte le nombre d'email
     */
    public function getEmail($db, $email){
        $requeteSQL = "SELECT count(email) FROM user WHERE email = :email";
        $requetePreparee =$db->prepare($requeteSQL);

        $requetePreparee->bindParam(":email", $email, PDO::PARAM_STR);

        $requetePreparee->execute();
        return $requetePreparee->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fonction qui permet de recup le password de l'utilisateur
     * 
     * @param PDO $db
     * @param INT $id
     * 
     * @return ARRAY Tableau contenant le password de l'utilisateur
     */
    public function getPassword($db, $id){
        $requeteSQL = "SELECT password FROM user WHERE id = :id";
        $requetePreparee =$db->prepare($requeteSQL);

        $requetePreparee->bindParam(":id", $id, PDO::PARAM_STR);

        $requetePreparee->execute();
        return $requetePreparee->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fonction qui permet de savoir si un utilisateur exist ou pas en fonction de l'email ou du password entré
     * 
     * @param PDO $db
     * @param STRING $pseudo
     * @param STRING $email
     * 
     * @return ARRAY Tableau qui compte le nombre d'utilisateur existant avec les données entrée
     */
    public function alreadyExist($db, $pseudo, $email)
    {
        $requeteSQL = "SELECT count(*) FROM user WHERE email = :email OR pseudo = :pseudo";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $requetePreparee->bindParam(":email", $email, PDO::PARAM_STR);
       
        $requetePreparee->execute();

        return $requetePreparee->fetch(PDO::FETCH_ASSOC);

    }
    

    /**
     * Fonction qui permet d'ajouter un utilisateur
     * 
     * @param PDO $db
     * @param STRING $pseudo
     * @param STRING $email
     * @param STRING $password
     */
    public function add($db, $pseudo, $email, $password)
    {
        $requeteSQL = "INSERT INTO user (pseudo, password, email) VALUES (:nom, :password, :email)";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':nom', $pseudo, PDO::PARAM_STR);
        $requetePreparee->bindValue(':password', $password, PDO::PARAM_STR);
        $requetePreparee->bindValue(":email", $email, PDO::PARAM_STR);
 
        
        $requetePreparee->execute();
    }

    /**
     * Fonction qui sert a la connexion de l'utilisateur
     * 
     * @param PDO $db
     * @param STRING $email
     * 
     * @return ARRAY Tableau contenant les donnée de l'utilisateur
     */
    public function connect($db, $email)
    {
        $getUser = "SELECT * FROM user WHERE email = :email";
        $prepareGetUser = $db->prepare($getUser);
        $prepareGetUser->bindParam(":email", $email, PDO::PARAM_STR);
       
        $prepareGetUser->execute();
      
        return $prepareGetUser->fetch(PDO::FETCH_BOTH);
    }

    /**
     * Fonction qui pertmet d'update les données de l'utilisateur
     * 
     * @param PDO $db
     * @param INT $id
     * @param STRING $column
     * @param STRING $value
     */
    public function updateUser($db, $id, $column, $value)
    {
        $requeteSQL = "UPDATE user SET $column = :value WHERE id = :id ";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindParam(':id', $id, PDO::PARAM_INT);
        $requetePreparee->bindParam(':value', $value, PDO::PARAM_STR);
        
        $requetePreparee->execute();
        
    }


    

    public function delete()
    {

    }


}





?>