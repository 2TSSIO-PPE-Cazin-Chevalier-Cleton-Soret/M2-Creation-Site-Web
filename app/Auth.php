<?php

class Auth extends DB {

    public function logout() {
        session_start();
        if(isset($_SESSION['id'])) {
            $_SESSION = array();
            session_destroy();
            header('Location: connexion.php');
        }
        else {
            header('Location: connexion.php');
        }
    }

    public static function updateAccountQuery($var) {
        $req = db::getInstanceBDD()->getBDD()->prepare('UPDATE membres SET '.$var.'=:'.$var.' WHERE id = '.$_SESSION['id'].'');
        $req->bindValue(":'.$var.'", $var, PDO::PARAM_STR);
    }

}

?>