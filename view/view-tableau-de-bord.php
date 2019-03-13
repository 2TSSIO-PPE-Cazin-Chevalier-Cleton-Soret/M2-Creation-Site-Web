<div class="container mt-5">
    <div class="card text-center">
        <div class="card-body">
            <?php
            $bdd = DB::getInstanceBDD()->getBDD();
            $req = $bdd->query('SELECT type FROM membres WHERE id='.$_SESSION['id'].'');
            while($donnees = $req->fetch()) {
                $type = $donnees['type'];
            }
            ?>
            <h1 class="card-title">Bienvenue sur votre tableau de bord <span style="color: #2980b9;"><?= $_SESSION['pseudo']; ?></span></h1>
            <div class="row">
                <div class="card mx-auto m-4 pl-4 pr-4 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Modifier les informations de votre compte</h5>
                        <a class="btn btn-primary" href="modifier-compte.php">Accéder à vos informations</a>
                    </div>
                </div>
                <?php if($type == "assistante"): ?>
                    <div class="card mx-auto m-4 pl-4 pr-4 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Voir les enfants gérés</h5>
                            <form action="choix_nounou.php">
                                <div class="form-group">
                                    <select name="nom" id="nom" class="form-control">
                                        <?php
                                        $bdd = DB::getInstanceBDD()->getBDD();
                                        $req = $bdd->query('SELECT * FROM enfants WHERE choix_nounou = '.$_SESSION['id'].'');
                                        while($donnees = $req->fetch()) {
                                            echo '<option value="'.$donnees['nom'].'">'.$donnees['nom'].'</option>';
                                        }
                                        ?>
                                        <?php
                                        var_dump($_SESSION['pseudo']);
                                        ?>
                                    </select>
                                    <button class="btn btn-primary mt-2">Accéder aux informations de l'enfant</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($type == "parent"): ?>
                    <div class="card mx-auto m-4 pl-4 pr-4 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Choisir votre nounou</h5>
                            <form action="choix_nounou.php">
                                <div class="form-group">
                                    <select name="nom" id="nom" class="form-control">
                                    <?php
                                    $bdd = DB::getInstanceBDD()->getBDD();
                                    $req = $bdd->query('SELECT * FROM membres WHERE type="assistante"');
                                    while($donnees = $req->fetch()) {
                                        echo '<option value="'.$donnees['nom'].'">'.$donnees['nom'].'</option>';
                                    }
                                    ?>
                                    </select>
                                    <button class="btn btn-primary mt-2">Accéder aux informations de l'enfant</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>