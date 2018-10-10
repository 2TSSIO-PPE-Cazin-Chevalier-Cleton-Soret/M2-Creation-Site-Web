<?php

session_start();
if(!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

function __autoload($classname) {
    $filename = "model/class-". $classname .".php";
    include_once($filename);
}

components::getHead("Modifier votre compte");
?>
<body>
<?php

require 'view/view-menu.php';
require 'view/view-modifier-compte.php';
require 'view/view-footer.php';

?>
</body>
</html>