<?php

session_start();
if(isset($_SESSION['id'])) {
    header('Location: tableau-de-bord.php');
}

function __autoload($classname) {
    $filename = "model/class-". $classname .".php";
    include_once($filename);
}

components::getHead("Accueil");

session_start();
if(isset($_SESSION['id'])) {
    header('Location : tableau-de-bord.php');
}
else {
    header('Location : connexion.php');
}

?>