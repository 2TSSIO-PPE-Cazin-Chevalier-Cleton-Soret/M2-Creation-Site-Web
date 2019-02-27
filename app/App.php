<?php

class App extends DB {

    private $title;

    /**
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @param $title
     */
    public static function getHead($title) {
        require 'view/view-head.php';
    }

    public static function getValue($value) {
        $bdd = DB::getInstanceBDD()->getBDD();
        $req = $bdd->query('SELECT * FROM membres WHERE id = '.$_SESSION['id'].'');
        $req_select = $req->fetch();
        return $req_select[''.$value.''];
    }

}

?>