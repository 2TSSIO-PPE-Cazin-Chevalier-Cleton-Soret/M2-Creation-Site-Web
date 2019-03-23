<?php
$form = new Form();
$members = new Membres();
?>
<div class="container">
    <div class="card mt-5 text-center position-static">
        <div class="card-body">
            <h1 class="card-title mb-4">Modifier les informations de votre compte</h1>
            <div class="card-text px-4">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <?= $form->createInput("pseudo", "text") ?>
                    <?= $form->createInput("mdp", "password", "Votre mot de passe") ?>
                    <?= $form->createInput("nom", "text") ?>
                    <?= $form->createInput("prenom", "text") ?>
                    <?= $form->createInput("cp", "number") ?>
                    <?= $form->createInput("ville", "text") ?>
                    <?= $form->createInput("pays", "text") ?>
                    <?= $form->createInput("email", "mail") ?>
                    <?php
                    $id = $members->getID();
                    $type = $members->getType();
                    if($type == "parent"): ?>
                    <div class="form-group">
                        <select name="choix_nounou" id="nom" class="form-control">
                            <option value="<?= $members->getID(); ?>"><?= $members->getType(); ?></option>
                        </select>
                    </div>
                    <?php endif; ?>
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Valider les modifications">
                    <?php
                    if(isset($_POST['submit'])) {
                        $bdd = db::getInstance();
                        $pseudo = htmlspecialchars($_POST['pseudo']);
                        $mdp = $_POST['mdp'];
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $cp = $_POST['cp'];
                        $ville = $_POST['ville'];
                        $pays = $_POST['pays'];
                        $email = $_POST['email'];
                        $choix_nounou = isset($_POST['choix_nounou']) ? $_POST['choix_nounou'] : null;
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
                        if(!empty($choix_nounou)) {
                            if ($type == "parent") {
                                $req = $bdd->prepare('UPDATE membres SET choix_nounou=:choix_nounou WHERE id = ' . $_SESSION['id'] . '');
                                $req2 = $bdd->prepare('UPDATE enfants
                                                                SET idNounou=:idNounou 
                                                                WHERE idNounou = ' . $_SESSION['choix_nounou'] . ' AND idParent = ' . $idParent);
                                $req->bindValue(":choix_nounou", $choix_nounou);
                                $req2->bindValue(":idNounou", $choix_nounou);
                                $_SESSION['choix_nounou'] = $choix_nounou;
                                $req2->execute();
                                var_dump($_SESSION['choix_nounou']);
                                var_dump('id de session : '.$_SESSION['id']);
                            }
                        }
                        $req->execute();
                        echo '
  <div class="toast" style="position: absolute; bottom: 70px; right: 10px;opacity: 1;" data-autohide="false">
    <div class="toast-header">
      <svg class="bd-placeholder-img rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
        <rect width="100%" height="100%" fill="#28a745"></rect>
      </svg>
      <strong class="mr-auto">Notification</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body success">
      La modification à bien été enregistré
    </div>
  </div>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
