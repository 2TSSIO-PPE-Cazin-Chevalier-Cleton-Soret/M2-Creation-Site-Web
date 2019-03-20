<?php

session_start();

if(!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

require 'app/Autoloader.php';
Autoloader::register();

App::getHead("Choix de la nounou");
?>
<body>
<?php require 'view/view-menu.php'; ?>
<?php $form = new Form(); ?>
<div class="container">
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h1 class="card-title mb-4">Modifier les informations de votre compte</h1>
            <div class="card-text px-4">
                <?php
                if(isset($_POST)) {
                    if(isset($_POST['choix_nounou'])) {
                        $bdd = DB::getInstanceBDD()->getBDD();
                        $choix_nounou = $_POST['choix_nounou'];
                        $req = $bdd->prepare('UPDATE membres SET choix_nounou=:choix_nounou WHERE id = '.$_SESSION['id'].'');
                        $req->bindValue(":choix_nounou", $choix_nounou, PDO::PARAM_STR);
                        $req->execute();
                        echo '<div class="alert alert-success">Votre nounou à bien été choisi</div>';
                    } else {
                        echo '<div class="alert alert-danger">Votre nounou n\'a pas été choisi</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Erreur, vous devez sélectionner une nounou</div>';
                }

                ?>
            </div>
        </div>
    </div>
</div>
<?php
require 'view/view-footer.php';
?>
</body>
</html>