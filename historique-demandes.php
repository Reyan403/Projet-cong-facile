<?php
include 'includes/affichage-avatar.php'
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <title>Mentalworks</title>
    </head>
<body>
    <div class="background-gray"></div>
    <header>
        <div class="logo-mentalworks">
            <img src="./PNG/logo-mentalworks-blanc.png" alt="">
        </div>
        <div class="burger-menu" onclick="toggleMenu()">
            <img src="./PNG/burger-bar (1).png" alt="Menu">
        </div>
    </header>
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
        <div class="content-bloc2">
            <h1>
                Historique des demandes
            </h1>
            <table>
                <thead>
                <tr>
                    <div class="input">
                    <th>Type de demande <img src="./PNG/fleche-droite (8).png" alt=""><img src="./PNG/fleche-droite (8).png" alt=""> 
                    </div>
                    <input type="search"></th> 
                    <th>Demandé le <input type="search"></th>
                    <th>Date de début <input type="search"></th>
                    <th>Date de fin <input type="search"></th>
                    <th>Nb de jours <input type="search"></th>
                    <th>Statut <input type="search"></th>
                    <th></th>
                </tr>
                </thead>
            <tbody>
                <tr>
                    <td>Congé payé</td>
                    <td>10/12/2024 8h00</td>
                    <td>19/12/2024 8h00</td>
                    <td>23/12/2024 18h00</td>
                    <td>3 jours</td>
                    <td>Accepté</td>
                    <td><button class="details-btn">Détails</button></td>
                </tr>
                <tr>
                    <td>Congé sans solde</td>
                    <td>11/11/2024 8h00</td>
                    <td>29/11/2024 8h00</td>
                    <td>30/11/2024 8h00</td>
                    <td>2 jours</td>
                    <td>En cours</td>
                    <td><button class="details-btn">Détails</button></td>
                </tr>
                <tr>
                    <td>Congé maladie</td>
                    <td>29/08/2024 8h00</td>
                    <td>02/09/2024 8h00</td>
                    <td>06/09/2024 18h00</td>
                    <td>5 jours</td>
                    <td>Accepté</td>
                    <td><button class="details-btn">Détails</button></td>
                </tr>
                <tr>
                    <td>Congé sans solde</td>
                    <td>05/08/2024 13h30</td>
                    <td>09/08/2024 13h30</td>
                    <td>09/08/2024 18h00</td>
                    <td>0,5 jours</td>
                    <td>Accepté</td>
                    <td><button class="details-btn">Détails</button></td>
                </tr>
            </tbody>
        </table>
        </div>
    </section> 
    <script src="script.js"></script>

</body>
</html>