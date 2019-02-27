<?php

session_start();

if(!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

require 'app/Autoloader.php';
Autoloader::register();

App::getHead("Tableau de bord");
?>
<body>
<?php

require 'view/view-menu.php';
require 'view/view-tableau-de-bord.php';
require 'view/view-footer.php';

?>
</body>
</html>