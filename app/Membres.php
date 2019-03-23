<?php

class Membres {

    public function getID() {
        $bdd = DB::getInstance();
        return $req = $bdd->query('SELECT id FROM membres WHERE type="assistante"')->fetch()[0];
    }

    public function getType()
    {
        $bdd = DB::getInstance();
        return $req = $bdd->query('SELECT type FROM membres WHERE type="assistante"')->fetch()[0];
    }

}
