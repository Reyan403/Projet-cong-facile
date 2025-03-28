<div class="menu" id="menu">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
            <a href="">Accueil</a>
            <a href="./nouvelle-demande.php">Nouvelle demande</a>
            <a href="./historique-demandes.php">Historique des demandes</a>
            <a href="">Mes informations</a>
            <a href="">Mes préférences</a>
            <a href="deconnexion.php">Déconnexion</a>
    </div>

    <section class="bloc">
        <div class="sidebar">
            <div class="content-menu">
                <div class="other-menu">
                    <a href="./accueil.php">Accueil</a>
                    <a href="./nouvelle-demande.php">Nouvelle demande</a>
                    <a href="./historique-demandes.php">Historique des demandes</a>
                    <hr class="separator">
                    <a href="">Mes informations</a>
                    <a href="">Mes préférences</a>
                    <a href="deconnexion.php">Déconnexion</a>
                </div>
            </div>
            <div class="character-menu">
                <div class="img-caharacter">
                    <img src="./PNG/download.png" alt="">
                </div>
                <div class="info-employe">
                    <p><?= htmlspecialchars($firstName) . ' ' . htmlspecialchars($lastName) ?></p>
                    <span><?= ($role === 'manager') ? 'Manager' : 'Collaborateur' ?></span>
                </div>
            </div>
        </div>