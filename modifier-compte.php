<?php

session_start();
if(!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

require 'app/Autoloader.php';
Autoloader::register();

App::getHead("Modifier votre compte");
?>
<body>
<?php

require 'view/view-menu.php';
require 'view/view-modifier-compte.php';
require 'view/view-footer.php';

?>
</body>
</html>