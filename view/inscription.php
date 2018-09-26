<?php

use DB\DB;

define('ROOT', dirname(__FILE__));

function __autoload($classname) {
    $filename =  ROOT .'/model/'. $classname .'.php';
    require_once $filename;
}

try {
    $bdd->getDB();
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $nbrEnfant = $_POST['nbrEnfant'];
    $type = $_POST['type'];

    $req = $bdd->prepare('INSERT INTO membres(mdp, nom, prenom, email, nbrEnfant, type) VALUES(:mdp, :nom, :prenom, :email, :nbrEnfant, :type)');
    $req->execute(array(
        'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'nbrEnfant' => $nbrEnfant,
        'type' => $type
    ));
    echo 'Inscription réussie';
    header('Location: '. ROOT .'/view/tableau-de-bord.php');
}
catch (PDOException $e) {
        die($e->getMessage());
}

?>