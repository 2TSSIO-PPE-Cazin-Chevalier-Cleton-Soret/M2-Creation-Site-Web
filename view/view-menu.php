<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
    <a class="navbar-brand" href="index.php">RAM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <?php
            if(isset($_SESSION['id'])) {
                $bdd = DB::getInstance();
                $req = $bdd->query('SELECT type FROM membres WHERE id=' . $_SESSION['id'] . '');
                while ($donnees = $req->fetch()) {
                    $type = $donnees['type'];
                }
            }
            ?>
            <?php if(isset($_SESSION['id'])) {
                if($type == "parent") {
                    echo "<li class=\"nav-item\"><a class='nav-link' href=\"tableau-de-bord.php\"><i class=\"fas fa-user-circle text-primary\"></i> Tableau de bord <span class=\"badge badge-primary\">{$_SESSION['pseudo']}</span></a></li>";
                }
                if($type == "assistante") {
                    echo "<li class=\"nav-item\"><a class='nav-link' href=\"tableau-de-bord.php\"><i class=\"fas fa-user-circle text-primary\"></i> Tableau de bord <span class=\"badge badge-success\">{$_SESSION['pseudo']}</span></a></li>";
                }
            } ?>
            <?php if(!isset($_SESSION['id'])) {
                echo "<li class=\"nav-item\"><a class='nav-link' href=\"inscription.php\"><i class=\"fas fa-user-plus text-primary\"></i> Inscription</a></li>";
            } ?>
            <?php if(!isset($_SESSION['id'])) {
                echo "<li class=\"nav-item\"><a class='nav-link' href=\"connexion.php\"><i class=\"fas fa-sign-in-alt text-primary\"></i> Connexion</a></li>";
            } ?>
            <?php if(isset($_SESSION['id'])) {
                echo "<li class=\"nav-item\"><a class='nav-link' href=\"deconnexion.php\"><i class=\"fas fa-sign-out-alt text-primary\"></i> Deconnexion</a></li>";
            } ?>
        </ul>
    </div>
</nav>
