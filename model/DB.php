<?php

namespace DB;

define('ROOT', dirname(__FILE__));
$file_path = ROOT . '/controller/DBConst.php';

class DB {

    public function getDB() {
        $bdd = new PDO(DSN, USER, PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    }

}

?>