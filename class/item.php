<?php

class Item{


    public function deleteAccent($str)
    {
        $str = htmlentities($str, ENT_COMPAT, "UTF-8");
        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde|ring);/','$1',$str);
        return html_entity_decode($str);
    } 

    public function getCategorie($db){
        $requeteSQL = "SELECT * FROM categorie";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTheme($db)
    {
        $requeteSQL = "SELECT * FROM theme";
        $requetePreparee = $db->prepare($requeteSQL);
        
        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getThemeByColumn($db, $nameColumn, $id)
    {
        $requeteSQL = "SELECT * FROM theme WHERE $nameColumn = :id";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);
        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function getCarte($db, $column, $id)
    {
        $requeteSQL = "SELECT * FROM carte WHERE $column = :id";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);
        
        $requetePreparee->execute();
        
        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarteTheme($db, $id)
    {
        $requeteSQL = "SELECT carte.recto, carte.verso, carte.imgRecto, carte.imgVerso, theme.nom FROM carte INNER JOIN theme ON carte.id_theme = theme.id WHERE carte.id = :id";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);
        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function addCategorie($db, $name, $id){
        $requeteSQL = "INSERT INTO categorie(nom, id_user) VALUES (:name, :id)";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':name', $name, PDO::PARAM_STR);
        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);

        $requetePreparee->execute();
    }

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

    public function updateCarte($db, $id, $column, $value, $dateModification)
    {
        $requeteSQL = "UPDATE carte SET $column = :value, date_modification = :dateModification WHERE id = :id";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindParam(':id', $id, PDO::PARAM_INT);
        $requetePreparee->bindParam(':value', $value, PDO::PARAM_STR);
        $requetePreparee->bindParam(':dateModification', $dateModification, PDO::PARAM_STR);
        
        $requetePreparee->execute();

    }

    public function deleteTable($db, $id, $table)
    {
        $requeteSQL = "DELETE FROM $table WHERE id = :id";
        $requetePreparee = $db->prepare($requeteSQL);

        $requetePreparee->bindParam(':id', $id, PDO::PARAM_INT);
        
        $requetePreparee->execute();
    }





}
