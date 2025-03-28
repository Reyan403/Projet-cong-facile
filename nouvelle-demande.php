<?php
include 'includes/affichage-avatar.php';
include 'includes/db.php';

$sql = "SELECT id, name FROM request_type";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$request_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type_demande = $_POST['type_demande'] ?? '';
}

include 'includes/affichage-erreurs.php';
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
            <a href="./historique-demandes.php">Historique des demandes</a>
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
                    <a href="./historique-demandes.php">Historique des demandes</a>
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
                <form method="POST" action="nouvelle-demande.php" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="type-demande">Type de demande - champ obligatoire</label>
        <select id="type-demande" name="type_demande">
            <option value="" <?= empty($type_demande) ? 'selected' : '' ?>>Sélectionner un type</option>
            <?php foreach ($request_types as $request_type): ?>
                <option value="<?= $request_type['id'] ?>" <?= ($type_demande == $request_type['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($request_type['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="error"><?= $error['type_demande'] ?? ''; ?></span>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group">
                            <label for="date-debut">Date début - champ obligatoire</label>
                            <input type="datetime-local" id="date-debut" name="date_debut" value="<?php echo htmlspecialchars($date_debut); ?>" onchange="calculerJours()">
                            <span class="error"> <?php echo $error['date_debut'] ?? ''; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="date-fin">Date de fin - champ obligatoire</label>
                            <input type="datetime-local" id="date-fin" name="date_fin" value="<?php echo htmlspecialchars($date_fin); ?>" onchange="calculerJours()">
                            <span class="error"> <?php echo $error['date_fin'] ?? ''; ?> </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jours-demandes">Nombre de jours demandés</label>
                        <input type="number" id="jours-demandes" name="jours_demandes" value="0" <?= htmlspecialchars($jours_demandes) ?> min="0" readonly>
                    </div>

        
                    <div class="form-group">
                        <label for="receipt_file">Justificatif si applicable</label>
                        <input type="file" name="receipt_file" id="receipt_file" hidden onchange="updateFileName(this)">
                        <button type="button" class="upload-btn" onclick="document.getElementById('receipt_file').click();">
                            <img src="./PNG/fichier-texte.png" alt=""> <span id="file-name">Sélectionner un fichier</span>
                        </button>
                        <span class="error"><?php echo $error['file'] ?? ''; ?></span>
                    </div>
       
                    <div class="form-group">
                        <label for="commentaire">Commentaire supplémentaire</label>
                        <textarea id="commentaire" name="commentaire" placeholder="Si congé exceptionnel ou sans solde, vous pouvez préciser votre demande."></textarea>
                    </div>
                    <button type="submit" class="button-connexion">Soumettre ma demande*</button>
                </form>
                <p>
                    *En cas d'erreur de saisie ou de changements, vous pourrez modifier votre demande tant que celle-ci n'a pas été validée par le manager.
                </p>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>