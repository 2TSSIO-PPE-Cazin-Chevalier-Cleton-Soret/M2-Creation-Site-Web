<?php $form = new Form(); ?>
<div class="container">
    <div class="card mt-5 px-5 py-3 text-center">
        <div class="card-body">
            <h1 class="card-title mb-4">Connexion à la plateforme de la RAM</h1>
            <div class="card-text mx-auto" style="width: 50rem;">
                <form action="connexion.php" method="post">
                    <?= $form->createInput("pseudo", "text", "Votre pseudo") ?>
                    <?= $form->createInput("mdp", "password", "Votre mot de passe") ?>
                    <input type="submit" class="btn btn-primary btn-block mb-2" value="Se connecter">
                    <?php
                    if(isset($_POST)) {
                        if(isset($_POST['pseudo']) && isset($_POST['mdp'])) {
                            $bdd = DB::getInstance();
                            $pseudo = $_POST['pseudo'];

                            //  Récupération de l'utilisateur et de son pass hashé
                            $req = $bdd->prepare('SELECT id, pseudo, mdp FROM membres WHERE pseudo = :pseudo');
                            $req->execute(array('pseudo' => $pseudo));
                            $resultat = $req->fetch();

                            // Comparaison du pass envoyé via le formulaire avec la base
                            $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);

                            if (!$resultat) {
                                echo '<div class="alert alert-danger" role="alert">Identifiant ou mot de passe incorrect</div>';
                            }

                            else {

                                if ($isPasswordCorrect) {
                                    $_SESSION['id'] = $resultat['id'];
                                    $_SESSION['pseudo'] = $pseudo;

                                    $req = $bdd->prepare('SELECT choix_nounou FROM membres WHERE pseudo = :pseudo');
                                    $req->execute(array('pseudo' => $pseudo));
                                    $resultat = $req->fetch();
                                    $_SESSION['choix_nounou'] = $resultat['choix_nounou'];

                                    header('Location: tableau-de-bord.php');
                                }

                                else {
                                    echo '<div class="alert alert-danger" role="alert">Identifiant ou mot de passe incorrect!</div>';
                                }
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>
