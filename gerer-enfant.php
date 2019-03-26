<?php

session_start();

if(!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

require 'app/Autoloader.php';
Autoloader::register();

App::getHead("Gérer vos enfants");
?>
<body>
<?php
require 'view/view-menu.php';
require 'view/view-gerer-enfant.php';
require 'view/view-footer.php';
?>
</body>
</html>
