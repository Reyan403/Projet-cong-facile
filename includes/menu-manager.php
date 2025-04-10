<?php
include 'includes/count-requests.php';
?>

<div class="menu" id="menu">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
            <a href="M-accueil2.php">Accueil</a>
            <a href="M-demandes-attente.php">Demandes en attente <span class="number-requests"><?= $result['total'] ?></span></a>
            <a href="M-historique-demandes-mana.php">Historique des demandes</a>
            <a href="">Mon équipe</a>
            <a href="">Statistiques</a>
            <a href="M-type_de_demandes.php">Types de demandes</a>
            <a href="">Directions/Services</a>
            <a href="">Managers</a>
            <a href="M-postes.php">Postes</a>
            <a href="">Mes informations</a>
            <a href="">Mes préférences</a>
            <a href="deconnexion.php">Déconnexion</a>
    </div>

    <section class="bloc">
        <div class="sidebar">
            <div class="content-menu">
                <div class="other-menu">
                    <a href="M-accueil2.php">Accueil</a>
                    <a href="M-demandes-attente.php">Demandes en attente <span class="number-requests"><?= $result['total'] ?></span></a>
                    <a href="M-historique-demandes-mana.php">Historique des demandes</a>
                    <a href="">Mon équipe</a>
                    <a href="">Statistiques</a>
                    <hr class="separator">
                    <a href="">Mes informations</a>
                    <a href="">Mes préférences</a>
                </div>
                <details>
                    <summary>Administration</summary>
                        <div class="choix">
                            <a href="M-type_de_demandes.php">Types de demandes</a>
                            <a href="">Directions/Services</a>
                            <a href="">Managers</a>
                            <a href="M-postes.php">Postes</a>
                        </div>
                </details>
                <div class="other-menu">
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