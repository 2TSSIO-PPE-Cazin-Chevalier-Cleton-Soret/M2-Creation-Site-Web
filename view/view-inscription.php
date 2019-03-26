<?php
$form = new Form();
?>
<div class="container">
    <div class="row">
        <div class="card mt-5 px-5 py-3 d-flex mx-auto align-self-center">
            <div class="card-body">
                <h1 class="card-title">Bienvenue sur la plateforme d'inscription de la RAM</h1>
                <div class="card-text mx-auto">
                    <form action="inscription.php" method="post" id="form">
                        <?= $form->createInput("pseudo", "text", "Votre pseudo") ?>
                        <?= $form->createInput("mdp", "password", "Votre mot de passe") ?>
                        <?= $form->createInput("nom", "text", "Votre nom") ?>
                        <?= $form->createInput("prenom", "text", "Votre prénom") ?>
                        <?= $form->createInput("cp", "number", "Votre code postal") ?>
                        <?= $form->createInput("ville", "text", "Votre ville") ?>
                        <?= $form->createInput("pays", "text", "Votre pays") ?>
                        <?= $form->createInput("email", "email", "Votre adresse email") ?>
                        <div class="form-check">
                            <input type="radio" id="parent" name="type" value="parent">
                            <label for="parent">Je suis un parent</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="assistante" name="type" value="assistante">
                            <label for="assistante">Je suis une assistante maternelle</label>
                        </div>
                        <?= $form->createInput("nbrEnfant", "number", "Votre nombre d'enfant(s) à charge") ?>
                        <div class="form-group">
                            <select name="choix_nounou" id="nom" class="form-control" style="display: none;">

                                <?php
                                /**
                                 * TODO: Problème ici, si il est retiré, tout marche bien
                                 * C'est causé par les <?= ?>
                                 * Restructurer le code pour éviter de l'écrire directement dans le code en brut
                                 */
                                 Membres::getAssistantes();
                                ?>
                            </select>
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
                                && isset($_POST['type'])
                                && isset($_POST['choix_nounou'])) {
                                $bdd = DB::getInstance();
                                $req = $bdd->prepare('SELECT COUNT(*) FROM membres WHERE pseudo = ?');
                                $req->execute(array(strtolower($_POST['pseudo'])));
                                if ($req->fetchColumn() != 0) {
                                    echo '<div class="alert alert-warning mt-3">Ce pseudo est déjà utilisé</div>';
                                }
                                else {
                                    $pseudo = $_POST['pseudo'];
                                    $mdp = $_POST['mdp'];
                                    $nom = $_POST['nom'];
                                    $prenom = $_POST['prenom'];
                                    $cp = $_POST['cp'];
                                    $ville = $_POST['ville'];
                                    $pays = $_POST['pays'];
                                    $email = $_POST['email'];
                                    $nbrEnfant = isset($_POST['nbrEnfant']) ? $_POST['nbrEnfant'] : null;
                                    $type = $_POST['type'];
                                    $choix_nounou = isset($_POST['choix_nounou']) ? $_POST['choix_nounou'] : null;
                                    $req = $bdd->prepare('INSERT INTO membres(pseudo, mdp, nom, prenom, cp, ville, pays, email, nbrEnfant, type, choix_nounou) VALUES(:pseudo, :mdp, :nom, :prenom, :cp, :ville, :pays, :email, :nbrEnfant, :type, :choix_nounou)');
                                    $req->execute(array(
                                        'pseudo' => $pseudo,
                                        'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
                                        'nom' => $nom,
                                        'prenom' => $prenom,
                                        'cp' => $cp,
                                        'ville' => $ville,
                                        'pays' => $pays,
                                        'email' => $email,
                                        'nbrEnfant' => $nbrEnfant,
                                        'type' => $type,
                                        'choix_nounou' => $choix_nounou,
                                    ));
                                    /**
                                     * Todo: Régler le problème de header already sent lors de l'inscription
                                     */
                                    echo("<script>location.href = 'connexion.php';</script>");
                                    exit;
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('input[name="nbrEnfant"]').css('display','none');
        $('input[id="assistante"]').click(function() {
            $('input[name="nbrEnfant"]').css('display','none');
            $('select[name="choix_nounou"]').css('display','none');
            console.log('assistante');
        });
        $('input[id="parent"]').click(function() {
            $('input[name="nbrEnfant"]').css('display','block').fadeIn('slow');
            $('select[name="choix_nounou"]').css('display','block').fadeIn('slow');
            console.log('parent');
        });
    });
</script>
