<div class="main">
    <div class="section">
        <div class="section__title">
            <h1>Bienvenue sur la page d'accueil</h1>
        </div>
        <?php
        if(!isset($_SESSION['id'])) {
            echo "
            <p class=\"t-j\" id='text-presentation'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam malesuada malesuada nisl ut fringilla. Vivamus urna purus, mollis sed pellentesque vitae, porttitor id leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean fermentum, est ac suscipit pellentesque, neque libero vestibulum neque, non sodales nibh velit sed nibh. Nulla mi enim, viverra a sodales suscipit, luctus in tellus. Fusce ornare tincidunt sem, vitae hendrerit nibh placerat et. Curabitur dui lacus, auctor ac quam eget, gravida pharetra magna. Suspendisse efficitur sagittis commodo. Ut lectus risus, imperdiet id sapien non, posuere viverra nisi.</p>
            <p><button type=\"button\" class=\"btn btn-outline-primary\"><a href='inscription.php'>Inscrivez-vous</a></button> ou <button type=\"button\" class=\"btn btn-outline-primary\"><a href='connexion.php'>Connectez-vous</a></button></p>
            ";
        }
        else {
            echo "Vous êtes connectés en tant que : <b>".$_SESSION['pseudo']."</b><br>Accéder à votre <a class=\"link\" href=\"tableau-de-bord.php\">tableau de bord</a>";
        }
        ?>
    </div>
</div>