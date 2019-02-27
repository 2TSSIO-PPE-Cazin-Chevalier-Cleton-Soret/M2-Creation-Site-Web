<?php

session_start();
if(isset($_SESSION['id'])) {
    header('Location: tableau-de-bord.php');
}

require 'app/Autoloader.php';
Autoloader::register();

App::getHead("Connexion");
?>
<body>
<?php

require 'view/view-menu.php';
require 'view/view-connexion.php';
require 'view/view-footer.php';

?>
</body>
</html>