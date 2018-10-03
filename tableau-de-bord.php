<?php

session_start();
if(!isset($_SESSION['id'])) {
    header('Location: connexion.php');
}

function __autoload($classname) {
    $filename = "./". $classname .".php";
    include_once($filename);
}

components::getHead("Tableau de bord");
?>
<body>
<?php

require 'view/view-menu.php';
require 'view/view-tableau-de-bord.php';

?>
</body>
</html>