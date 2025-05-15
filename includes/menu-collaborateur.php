<div class="menu" id="menu">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
            <a href="C-accueil.php">Accueil</a>
            <a href="C-nouvelle-demande.php">Nouvelle demande</a>
            <a href="C-historique-demandes.php">Historique des demandes</a>
            <a href="C-mes-informations.php">Mes informations</a>
            <a href="C-preferences.php">Mes préférences</a>
            <a href="deconnexion.php">Déconnexion</a>
    </div>

    <section class="bloc">
        <div class="sidebar">
            <div class="content-menu">
                <div class="other-menu">
                    <a href="C-accueil.php">Accueil</a>
                    <a href="C-nouvelle-demande.php">Nouvelle demande</a>
                    <a href="C-historique-demandes.php">Historique des demandes</a>
                    <hr class="separator">
                    <a href="C-mes-informations.php">Mes informations</a>
                    <a href="C-preferences.php">Mes préférences</a>
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