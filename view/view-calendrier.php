<?php
$form = new Form();
if(Membres::getType() == "assistante"):
    $_SESSION['idEnfant'] = isset($_POST['enfant']) ? $_POST['enfant'] : $_SESSION['idEnfant'];
endif;
?>

<?php if(Membres::getType() == "assistante"): ?>
<div class="container">
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h1 class="card-title mb-4">Calendrier journalier</h1>
            <div class="card-text px-4">
                <div class="row">
                    <div class="col-lg-12">
                        <?php

                        $bdd = DB::getInstance();
                        $rempliesOuNon = $bdd->query('CALL calendrierRempliOuNon('.$_SESSION['idEnfant'].')')->fetch();
                        $afficherOuNon = $rempliesOuNon[0];
                        $afficher = true;
                        if($afficherOuNon == 1) {
                            echo '<div class="alert alert-danger mt-3">Vous avez déjà remplies le calendrier du jour pour cette enfant</div>';
                            $afficher = false;
                        }
                        ?>
                        <?php if($afficher == true): ?>
                        <form action="calendrier.php" method="post">
                            <?= $form->createInput("sante", "text", "Santé") ?>
                            <?= $form->createInput("temp", "text", "Température en °C") ?>
                            <?= $form->createInput("pleurs", "text", "Pleures") ?>
                            <?= $form->createInput("besoin", "text", "Besoins") ?>
                            <?= $form->createInput("repas", "text", "Repas (Horaires)") ?>
                            <?= $form->createInput("aliment", "text", "Aliments") ?>
                            <?= $form->createInput("dodo", "text", "Dodo (Horaires)") ?>
                            <?= $form->createInput("humeur", "text", "Humeur") ?>
                            <?= $form->createInput("activite", "text", "Activités") ?>
                            <?= $form->createInput("promenade", "text", "Promenade Horaire") ?>
                            <?= $form->createInput("remarques", "text", "Remarques") ?>
                            <button type="submit" class="btn btn-primary btn-block">Valider les informations</button>
                        </form>
                        <?php

                        if(isset($_POST['sante']) &&
                            isset($_POST['temp']) &&
                            isset($_POST['pleurs']) &&
                            isset($_POST['besoin']) &&
                            isset($_POST['repas']) &&
                            isset($_POST['aliment']) &&
                            isset($_POST['dodo']) &&
                            isset($_POST['humeur']) &&
                            isset($_POST['activite']) &&
                            isset($_POST['promenade'])) {

                            $sante = $_POST['sante'];
                            $temp = $_POST['temp'];
                            $pleurs = $_POST['pleurs'];
                            $besoin = $_POST['besoin'];
                            $repas = $_POST['repas'];
                            $aliment = $_POST['aliment'];
                            $dodo = $_POST['dodo'];
                            $humeur = $_POST['humeur'];
                            $activite = $_POST['activite'];
                            $promenade = $_POST['promenade'];
                            $remarques = isset($_POST['remarques']) ? $_POST['remarques'] : null;
                            $idEnfant = $_SESSION['idEnfant'];

                            $bdd = DB::getInstance();
                            $req = $bdd->prepare('CALL ajouterCalendrier(:sante, :temperature, :pleurs, :besoins, :repas, :aliments, :dodo, :humeur, :activite, :promenade, :remarques, CURDATE(), :idEnfant)');
                            $req->bindParam(":sante", $sante,PDO::PARAM_STR );
                            $req->bindParam(":temperature", $temp,PDO::PARAM_INT);
                            $req->bindParam(":pleurs", $pleurs,PDO::PARAM_STR);
                            $req->bindParam(":besoins", $besoin,PDO::PARAM_STR);
                            $req->bindParam(":repas", $repas,PDO::PARAM_STR);
                            $req->bindParam(":aliments", $aliment,PDO::PARAM_STR);
                            $req->bindParam(":dodo", $dodo,PDO::PARAM_STR);
                            $req->bindParam(":humeur", $humeur,PDO::PARAM_STR);
                            $req->bindParam(":activite", $activite,PDO::PARAM_STR);
                            $req->bindParam(":promenade", $promenade,PDO::PARAM_STR);
                            $req->bindParam(":remarques", $remarques,PDO::PARAM_STR);
                            $req->bindParam(":idEnfant", $idEnfant,PDO::PARAM_INT);
                            $req->execute();
                            echo '<div class="alert alert-success mt-3">Données du jour enregistrées</div>';
                        }
                        ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(Membres::getType() == "parent"): ?>
    <div class="container-fluid">
        <div class="card mt-5 text-center">
            <div class="card-body">
                <h1 class="card-title mb-4">Calendrier journalier</h1>
                <div class="card-text">
                    <?php
                    $bdd = DB::getInstance();
                    $req = $bdd->query('CALL recupererEnfant('.$_SESSION['id'].')');
                    ?>
                    <?php if($req->rowCount() != 0): ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Prénom</th>
                            <th scope="col">Santé</th>
                            <th scope="col">Température</th>
                            <th scope="col">Pleures</th>
                            <th scope="col">Besoins</th>
                            <th scope="col">Repas</th>
                            <th scope="col">Alimentation</th>
                            <th scope="col">Dodo</th>
                            <th scope="col">Humeur</th>
                            <th scope="col">Activité</th>
                            <th scope="col">Promenade</th>
                            <th scope="col">Remarques eventuelles</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($req->rowCount() != 0) {
                        foreach($req as $donnees) {
                            $idEnfant = $donnees['id'];
                            $result[$idEnfant] = array(
                                'enfPrenom' => $donnees['enfPrenom'],
                                'sante' => $donnees['sante'],
                                'temperature' => $donnees['temperature'],
                                'pleurs' => $donnees['pleurs'],
                                'besoins' => $donnees['besoins'],
                                'repas' => $donnees['repas'],
                                'aliments' => $donnees['aliments'],
                                'dodo' => $donnees['dodo'],
                                'humeur' => $donnees['humeur'],
                                'activite' => $donnees['activite'],
                                'promenade' => $donnees['promenade'],
                                'remarques' => $donnees['remarques'],
                                'date' => $donnees['date'],
                            );
                            echo '
                        <tr>
                            <th>'.$result[$idEnfant]["enfPrenom"].'</th>
                            <th>'.$result[$idEnfant]["sante"].'</th>
                            <th>'.$result[$idEnfant]["temperature"].'</th>
                            <th>'.$result[$idEnfant]["pleurs"].'</th>
                            <th>'.$result[$idEnfant]["besoins"].'</th>
                            <th>'.$result[$idEnfant]["repas"].'</th>
                            <th>'.$result[$idEnfant]["aliments"].'</th>
                            <th>'.$result[$idEnfant]["dodo"].'</th>
                            <th>'.$result[$idEnfant]["humeur"].'</th>
                            <th>'.$result[$idEnfant]["activite"].'</th>
                            <th>'.$result[$idEnfant]["promenade"].'</th>
                            <th>'.$result[$idEnfant]["remarques"].'</th>
                            <!--<th>'.$result[$idEnfant]["date"].'</th>-->
                        </tr>
                            ';
                        }
                        }
                        ?>
                        </tbody>
                    </table>


                    <?php endif; ?>
                    <?php

                        $weeks = $bdd->query('CALL recupererEnfant('.$_SESSION['id'].')');
                    ?>

                    <?php if($req->rowCount() == 0): ?>
                    <div class="alert alert-primary">L'assistante maternelle n'a pas encore fait son compte rendu hebdomadaire</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
