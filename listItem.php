<section id="allCatTheme">
    <?php
    $getCategorie = $item->getCategorie($db);
    
    for ($i=0; $i < count($getCategorie) ; $i++): ?>
    <div>
        
        <?php 
        $idCat = $getCategorie[$i]['id'];
        $getThemeByCat = $item->getThemeByColumn($db, 'id_categorie', $idCat);
        
        echo ucfirst($getCategorie[$i]['nom']); 
        
        
        for ($y=0; $y < count($getThemeByCat); $y++): ?>
            <li><a href="paramRevision.php?idUser=<?php echo $id; ?>&&idTheme=<?php echo $getThemeByCat[$y]['id']; ?>"><?php echo $getThemeByCat[$y]['nom']; ?></a></li>
        <?php endfor;  ?>
        
    </div>

    <?php endfor; ?>
</section>
