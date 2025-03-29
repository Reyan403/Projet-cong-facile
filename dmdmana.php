<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
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
<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
        <div class="content-bloc">
            <h1>
                Demande de <?php $name ?>
            </h1>
            <h3>Demande du <?php $dateDemande ?></h3>
            <p>
                Type de demande : <?php $typeConge ?><br>
                Période : <?php $dateDebut ?> au <?php $dateFin ?><br>
                Nombre de jours : <?php $nbJours ?><br>
            </p>
            <form action="traitement.php" method="post">
            <label for="text">Commentaire supplémentaire</label>
                <div class="input-container">
                    <input type="text" id="text" name="text" placeholder="il faut mettre $commentairecollaborateur ici">
                </div>
            <br>
            </form>
            <button class="telechargement">Télécharger le justificatif <i class='bx bx-download'></i></button>
            <h1>
                Répondre à la demande
            </h1>
            
            
            <form action="traitement.php" method="post">
            <label for="text"><p>Saisir un commentaire</p></label>
                <div class="input-container-com2">
                    <input type="text" id="text" name="text">
                </div>
            <br>
            </form>
            <div class="btn-assemble">
                <button class="refus">Refuser la demande</button>
                <button class="valid">Valider la demande</button>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</body>
</html>