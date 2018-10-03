<div class="main">
    <div class="register">
        <div class="register__title">
            <h1>Connexion à la plateforme de la RAM</h1>
        </div>
        <div class="register__form">
            <form action="connexion.php" method="post">
                <input type="text" name="pseudo" class="input-form" placeholder="Votre pseudo">
                <input type="password" class="input-form" name="mdp" placeholder="Votre mot de passe">
                <input type="submit" class="button-submit-form" value="Se connecter">
                <?php
                if(isset($_POST)) {
                    if(isset($_POST['pseudo']) && isset($_POST['mdp'])) {
                        $bdd = db::getInstanceBDD()->getBDD();
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
                                session_start();
                                $_SESSION['id'] = $resultat['id'];
                                $_SESSION['pseudo'] = $pseudo;
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