<?php
function __autoload($classname) {
    $filename = "./". $classname .".php";
    include_once($filename);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RAM Inscription</title>
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>
<?php

require 'view/index.php';

?>
</body>
</html>