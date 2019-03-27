<?php
$form = new Form();
?>

<div class="container">
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h1 class="card-title mb-4">Modifier les informations relatives à vos enfants</h1>
            <div class="card-text px-4">
                <div class="container">
                        <form action="gerer-enfant.php" method="post">
                            <div class="row">
                            <?php
                            $bdd = DB::getInstance();
                            $req = $bdd->query('CALL recupererInformationsUtilisateur('.$_SESSION['id'].')');
                            while($donnees = $req->fetch()) {
                                $nbrEnfant = $donnees['nbrEnfant'];
                                if($donnees['choix_nounou'] == 0) {
                                    echo '<div class="alert alert-danger">Vous devez choisir une nounou</div>';
                                    die();
                                }
                            }
                            $enfantsEnregistres = $bdd->query('CALL recupererNombreEnfantDeLUtilisateur('.$_SESSION['id'].')')->fetch();
                            $afficherOuNon = $enfantsEnregistres[0];
                            for($i = 0;$i < $nbrEnfant; $i++): ?>
                            <div class="col-lg-6">
                                <h1>Enfant <?= $i+1 ?></h1>
                                <div class="form-group">
                                    <input type="text" name="nom[]" placeholder="Nom de l'enfant" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prenom[]" placeholder="Prénom de l'enfant" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="age[]" placeholder="Âge de l'enfant" class="form-control">
                                </div>
                            </div>
                            <?php endfor; ?>
                                <button type="submit" class="btn btn-primary btn-block mt-3">Valider les informations</button>
                            </div>
                        </form>
                </div>
                        <?php

                        if(isset($_POST["nom"]) && is_array($_POST["prenom"]) && is_array($_POST["age"])){
                            if(isset($_POST["nom"]) && is_array($_POST["nom"]) &&
                                isset($_POST["prenom"]) && is_array($_POST["prenom"]) &&
                                isset($_POST["age"]) && is_array($_POST["age"])){
                                foreach($_POST['nom']as $key => $value ) {
                                    $noms[$key] = $value;
                                }
                                foreach($_POST['prenom'] as $key => $value ) {
                                    $prenoms[$key] = $value;
                                }
                                foreach($_POST['age'] as $key => $value ) {
                                    $ages[$key] = $value;
                                }
                            }
                            $choix = $bdd->query('CALL recupererInformationsUtilisateur('.$_SESSION['id'].')');
                            while($donnees = $choix->fetch()) {
                                $idNounou = $donnees['choix_nounou'];
                                $nbrEnfant = $donnees['nbrEnfant'];
                            }
                            for($i=0; $i<$nbrEnfant; $i++) {
                                ${'req' . $i} = $bdd->prepare('CALL ajouterEnfant(:nom, :prenom, :age, :idParent, :idNounou)');
                                ${'req' . $i}->bindParam(":nom", $noms[$i]);
                                ${'req' . $i}->bindParam(":prenom", $prenoms[$i]);
                                ${'req' . $i}->bindParam(":age", $ages[$i]);
                                ${'req' . $i}->bindParam(":idParent", $_SESSION['id']);
                                ${'req' . $i}->bindParam(":idNounou", $idNounou);
                                ${'req' . $i}->execute();
                            }
                            echo '<div class="alert alert-success mt-3">Vos '.$nbrEnfant.' enfants ont bien été ajoutés</div>';
                        }
                        ?>
                </form>
            </div>
        </div>
    </div>
</div>
