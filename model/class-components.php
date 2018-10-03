<?php

class components {

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

}

?>