<div class="container">
    <div class="row">
        <div class="card mt-5 text-center mx-auto px-5 py-2">
            <div class="card-body">
                <h1 class="card-title">Bienvenue sur la page d'accueil</h1>
                <div class="card-text">
                    <?php
                    if(!isset($_SESSION['id'])) {
                        echo "
                <p class=\"t-j\" id='text-presentation'>La plateforme <span class='font-weight-bold'>RAM</span> permet de mettre en relation parent et assistante pour qu'elles puissent plus aisément suivre le suivi quotidien de leurs enfants.<br>Inscrivez-vous dès maintenant, que vous soyez <span class='font-weight-bold'>parent</span> ou <span class='font-weight-bold'>assistante</span></p>
                <a class='btn btn-primary' href='inscription.php'>Inscrivez-vous</a> ou <a class='btn btn-primary' href='connexion.php'>Connectez-vous</a>
                ";
                    }
                    else {
                        echo "Vous êtes connectés en tant que : <b>".$_SESSION['pseudo']."</b><br>Accéder à votre <a class=\"link\" href=\"tableau-de-bord.php\">tableau de bord</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
