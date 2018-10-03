<div class="main">
    <div class="section">
        <div class="section__title">
            <h1>Bienvenue sur la page d'accueil</h1>
        </div>
        <?php
        if(!isset($_SESSION['id'])) {
            echo "<p><a class=\"link\" href=\"inscription.php\">Inscrivez-vous</a> ou <a class=\"link\" href=\"connexion.php\">connectez-vous</a></p>";
        }
        else {
            echo "Vous êtes connectés en tant que : <b>".$_SESSION['pseudo']."</b><br>Accéder à votre <a class=\"link\" href=\"tableau-de-bord.php\">tableau de bord</a>";
        }
        ?>
    </div>
</div>