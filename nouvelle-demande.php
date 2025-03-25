<?php
include 'includes/affichage-avatar.php';

$type_demande = $date_debut = $date_fin = $jours_demandes = "";
$error = [];

if($_SERVER ['REQUEST_METHOD'] == 'POST'){

    if (empty ($_POST ['type_demande'])){
        $error[] = "Veuillez choisir un type de demande";
    }

    if (empty ($_POST ['date_debut'])){
        $error[] = "Veuillez choisir une date de début";
    }

    if (empty ($_POST ['date_fin'])){
        $error[] = "Veuillez choisir une date de fin";
    }

    if (empty ($_POST ['jours_demandes'])){
        $error[] = "Veuillez choisir le nombre de jours que vous voulez";
    }
}
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
            <a href="accueil.php">Accueil</a>
            <a href="./nouvelle-demande.html">Nouvelle demande</a>
            <a href="">Historique des demandes</a>
            <a href="">Mes informations</a>
            <a href="">Mes préférences</a>
            <a href="deconnexion.php">Déconnexion</a>
    </div>

    <section class="bloc">
        <div class="sidebar">
            <div class="content-menu">
                <div class="other-menu">
                    <a href="accueil.php">Accueil</a>
                    <a href="./nouvelle-demande.php">Nouvelle demande</a>
                    <a href="">Historique des demandes</a>
                    <hr class="separator">
                    <a href="">Mes informations</a>
                    <a href="">Mes préférences</a>
                    <a href="deconnexion.php">Déconnexion</a>
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
        </div>
        <div class="content-bloc">
            <h1>
                Effectuer une nouvelle demande
            </h1>
            <div class="form-container">
                <form method="POST" action="historique-demandes.php">
                    <div class="form-group">
                        <label for="type-demande">Type de demande - champ obligatoire</label>
                        <select id="type-demande" required>
                            <option value="">Sélectionner un type</option>
                            <option value="">Congé payé</option>
                            <option value="">Congé maladie</option>
                            <option value="">Congé sans solde</option>
                        </select>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group">
                            <label for="date-debut">Date début - champ obligatoire</label>
                            <input type="date" id="date-debut" required>
                        </div>
                        <div class="form-group">
                            <label for="date-fin">Date de fin - champ obligatoire</label>
                            <input type="date" id="date-fin" required>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label for="jours-demandes">Nombre de jours demandés</label>
                        <input type="number" id="jours-demandes" value="0" min="0">
                    </div>
        
                    <div class="form-group">
                        <label for="justificatif">Justificatif si applicable</label>
                        <input type="file" id="justificatif" hidden>
                        <button type="button" class="upload-btn" onclick="document.getElementById('justificatif').click();">
                            <img src="./PNG/fichier-texte.png" alt=""> Sélectionner un fichier
                        </button>
                    </div>
        
                    <div class="form-group">
                        <label for="commentaire">Commentaire supplémentaire</label>
                        <textarea id="commentaire" placeholder="Si congé exceptionnel ou sans solde, vous pouvez préciser votre demande."></textarea>
                    </div>
                </form>
                <button type="submit" class="button-connexion">Soumettre ma demande*</button>
                <p>
                    *En cas d'erreur de saisie ou de changements, vous pourrez modifier votre demande tant que celle-ci n'a pas été validée par le manager.
                </p>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>