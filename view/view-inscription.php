<?php $form = new Form(); ?>
<div class="container">
    <div class="card mt-5 px-5 py-3 text-center">
        <div class="card-body">
            <h1 class="card-title">Bienvenue sur la plateforme d'inscription de la RAM</h1>
            <div class="card-text mx-auto">
                <form action="inscription.php" method="post">
                    <?= $form->createInput("pseudo", "text", "Votre pseudo") ?>
                    <?= $form->createInput("mdp", "password", "Votre mot de passe") ?>
                    <?= $form->createInput("nom", "text", "Votre nom") ?>
                    <?= $form->createInput("prenom", "text", "Votre prénom") ?>
                    <?= $form->createInput("cp", "number", "Votre code postal") ?>
                    <?= $form->createInput("ville", "text", "Votre ville") ?>
                    <?= $form->createInput("pays", "text", "Votre pays") ?>
                    <?= $form->createInput("email", "mail", "Votre adresse email") ?>
                    <?= $form->createInput("nbrEnfant", "number", "Votre nombre d'enfant(s) à charge") ?>
                    <div class="text-center">
                        <div class="form-control border-0 text-center d-inline">
                            <input type="radio" id="parent" name="type" value="parent">
                            <label for="parent">Je suis un parent</label>
                        </div>
                        <div class="form-control border-0 text-center d-inline">
                            <input type="radio" id="assistante" name="type" value="assistante">
                            <label for="assistante">Je suis une assistante maternelle</label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Valider l'inscription">

                    <?php
                    if(isset($_POST)) {
                        if (isset($_POST['pseudo'])
                            && isset($_POST['mdp'])
                            && isset($_POST['nom'])
                            && isset($_POST['prenom'])
                            && isset($_POST['cp'])
                            && isset($_POST['ville'])
                            && isset($_POST['pays'])
                            && isset($_POST['email'])
                            && isset($_POST['nbrEnfant'])
                            && isset($_POST['type'])) {

                            $bdd = DB::getInstanceBDD()->getBDD(); //Créer une nouvelle instance PDO, view-db = nom de la classe, getInstanceBDD() = nom de la méthode, getBDD = récupére la méthode
                            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                            $req = $bdd->prepare('SELECT COUNT(*) FROM membres WHERE pseudo = ?');
                            $req->execute(array(strtolower($_POST['pseudo'])));
                            if ($req->fetchColumn() != 0) {}
                            else {
                                $pseudo = $_POST['pseudo'];
                                $mdp = $_POST['mdp'];
                                $nom = $_POST['nom'];
                                $prenom = $_POST['prenom'];
                                $cp = $_POST['cp'];
                                $ville = $_POST['ville'];
                                $pays = $_POST['pays'];
                                $email = $_POST['email'];
                                $nbrEnfant = $_POST['nbrEnfant'];
                                $type = $_POST['type'];
                                $req = $bdd->prepare('INSERT INTO membres(pseudo, mdp, nom, prenom, cp, ville, pays, email, nbrEnfant, type) VALUES(:pseudo, :mdp, :nom, :prenom, :cp, :ville, :pays, :email, :nbrEnfant, :type)');$req->execute(array(
                                    'pseudo' => $pseudo,
                                    'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
                                    'nom' => $nom,
                                    'prenom' => $prenom,
                                    'cp' => $cp,
                                    'ville' => $ville,
                                    'pays' => $pays,
                                    'email' => $email,
                                    'nbrEnfant' => $nbrEnfant,
                                    'type' => $type
                                ));
                                header('Location: connexion.php');
                            }
                        }
                    }
                    else {
                        echo "coucou";
                    }

                    ?>
                </form>
            </div>
        </div>
    </div>
</div>