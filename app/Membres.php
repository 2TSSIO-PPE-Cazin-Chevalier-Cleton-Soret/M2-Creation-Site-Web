<?php

class Membres {

    public static function getID() {
        $bdd = DB::getInstance();
        return $req = $bdd->query('SELECT id FROM membres WHERE id='.$_SESSION['id'].'')->fetch()[0];
    }

    public static function getType()
    {
        $bdd = DB::getInstance();
        return $req = $bdd->query('SELECT type FROM membres WHERE id = '.$_SESSION['id'].'')->fetch()[0];
    }

    public static function getAssistantes()
    {
        $bdd = DB::getInstance();
        $req = $bdd->query('SELECT * FROM membres WHERE type="assistante"');
        while($donnees = $req->fetch()):
            echo '<option value="'.$donnees['id'].'">'.$donnees['nom'].'</option>';
        endwhile;
    }

}
