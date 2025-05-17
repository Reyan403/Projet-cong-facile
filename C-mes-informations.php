<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/C-affichage-infos.php';
include 'includes/C-check-connected.php';
?>



<?php
include 'includes/header.php';
include 'includes/menu-collaborateur.php';
?>

    <div class="content-bloc">
        <h1>
            Mes informations
        </h1>
        <div class="formulaire-bloc-connexion">
            <form action="" method="POST" class="form-infos">
            <div class="nom-prenom2">
                    <div class="label">
                        <label for="nom">Nom de famille</label>
                        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($userData['last_name']) ?>" readonly>
                    </div>

                    <div class="label-prenom">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($userData['first_name']) ?>" readonly>
                    </div>
                </div>

                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email2" value="<?= htmlspecialchars($userData['email']) ?>" readonly>

                <div class="poste-service">
                    <div class="service">
                        <label for="service">Direction/Service</label>
                        <input type="text" name="service" id="service" value="<?= htmlspecialchars($userData['service']) ?>" readonly>
                    </div>
                    <div class="poste">
                        <label for="poste">Poste</label>
                        <input type="text" name="poste" id="poste" value="<?= htmlspecialchars($userData['poste']) ?>" readonly>
                    </div>
                </div>

                <label for="manager">Manager</label>
                <input type="text" name="manager" id="manager" value="<?= htmlspecialchars($userData['manager_first_name'] . ' ' . $userData['manager_last_name']) ?>" readonly>

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
                        <?php if (isset($errors['current_password'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['current_password']) ?></span>
                        <?php endif; ?>
                    </label>

                    <div class="flex-password">
                        <div class="label2">
                            <label for="new-password" class="password-label2">
                                Nouveau mot de passe
                            </label>
                            <div class="password-wrapper2">
                                <input type="password" name="new_password" id="new-password" class="input-field">
                                <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEyeNew" onclick="togglePassword('new-password', 'toggleEyeNew')">
                            </div>
                            <?php if (isset($errors['new_password'])): ?>
                                <span class="error"><?= htmlspecialchars($errors['new_password']) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="label3">
                            <label for="confirm-password" class="password-label2">
                                Confirmation de mot de passe
                            </label>
                            <div class="password-wrapper2">
                                <input type="password" name="confirm_password" id="confirm-password" class="input-field">
                                <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEyeConfirm" onclick="togglePassword('confirm-password', 'toggleEyeConfirm')">
                            </div>
                            <?php if (isset($errors['confirm_password'])): ?>
                                <span class="error"><?= htmlspecialchars($errors['confirm_password']) ?></span>
                            <?php endif; ?>
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