<?php

class DB {

    private $bdd = null;
    private static $instanceDB = null;

    /**
     * Constructeur de la base de données
     */
    private function __construct() {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=RAM;charset=utf8', 'root', 'root', array(PDO::ATTR_PERSISTENT => true));
        }
        catch (Exception $e) {
            echo ("Erreur : " . $e->getMessage());
        }
    }

    /*
     * Permet d'instancier une nouvelle connexion PDO
     * ::self : permet d'accéder à l'ensemble de la classe courante DB
     */
    public static function getInstanceBDD() {
        if (is_null(self::$instanceDB)) {
            self::$instanceDB = new DB();
        }
        return self::$instanceDB;
    }

    /**
     * @return PDO
     */
    public function getBDD() {
        return $this->bdd;
    }

}