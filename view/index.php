<div class="main">
    <div class="register">
        <div class="register__title">
            <h1>Bienvenue sur la plateforme d'inscription de la RAM</h1>
        </div>
        <div class="register__form">
            <form action="view/inscription.php" method="post">
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
            </form>
        </div>
    </div>
</div>