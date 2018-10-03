<?php

session_start();
if(isset($_SESSION['id'])) {
    header('Location: tableau-de-bord.php');
}

function __autoload($classname) {
    $filename = "model/class-". $classname .".php";
    include_once($filename);
}

components::getHead("Inscription");

?>
<body>
<?php

require 'view/view-menu.php';
require 'view/view-inscription.php';

?>
</body>
</html>