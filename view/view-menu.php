<div class="menu">
    <li class="title"><a href="index.php">Accueil</a></li>
    <ul>
        <?php if(isset($_SESSION['id'])) { echo "<li><a href=\"tableau-de-bord.php\"><i class=\"fas fa-user-circle\"></i> Tableau de bord</a></li>"; } ?>
        <?php if(!isset($_SESSION['id'])) { echo "<li><a href=\"inscription.php\"><i class=\"fas fa-user-plus\"></i> Inscription</a></li>"; } ?>
        <?php if(!isset($_SESSION['id'])) { echo "<li><a href=\"connexion.php\"><i class=\"fas fa-sign-in-alt\"></i> Connexion</a></li>"; } ?>
        <?php if(isset($_SESSION['id'])) { echo "<li><a href=\"deconnexion.php\"><i class=\"fas fa-sign-out-alt\"></i> Deconnexion</a></li>"; } ?>
    </ul>
</div>