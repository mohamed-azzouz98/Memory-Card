<nav>
    <?php if(empty($_SESSION)):?>
        <a href="index.php">Accueil</a>
    <?php 
    endif; 
    
    if(!empty($_SESSION)): ?>
    <ul>
        <li><a href="index.php?id=<?php echo $_SESSION['id']?>">Accueil</a></li>
        <li><a href="profil.php?id=<?php echo $_SESSION['id']?>">Profil</a></li>
        <li><a href="disconnect.php">Deconnexion</a></li>
    </ul>
        
    <?php endif;?>
</nav>