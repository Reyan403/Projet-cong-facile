<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-affichage-infos.php';
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
            Mes informations
        </h1>
        <div class="formulaire-bloc-connexion">
            <form action="" method="POST" class="form-infos">
                <label for="email">Adresse email - champ obligatoire</label>
                <input type="text" name="email" id="email2" value="<?= htmlspecialchars($userData['email']) ?>" readonly>

                <div class="nom-prenom">
                    <div class="label">
                        <label for="nom">Nom de famille - champ obligatoire</label>
                        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($userData['last_name']) ?>" readonly>
                    </div>

                    <div class="label-prenom">
                        <label for="prenom">Prénom - champ obligatoire</label>
                        <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($userData['first_name']) ?>" readonly>
                    </div>
                </div>

                <label for="service">Direction/Service - champ obligatoire</label>
                <input type="text" name="service" id="service" value="<?= htmlspecialchars($userData['service']) ?>" readonly>

                <div class="password-informations">
                    <h2>
                        Réinitialiser mon mot de passe
                    </h2>

                    <label for="current-password" class="password-label">
                        Mot de passe actuel
                        <div class="password-wrapper">
                            <input type="password" name="current_password" id="current-password" class="input-field">
                            <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEyeCurrent" onclick="togglePassword('current-password', 'toggleEyeCurrent')">
                        </div>
                        <?php if (isset($error['current_password'])): ?>
                            <span class="error"><?= htmlspecialchars($error['current_password']) ?></span>
                        <?php endif; ?>
                    </label>

                    <div class="flex-password">
                        <div class="label">
                            <label for="new-password" class="password-label2">
                                Nouveau mot de passe
                                <div class="password-wrapper">
                                    <input type="password" name="new_password" id="new-password" class="input-field">
                                    <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEyeNew" onclick="togglePassword('new-password', 'toggleEyeNew')">
                                </div>
                                <?php if (isset($error['new_password'])): ?>
                                    <span class="error"><?= htmlspecialchars($error['new_password']) ?></span>
                                <?php endif; ?>
                            </label>
                        </div>

                        <div class="label">
                            <label for="confirm-password" class="password-label2">
                                Confirmation de mot de passe
                                <div class="password-wrapper">
                                    <input type="password" name="confirm_password" id="confirm-password" class="input-field">
                                    <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEyeConfirm" onclick="togglePassword('confirm-password', 'toggleEyeConfirm')">
                                </div>
                                <?php if (isset($error['confirm_password'])): ?>
                                    <span class="error"><?= htmlspecialchars($error['confirm_password']) ?></span>
                                <?php endif; ?>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" class="button-reset">Réinitialiser le mot de passe</button>
            </form>

            <?php if (isset($_COOKIE['password_updated'])): ?>
                <p class="message green">Mot de passe mis à jour avec succès.</p>
            <?php endif; ?>
            
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>