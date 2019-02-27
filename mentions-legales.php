<?php

session_start();
function __autoload($classname) {
    $filename = "app/class-". $classname .".php";
    include_once($filename);
}

require 'app/Autoloader.php';
Autoloader::register();

App::getHead("Mentions légales");
?>
<body>
<?php

require 'view/view-menu.php';
require 'view/view-mentions-legales.php';
require 'view/view-footer.php';

?>
</body>
</html>