<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RAM Inscription</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<?php

function __autoload($classname)
{
    $filename = "includes/" . $classname . ".php";
    include_once($filename);
}
?>

<body>
<?php
if (isset($_SESSION['id'])) {
    header('Location: ./tableau-de-bord.php');
}
?>
<div class="main">
    <div class="register">
        <div class="register__title">
            <h1>Bienvenue sur la plateforme d'inscription de la RAM</h1>
        </div>
        <div class="register__form">
            <form action="connexion.php" method="post">
                <input type="mail" class="input-form" name="email" placeholder="Votre adresse email">
                <input type="password" class="input-form" name="mdp" placeholder="Votre mot de passe">

                <input type="submit" class="button-submit-form" value="Valider l'inscription">
                <?php
                if (isset($_POST)) {
                    if (isset($_POST['email']) && isset($_POST['mdp'])) {
                        $bdd = new PDO('mysql:host=localhost;dbname=RAM;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                        $email = $_POST['email'];

                        //  Récupération de l'utilisateur et de son pass hashé
                        $req = $bdd->prepare('SELECT id, mdp, email FROM membres WHERE email = :email');
                        $req->execute(array('email' => $email));
                        $resultat = $req->fetch();

                        // Comparaison du pass envoyé via le formulaire avec la base
                        $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);

                        if (!$resultat) {
                            echo '<div class="alert alert-danger" role="alert">Identifiant ou mot de passe incorrect</div>';
                        } else {

                            if ($isPasswordCorrect) {
                                session_start();
                                $_SESSION['id'] = $resultat['id'];
                                $_SESSION['email'] = $email;
                                header('Location: ./tableau-de-bord.php');
                            } else {
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
