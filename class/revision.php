<?php 

class Revision{


    public function getRevisionByIdUser($db, $id)
    {
        $requeteSQL = " SELECT * FROM revision WHERE id_user = :id";
        $requetePreparee = $db->prepare($requeteSQL);
        $requetePreparee->bindValue(':id', $id, PDO::PARAM_INT);
        $requetePreparee->execute();

        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);

    }

    


}


?>