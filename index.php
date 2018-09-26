<?php
function __autoload($classname) {
    $filename = "./". $classname .".php";
    include_once($filename);
}

require 'view/head.php';
?>
<body>
<?php

require 'view/index.php';

?>
</body>
</html>