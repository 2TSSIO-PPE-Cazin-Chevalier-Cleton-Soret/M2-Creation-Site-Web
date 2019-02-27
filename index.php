<?php

session_start();

require 'app/Autoloader.php';
Autoloader::register();

App::getHead("Accueil");

require 'view/view-menu.php';
require 'view/view-index.php';
require 'view/view-footer.php';

?>