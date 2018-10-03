<?php

class auth {

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

}

?>