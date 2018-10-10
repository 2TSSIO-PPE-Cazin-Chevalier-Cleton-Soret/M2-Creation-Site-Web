<div class="main">
    <div class="section">
        <div class="section__title">
            <h1>Modifier les informations de votre compte</h1>
            <div class="section__form">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="text" name="pseudo" class="input-form" value="<?= $_SESSION['pseudo']; ?>">
                    <input type="password" class="input-form" name="mdp" placeholder="Votre mot de passe">
                    <input type="text" class="input-form" name="nom" placeholder="Votre nom">
                    <input type="text" class="input-form" name="prenom" placeholder="Votre prénom">
                    <input type="number" class="input-form" name="cp" placeholder="Votre code postal">
                    <input type="text" class="input-form" name="ville" placeholder="Votre ville">
                    <input type="text" class="input-form" name="pays" placeholder="Votre pays">
                    <input type="mail" class="input-form" name="email" placeholder="Votre adresse email" value="<?php  ?>">
                    <input type="number" class="input-form" name="nbrEnfant" placeholder="Nombre d'enfants à charge">
                    <label for="parent">Je suis un parent</label>
                    <input type="radio" id="parent" name="type" value="parent"><br>
                    <label for="assistante">Je suis une assistante maternelle</label>
                    <input type="radio" id="assistante" name="type" value="assistante">
                    <input type="submit" name="submit" class="button-submit-form" value="Valider les modifications">

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