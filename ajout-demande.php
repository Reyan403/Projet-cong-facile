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
                Types de demandes
            </h1>
            <form action="">
                <label for="type">Nom du type</label>
                <input type="text" name="type" id="type" class="input-type">
                <div class="two-buttons-type2">
                    <button type="submit" class="btn-remove">Supprimer</button>
                    <button type="submit" class="btn-update">Mettre à jour</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>