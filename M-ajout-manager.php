<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-affichage-ajout.php';
include 'includes/M-check-connected.php';

$sql = "SELECT id, name FROM department";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$direction_name = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $direction_name = $_POST['direction_nom'] ?? '';
}
?>



<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>

    <div class="content-bloc">
        <h1>
            Ajouter un manager
        </h1>
        <div class="formulaire-bloc-connexion">
            <form action="" method="POST" class="form-infos">
                <label for="email">Adresse email - champ obligatoire</label>
                <input type="text" name="email" id="email" value="<?= htmlspecialchars($email ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['email']) ?></span>
                    <?php endif; ?>

                <div class="nom-prenom">
                    <div class="label">
                    <label for="nom">Nom de famille - champ obligatoire</label>
                    <input type="text" name="nom" id="nom2" value="<?= htmlspecialchars($nom ?? '') ?>">
                    <?php if (isset($errors['nom'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['nom']) ?></span>
                    <?php endif; ?>
                    </div>

                    <div class="label-prenom">
                        <label for="prenom">Prénom - champ obligatoire</label>
                        <input type="text" name="prenom" id="prenom2" value="<?= htmlspecialchars($prenom ?? '') ?>">
                        <?php if (isset ($errors['prenom'])) : ?>
                            <span class="error"><?= htmlspecialchars($errors['prenom']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <label for="service">Direction/Service - champ obligatoire</label>
                <select id="direction_nom" name="direction_nom">
                            <option value="" <?= empty($direction_name) ? 'selected' : '' ?>>Sélectionner un type</option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= $department['id'] ?>" <?= ($direction_name == $department['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($department['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <span class="error"><?= $errors['service'] ?? '' ?></span>

                <div class="flex-password">
                    <div class="label2">
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

                    <div class="label3">
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
        </div>
    </div>

    <?php if (isset($_COOKIE['password_updated'])): ?>
        <p class="message green">Mot de passe mis à jour avec succès.</p>
    <?php endif; ?>

    <script src="script.js"></script>
</body>
</html>