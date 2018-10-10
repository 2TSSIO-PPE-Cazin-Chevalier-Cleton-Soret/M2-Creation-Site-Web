<?php

session_start();

function __autoload($classname) {
    $filename = "model/class-". $classname .".php";
    include_once($filename);
}

components::getHead("Accueil");

require 'view/view-menu.php';
require 'view/view-index.php';
require 'view/view-footer-fixed.php';

?>