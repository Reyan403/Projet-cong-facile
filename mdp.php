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
?>

<div class="menu" id="menu">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
        <a href="./index.php">Connexion</a>
    </div>

<section class="bloc">
        <div class="sidebar">
            <div class="content-menu">
                <div class="other-menu">
                    <a href="./index.php">Connexion</a>
                </div>
            </div>
        </div>
        <div class="content-bloc">
            <h1>Mot de passe oublié</h1>
            <p>Renseignez votre adresse email dans le champ ci-dessous.
            Vous recevrez par la suite un email avec un lien vous permettant de réinitialiser votre mot de passe.</p>
            <form action="traitement.php" method="post">
                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email" placeholder="****@mentalworks.fr" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
                <button class="btn-submit-mdp" type="submit">Demander à réinitialiser mot de passe</button>
            </form>

        <p><a class="mdp-forgot" href="./index.php"><strong>Cliquez ici</strong></a> pour retourner à la page de connexion.</p>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>

