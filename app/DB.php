<?php

class DB
{
    private $PDOInstance = null;

    private static $instance = null;

    const DB_HOST = 'localhost';

    const DB_DATABASE = 'ram';

    const DB_USER = 'root';

    const DB_PASS = 'root';

    private function __construct()
    {
        $this->PDOInstance = new PDO('mysql:dbname='.self::DB_DATABASE.';host='.self::DB_HOST,self::DB_USER,self::DB_PASS);
        $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function query($query)
    {
        return $this->PDOInstance->query($query);
    }

    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }

    public static function updateWithParams($params, $sessionOrNot = false) {
        $bdd = self::getInstance();
        if($sessionOrNot = false) {
            if (!empty($params)) {
                $req = $bdd->prepare('UPDATE membres SET '.$params.'=:'.$params.' WHERE id = ' . $_SESSION['id'] . '');
                $req->bindValue(":'.$params.'", $params, PDO::PARAM_STR);
            }
        } else {
            if (!empty($params)) {
                $req = $bdd->prepare('UPDATE membres SET {$params}=:{$params} WHERE id = ' . $_SESSION['id'] . '');
                $req->bindValue(":pseudo", $params, PDO::PARAM_STR);
                $_SESSION['' . $params . ''] = $params;
            }
        }
    }

}
