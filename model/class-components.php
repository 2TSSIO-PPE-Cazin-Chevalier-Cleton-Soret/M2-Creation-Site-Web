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
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset=\"utf-8\">
            <title>$title - RAM</title>
            <link rel=\"stylesheet\" href=\"public/css/main.css\">
            <link rel=\"shortcut icon\" href=\"public/images/favicon.ico\" type=\"image/x-icon\">
        </head>
        ";
    }

}

?>