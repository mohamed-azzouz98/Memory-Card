<?php

class Item{

    /**
     *Fonction qui permet d'enlever toute les accent dans une chaine de caractere 
     * 
     * @param STRING $str
     * 
     * @return STRING La chaine de caractere sans accent
     */
    public function deleteAccent($str)
    {
        $str = htmlentities($str, ENT_COMPAT, "UTF-8");
        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde|ring);/','$1',$str);
        return html_entity_decode($str);
    } 

    /**
     * Fonction qui permet de recup toute les catagories crées
     * 
     * @param PDO $db
     * 
     * @return ARRAY Un tableau contenant toute les categories
     */
    public function getCategorie($db){
        $requeteSQL = "SELECT * FROM categorie";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fonction qui permet de recup tout les themes crées
     * 
     * @param PDO $db
     * 
     * @return ARRAY Tableau contenant la liste des themes
     */
    public function getTheme($db)
    {
        $requeteSQL = "SELECT * FROM theme";
        $requetePreparee = $db->prepare($requeteSQL);
        
        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Fonction qui permet de recup les themes avec une colonne en parametre
     * 
     * @param PDO $db
     * @param STRING $nameColumn
     * @param INT $id
     * 
     * @return ARRAY Tableau contenant les theme selectionnés
     */
    public function getThemeByColumn($db, $nameColumn, $id)
    {
        $requeteSQL = "SELECT * FROM theme WHERE $nameColumn = :id";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);
        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Fonction qui permet de recup les cartes avec une colonne en parametre
     * 
     * @param PDO $db
     * @param STRING $ column
     * @param INT $id
     * 
     * @return ARRAY Tableau contenant les cartes selectionnées
     */
    public function getCarteByColumn($db, $column, $id)
    {
        $requeteSQL = "SELECT * FROM carte WHERE $column = :id";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);
        
        $requetePreparee->execute();
        
        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fonction qui permet de recup les données d'une carte et dans quel theme elle se trouve
     * 
     * @param PDO $db
     * @param INT $id
     * 
     * @return ARRAY Un tableau contenant les donnée de la carte
     */
    public function getCarteTheme($db, $id)
    {
        $requeteSQL = "SELECT carte.recto, carte.verso, carte.imgRecto, carte.imgVerso, theme.nom FROM carte INNER JOIN theme ON carte.id_theme = theme.id WHERE carte.id = :id";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);
        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    /**
     * Fonction qui permet d'ajouter une categorie
     * 
     * @param PDO $db
     * @param STRING $name
     * @param INT $id
     */
    public function addCategorie($db, $name, $id){
        $requeteSQL = "INSERT INTO categorie(nom, id_user) VALUES (:name, :id)";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':name', $name, PDO::PARAM_STR);
        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);

        $requetePreparee->execute();
    }

    /**
     * Fonction qui permet d'ajouter un theme
     * 
     * @param PDO $db
     * @param INT $idUser
     * @param INT $idCat
     * @param STRING $name
     * @param STRING $description
     * @param BOOLEAN $public
     * @param STRING $dateCreation
     */
    public function addTheme($db, $idUser, $idCat, $name, $description, $public, $dateCreation){
        $requeteSQL = "INSERT INTO theme(id_user, id_categorie,nom, description, public, date_creation)  VALUES (:idUser, :idCat, :name, :description, :public, :dateCreation)";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->bindValue(':name', $name, PDO::PARAM_STR);
        $requetePreparee->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $requetePreparee->bindValue(':idCat', $idCat, PDO::PARAM_INT);
        $requetePreparee->bindValue(':description', $description, PDO::PARAM_STR);
        $requetePreparee->bindValue(':public', $public, PDO::PARAM_BOOL);
        $requetePreparee->bindValue(':dateCreation', $dateCreation, PDO::PARAM_STR);

        $requetePreparee->execute();
    }

    /**
     * Fonction qui permet d'ajouter une carte
     * 
     * @param PDO $db
     * @param INT $idUser
     * @param INT $idTheme
     * @param STRING $recto
     * @param STRING $verso
     * @param STRING $imgRecto
     * @param STRING $imgVerso
     * @param STRING $dateCreation
     * @param STRING $dateModification
     */
    public function addCarte($db, $idUser, $idTheme, $recto, $verso, $imgRecto, $imgVerso, $dateCreation, $dateModification){
        $requeteSQL = "INSERT INTO carte(id_user, id_theme, recto, verso, imgRecto, imgVerso, date_creation, date_modification) VALUES(:idUser, :idTheme, :recto, :verso, :imgRecto, :imgVerso, :dateCreation, :dateModification)";
        $requetePreparee = $db->prepare($requeteSQL);

        
        $requetePreparee->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $requetePreparee->bindValue(':idTheme', $idTheme, PDO::PARAM_INT);
        $requetePreparee->bindValue(':recto', $recto, PDO::PARAM_STR);
        $requetePreparee->bindValue(':verso', $verso, PDO::PARAM_STR);
        $requetePreparee->bindValue(':imgRecto', $imgRecto, PDO::PARAM_STR);
        $requetePreparee->bindValue(':imgVerso', $imgVerso, PDO::PARAM_STR);
        $requetePreparee->bindValue(':dateCreation', $dateCreation, PDO::PARAM_STR);
        $requetePreparee->bindValue(':dateModification', $dateModification, PDO::PARAM_STR);

        $requetePreparee->execute();
    }


    public function updateCategorie()
    {

    }


    public function updateTheme()
    {

    }

    /**
     * Fonction qui permet d'update les données d'une carte
     * 
     * @param PDO $db
     * @param INT $id
     * @param STRING $column
     * @param STRING $value
     * @param STRING $dateModification
     */
    public function updateCarte($db, $id, $column, $value, $dateModification)
    {
        $requeteSQL = "UPDATE carte SET $column = :value, date_modification = :dateModification WHERE id = :id";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindParam(':id', $id, PDO::PARAM_INT);
        $requetePreparee->bindParam(':value', $value, PDO::PARAM_STR);
        $requetePreparee->bindParam(':dateModification', $dateModification, PDO::PARAM_STR);
        
        $requetePreparee->execute();

    }


    /**
     * Fonction qui permet de delete les données d'une table en fonction de l'id donné
     * 
     * @param PDO $db
     * @param INT $id
     * @param STRING $table
     */
    public function deleteTable($db, $id, $table)
    {
        $requeteSQL = "DELETE FROM $table WHERE id = :id";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->bindParam(':id', $id, PDO::PARAM_INT);
        
        $requetePreparee->execute();
    }





}
