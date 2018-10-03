<div class="menu">
    <li class="title"><a href="index.php">Accueil</a></li>
    <ul>
        <?php if(isset($_SESSION['id'])) { echo "<li><a href=\"tableau-de-bord.php\">Tableau de bord</a></li>"; } ?>
        <?php if(!isset($_SESSION['id'])) { echo "<li><a href=\"inscription.php\">Inscription</a></li>"; } ?>
        <?php if(!isset($_SESSION['id'])) { echo "<li><a href=\"connexion.php\">Connexion</a></li>"; } ?>
        <?php if(isset($_SESSION['id'])) { echo "<li><a href=\"deconnexion.php\">Deconnexion</a></li>"; } ?>
    </ul>
</div>