<?php
    include 'includes/db.php';
    include 'includes/connexion.php';

    // Vérifie si le cookie `logout_message` existe et stocke son contenu
    $alerte = null;
    if (isset($_COOKIE['logout_message'])) {
        $alerte = [
            'type' => 'success',
            'message' => $_COOKIE['logout_message']
        ];
        // Supprime le cookie après lecture
        setcookie("logout_message", "", time() - 3600, "/");
    }
?>


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
            <h1>
                CongéFacile
            </h1>
            <p>
                CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l’entreprise.
                Plus besoin d’échanges interminables ou de formulaires papier : en quelques clics,
                vous pouvez gérer vos absences en toute transparence et simplicité.
                Connectez-vous ci-dessous pour accéder à votre espace.
            </p>
            <div class="formulaire-bloc-connexion">
                <h2>
                    Connectez-vous
                </h2>
                <form action="" method="POST">
                    <label for="email">Adresse email</label>
                    <input type="text" name="email" id="email" placeholder="****@mentalworks.fr" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
                    <span class="error"><?= $erreurs['email'] ?? '' ?></span>

                    <label for="password" class="password-label">
                        Mot de passe
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="input-field">
                            <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEyePassword" onclick="togglePassword('password', 'toggleEyePassword')">
                        </div>
                    </label>
                    <button type="submit" class="button-connexion">Connexion au portail</button>
                </form>
                <p>
                    Vous avez oublié votre mot de passe ? <a href="mdp.php" class="mdp-forgot"><strong>Cliquez ici</strong></a> pour le réinitialiser.
                </p>
                <?php 
                    if ($alerte): 
                        echo "<div class='message green'>{$alerte['message']}</div>";
                    endif; 
                ?>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>