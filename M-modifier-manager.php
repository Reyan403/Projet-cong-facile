<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-affichage-modif.php';
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
            <?= htmlspecialchars($userData['last_name']) . ' '. htmlspecialchars($userData['first_name']) ?>
            </h1>
            <div class="formulaire-bloc-connexion">
                <form action="" method="POST" class="form-infos">
                    <label for="email">Adresse email - champ obligatoire</label>
                    <input type="text" name="email" id="email" value="<?= htmlspecialchars($userData['email']) ?>">

                    <div class="nom-prenom">
                        <div class="label">
                            <label for="nom">Nom de famille - champ obligatoire</label>
                            <input type="text" name="nom" id="nom2" value="<?= htmlspecialchars($userData['last_name']) ?>">
                        </div>

                        <div class="label-prenom">
                            <label for="prenom">Prénom - champ obligatoire</label>
                            <input type="text" name="prenom" id="prenom2" value="<?= htmlspecialchars($userData['first_name']) ?>">
                        </div>
                    </div>

                    <label for="service">Direction/Service - champ obligatoire</label>
                    <input type="text" name="service" id="service2" value="<?= htmlspecialchars($userData['service']) ?>">

                    <div class="flex-password">
                        <div class="label">
                            <label for="new-password" class="password-label2">
                                Nouveau mot de passe
                                <div class="password-wrapper">
                                    <input type="password" name="new_password" id="new-password" class="input-field">
                                    <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEyeNew" onclick="togglePassword('new-password', 'toggleEyeNew')">
                                </div>
                                <?php if (isset($errors['new_password'])): ?>
                                    <span class="error"><?= htmlspecialchars($errors['new_password']) ?></span>
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
                                <?php if (isset($errors['confirm_password'])): ?>
                                    <span class="error"><?= htmlspecialchars($errors['confirm_password']) ?></span>
                                <?php endif; ?>
                            </label>
                        </div>
                    </div>
                    <div class="two-buttons-type2">
                        <button type="submit" name="update" class="btn-update">Mettre à jour</button>
                        <a class="btn-cancel" href="M-liste-manager.php">Annuler</a>
                    </div>
                </form>  
                <?php if (isset($_COOKIE['password_updated'])): ?>
                    <p class="message green">Mot de passe mis à jour avec succès.</p>
                <?php endif; ?> 
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>