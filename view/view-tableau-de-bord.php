<div class="container mt-5">
    <div class="card text-center">
        <div class="card-body">
            <?php
            $bdd = DB::getInstance();
            $req = $bdd->query('CALL recupererInformationsUtilisateur('.$_SESSION['id'].')');
            while($donnees = $req->fetch()) {
                $type = $donnees['type'];
                $nbrEnfant = $donnees['nbrEnfant'];
            }
            ?>
            <h1 class="card-title">Bienvenue sur votre tableau de bord <span style="color: #2980b9;"><?= $_SESSION['pseudo']; ?></span></h1>
            <div class="row mx-auto justify-content-center">
                <div class="col-lg-4 p-0">
                <div class="card m-4 pl-4 pr-4 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Accéder à votre profil</h5>
                        <a class="btn btn-primary" href="modifier-compte.php">Accéder à votre profil</a>
                    </div>
                </div>
                </div>
                <?php
                $req = $bdd->query('
                                    SELECT count(*)
                                    FROM membres AS m
                                    INNER JOIN enfants AS e ON m.id = e.idParent
                                    WHERE id='.$_SESSION['id'].'');
                while($count = $req->fetch()) {
                    $nbrEnfantCount = $count[0];
                }
                if($type == "parent" && $nbrEnfant == $nbrEnfantCount): ?>
                    <div class="col-lg-4 p-0">
                        <div class="card m-4 pl-4 pr-4 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Consulter le compte rendu hebdomadaire de vos enfants</h5>
                                <a class="btn btn-success" href="calendrier.php">Consulter le calendrier</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($type == "parent" && $nbrEnfant !== $nbrEnfantCount): ?>
                <div class="col-lg-4 p-0">
                        <div class="card m-4 pl-4 pr-4 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Vos enfants</h5>
                                <a class="btn btn-primary" href="gerer-enfant.php">Enregistrer vos enfants</a>
                            </div>
                        </div>
                </div>
                <?php endif; ?>
                <?php if($type == "assistante"): ?>
                <div class="col-lg-4 p-0">
                    <div class="card mx-auto m-4 pl-4 pr-4 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Gérer le calendrier</h5>
                            <form action="calendrier.php" method="post">
                                <div class="form-group">
                                    <select name="enfant" class="form-control">
                                        <?php
                                        $bdd = DB::getInstance();
                                        $req = $bdd->query('SELECT * FROM enfants WHERE idNounou = '.$_SESSION['id'].'');
                                        while($donnees = $req->fetch()) {
                                            echo '<option name="enfant" value="'.strtolower($donnees['idEnfant']).'">'.$donnees['prenom'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <button class="btn btn-primary mt-2">Remplir le calendrier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
