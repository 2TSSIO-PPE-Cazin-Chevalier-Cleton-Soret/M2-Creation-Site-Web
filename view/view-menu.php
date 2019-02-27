<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">RAM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <?php if(isset($_SESSION['id'])) {
                echo "<li class=\"nav-item\"><a class='nav-link' href=\"tableau-de-bord.php\"><i class=\"fas fa-user-circle\"></i> Tableau de bord</a></li>";
            } ?>
            <?php if(!isset($_SESSION['id'])) {
                echo "<li class=\"nav-item\"><a class='nav-link' href=\"inscription.php\"><i class=\"fas fa-user-plus\"></i> Inscription</a></li>";
            } ?>
            <?php if(!isset($_SESSION['id'])) {
                echo "<li class=\"nav-item\"><a class='nav-link' href=\"connexion.php\"><i class=\"fas fa-sign-in-alt\"></i> Connexion</a></li>";
            } ?>
            <?php if(isset($_SESSION['id'])) {
                echo "<li class=\"nav-item\"><a class='nav-link' href=\"deconnexion.php\"><i class=\"fas fa-sign-out-alt\"></i> Deconnexion</a></li>";
            } ?>
        </ul>
    </div>
</nav>