<?php
$form = new Form();
?>

<div class="container">
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h1 class="card-title mb-4">Modifier les informations relatives à vos enfants</h1>
            <div class="card-text px-4">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="gerer-enfant.php" method="post">
                            <?php
                            $bdd = DB::getInstance();
                            $req = $bdd->query('SELECT * FROM membres WHERE id = '.$_SESSION['id'].'');
                            while($donnees = $req->fetch()) {
                                $nbrEnfant = $donnees['nbrEnfant'];
                                if($donnees['choix_nounou'] == 0) {
                                    echo '<div class="alert alert-danger">Vous devez choisir une nounou</div>';
                                    die();
                                }
                            }
                            for($i = 0;$i < $nbrEnfant; $i++): ?>
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
                                <hr>
                            <?php endfor; ?>
                            <button type="submit" class="btn btn-primary btn-block">Valider les informations</button>
                        </form>
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
                            $choix = $bdd->query('SELECT * FROM membres WHERE id = ' . $_SESSION['id']);
                            while($donnees = $choix->fetch()) {
                                $idNounou = $donnees['choix_nounou'];
                                $nbrEnfant = $donnees['nbrEnfant'];
                            }
                            for($i=0; $i<$nbrEnfant; $i++) {
                                ${'req' . $i} = $bdd->prepare('INSERT INTO enfants(nom, prenom, age, idParent, idNounou) VALUES (?, ?, ?, ?, ?)');
                                ${'req' . $i}->bindParam(1, $noms[$i]);
                                ${'req' . $i}->bindParam(2, $prenoms[$i]);
                                ${'req' . $i}->bindParam(3, $ages[$i]);
                                ${'req' . $i}->bindParam(4, $_SESSION['id']);
                                ${'req' . $i}->bindParam(5, $idNounou);
                                ${'req' . $i}->execute();
                            }
                            echo 'Les enfants <span class="text-italic">' . implode(", ", $noms) . '</span> ont bien été ajoutés';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
