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
include 'includes/menu-collaborateur.php';
?>
        <div class="content-bloc">
            <h1>
                Ma demande de congé
            </h1>
            <h3>Demande du <?php $dateDemande ?></h3>
            <p>
                Type de demande : <?php $typeConge ?><br>
                Période : <?php $dateDebut ?> au <?php $dateFin ?><br>
                Nombre de jours : <?php $nbJours ?><br><br>
                Statut de la demande : <?php $statut?>
            </p>
            <form action="traitement.php" method="post">
            <label for="text">Commentaire du manager :</label>
                <div class="input-container">
                    <input type="text" id="text" name="text" placeholder="Profite bien de tes vacances à Mayorque et surtout, n'oublie pas la carte postale !!!">
                </div>
            <br>
            </form>
            <button class="btn-return" a href="">Retourner à la liste de mes demandes</button>
        </div>
    </section>
    <script src="script.js"></script>
</body>