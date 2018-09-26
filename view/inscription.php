<?php

function __autoload($classname) {
    $filename =  '../model/'. $classname .'.php';
    require_once $filename;
}

if(isset($_POST)) {
    if (isset($_POST['pseudo'])
        && isset($_POST['mdp'])
        && isset($_POST['nom'])
        && isset($_POST['prenom'])
        && isset($_POST['email'])
        && isset($_POST['nbrEnfant'])
        && isset($_POST['type'])) {
        try {
            $bdd = DB::getInstanceBDD()->getBDD(); //Créer une nouvelle instance PDO, DB = nom de la classe, getInstanceBDD() = nom de la méthode, getBDD = récupére la méthode
            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['mdp'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $nbrEnfant = $_POST['nbrEnfant'];
            $type = $_POST['type'];

            $req = $bdd->prepare('INSERT INTO membres(pseudo, mdp, nom, prenom, email, nbrEnfant, type) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :nbrEnfant, :type)');
            $req->execute(array(
                'pseudo' => $pseudo,
                'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'nbrEnfant' => $nbrEnfant,
                'type' => $type
            ));
            require '../view/inscription-reussi.php';
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    else {
        require '../view/inscription-echouee.php';
    }
}
else {
    echo 'Les champs ne sont pas remplies';
}
?>