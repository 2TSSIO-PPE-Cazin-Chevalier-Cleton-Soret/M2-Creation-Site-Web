<div class="main">
    <div class="section">
        <div class="section__title">
            <h1>Bienvenue sur la plateforme d'inscription de la RAM</h1>
        </div>
        <div class="section__form">
            <form action="inscription.php" method="post">
                <input type="text" name="pseudo" class="input-form" placeholder="Votre pseudo">
                <input type="password" class="input-form" name="mdp" placeholder="Votre mot de passe">
                <input type="text" class="input-form" name="nom" placeholder="Votre nom">
                <input type="text" class="input-form" name="prenom" placeholder="Votre prénom">
                <input type="mail" class="input-form" name="email" placeholder="Votre adresse email">
                <input type="number" class="input-form" name="nbrEnfant" placeholder="Nombre d'enfants à charge">

                <label for="parent">Je suis un parent</label>
                <input type="radio" id="parent" name="type" value="parent"><br>

                <label for="assistante">Je suis une assistante maternelle</label>
                <input type="radio" id="assistante" name="type" value="assistante">

                <input type="submit" class="button-submit-form" value="Valider l'inscription">
                <?php
                if(isset($_POST)) {
                    if (isset($_POST['pseudo'])
                        && isset($_POST['mdp'])
                        && isset($_POST['nom'])
                        && isset($_POST['prenom'])
                        && isset($_POST['email'])
                        && isset($_POST['nbrEnfant'])
                        && isset($_POST['type'])) {

                        $bdd = db::getInstanceBDD()->getBDD(); //Créer une nouvelle instance PDO, view-db = nom de la classe, getInstanceBDD() = nom de la méthode, getBDD = récupére la méthode
                        $req = $bdd->prepare('SELECT COUNT(*) FROM membres WHERE pseudo = ?');
                        $req->execute(array(strtolower($_POST['pseudo'])));
                        if ($req->fetchColumn() != 0) {}
                        else {
                            $pseudo = $_POST['pseudo'];
                            $mdp = $_POST['mdp'];
                            $nom = $_POST['nom'];
                            $prenom = $_POST['prenom'];
                            $email = $_POST['email'];
                            $nbrEnfant = $_POST['nbrEnfant'];
                            $type = $_POST['type'];
                            $req = $bdd->prepare('INSERT INTO membres(pseudo, mdp, nom, prenom, email, nbrEnfant, type) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :nbrEnfant, :type)');$req->execute(array(
                                'pseudo' => $pseudo,
                                'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
                                'nom' => $nom,
                                'prenom' => $prenom,
                                'email' => $email,
                                'nbrEnfant' => $nbrEnfant,
                                'type' => $type
                            ));
                            header('Location: tableau-de-bord.php');
                            session_start();
                            $_SESSION['nom'] = $nom;
                            $_SESSION['prenom'] = $prenom;
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