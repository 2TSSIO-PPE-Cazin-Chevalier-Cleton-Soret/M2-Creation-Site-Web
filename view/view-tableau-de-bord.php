<div class="container mt-5">
    <div class="card border text-center">
        <div class="card-body">
            <h1 class="card-title">Bienvenue sur votre tableau de bord <span style="color: #2980b9;"><?= $_SESSION['pseudo']; ?></span></h1>
            <div class="row">
                <div class="card mx-auto m-4 pl-4 pr-4 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Modifier les informations de votre compte</h5>
                        <a class="btn btn-primary" href="modifier-compte.php">Accéder à vos informations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>