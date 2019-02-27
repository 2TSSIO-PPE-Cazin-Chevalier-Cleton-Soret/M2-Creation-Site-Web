<?php $form = new Form(); ?>
<div class="container">
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h1 class="card-title mb-4">Modifier les informations de votre compte</h1>
            <div class="card-text px-4">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <?= $form->createInput("pseudo"); ?>
                    <?= $form->createInput("mdp", "password", "Votre mot de passe"); ?>
                    <?= $form->createInput("nom") ?>
                    <?= $form->createInput("prenom") ?>
                    <?= $form->createInput("cp") ?>
                    <?= $form->createInput("ville") ?>
                    <?= $form->createInput("pays") ?>
                    <?= $form->createInput("email") ?>
                    <?= $form->createInput("nbrEnfant", "number") ?>
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
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Valider les modifications">
                    <?php
                    if(isset($_POST['submit'])) {
                        $bdd = db::getInstanceBDD()->getBDD(); //Créer une nouvelle instance PDO, view-db = nom de la classe, getInstanceBDD() = nom de la méthode, getBDD = récupére la méthode
                        $pseudo = htmlspecialchars($_POST['pseudo']);
                        $mdp = $_POST['mdp'];
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $cp = $_POST['cp'];
                        $ville = $_POST['ville'];
                        $pays = $_POST['pays'];
                        $email = $_POST['email'];
                        $nbrEnfant = $_POST['nbrEnfant'];
                        if(!empty($pseudo)) {
                            $req = $bdd->prepare('UPDATE membres SET pseudo=:pseudo WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
                            $_SESSION['pseudo'] = $pseudo;
                        };
                        if(!empty($mdp)) {
                            $req = $bdd->prepare('UPDATE membres SET mdp=:mdp WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":mdp", password_hash($mdp, PASSWORD_DEFAULT), PDO::PARAM_STR);
                        };
                        if(!empty($nom)) {
                            $req = $bdd->prepare('UPDATE membres SET nom=:nom WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":nom", $nom, PDO::PARAM_STR);
                        };
                        if(!empty($prenom)) {
                            $req = $bdd->prepare('UPDATE membres SET prenom=:prenom WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":prenom", $prenom, PDO::PARAM_STR);
                        };
                        if(!empty($cp)) {
                            $req = $bdd->prepare('UPDATE membres SET cp=:cp WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":cp", $cp, PDO::PARAM_STR);
                        };
                        if(!empty($ville)) {
                            $req = $bdd->prepare('UPDATE membres SET ville=:ville WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":ville", $ville, PDO::PARAM_STR);
                        };
                        if(!empty($pays)) {
                            $req = $bdd->prepare('UPDATE membres SET pays=:pays WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":pays", $pays, PDO::PARAM_STR);
                        };
                        if(!empty($email)) {
                            $req = $bdd->prepare('UPDATE membres SET email=:email WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":email", $email, PDO::PARAM_STR);
                        };
                        if(!empty($nbrEnfant)) {
                            $req = $bdd->prepare('UPDATE membres SET nbrEnfant=:nbrEnfant WHERE id = '.$_SESSION['id'].'');
                            $req->bindValue(":nbrEnfant", $nbrEnfant, PDO::PARAM_STR);
                        };
                        $req->execute();
                        echo '<div class="alert alert-success">Les données ont bien été modifiés!</div>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>