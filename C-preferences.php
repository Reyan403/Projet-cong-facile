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
            Mes préférences
        </h1>
        <div class="btn-switch">
            <button id="switchBtn"></button>
            <p>
                Être alerté par email lorsqu'une demande de congé est acceptée ou refusée
            </p>
        </div>
        <div class="btn-switch">
            <button id="switchBtn2"></button>
            <p>
                Recevoir un rappel par email lorsqu'un congé arrive la semaine prochaine
            </p>
        </div>
        <button class="button-save">Enregistrer mes préférences</button>
    </div>

    <script src="script.js"></script>
</body>
</html>