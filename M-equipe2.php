<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-affichage-infos.php';
include 'includes/M-check-connected.php';

$sql = "SELECT id, name FROM department";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $department = $_POST['department'] ?? '';
}

$sql = "SELECT id, name FROM position";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$positions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $position = $_POST['position'] ?? '';
}

include 'includes/affichage-erreurs.php';
include 'M-info.php';

foreach ($team_members as $member): ?>
<?php endforeach; 
?>



<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>

    <div class="content-bloc">
        <h1>
            <?= htmlspecialchars($member['first_name']) . ' ' . htmlspecialchars($member['last_name']) ?>

        </h1>

        <div class="formulaire-bloc-connexion">
            
            <form action="" method="POST" class="form-infos">
                
                <label for="email">Adresse email - champ obligatoire</label>
                <input type="text" name="email" id="email" value="<?= htmlspecialchars($member['email']) ?>" >

                <div class="nom-prenom">
                    <div class="label2">
                        <label for="nom">Nom de famille - champ obligatoire</label>
                        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($member['last_name']) ?>" readonly>
                    </div>

                    <div class="label">
                        <label for="prenom">Prénom - champ obligatoire</label>
                        <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($member['first_name']) ?>" readonly>
                    </div>
                </div>

                <div class="nom-prenom">
                    <div class="label">
                        <label for="service">Direction/Service - champ obligatoire</label>
                            <select id="type-demande" name="type_demande">
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?= $department['id'] ?>" <?= ($member == $department['name']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($department['name']) ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>        
                            <span class="error"><?= $errors['type_demande'] ?? ''; ?></span>
                    </div>

                        
                    <div class="label-prenom">
                        <label for="type-demande">Poste - champ obligatoire</label>
                            <select id="type-demande" name="type_demande">
                                <?php foreach ($positions as $position): ?>                        
                                    <option value="<?= $position['id'] ?>" <?= ($member == $position['name']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($position['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="error"><?= $errors['type_demande'] ?? ''; ?></span>
                    </div>
                </div>
                
               
            
                    <label for="type-demande">Manager - champ obligatoire</label>
                    <select id="manager" name="type_demande_disabled" disabled>
                    <?php foreach ($positions as $position): ?>                        
                        <option value="<?= $position['id'] ?>" 
                            <?= ($member == $userData['last_name'] . ' ' . $userData['first_name']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($userData['first_name']) . ' ' . htmlspecialchars($userData['last_name']) ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                        <input type="hidden" name="type_demande" value="<?= $userData['first_name'] . ' ' . $userData['last_name'] ?>">
                        <span class="error"><?= $errors['type_demande'] ?? ''; ?></span>
               
                <div class="password-informations">
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

            <div class="btn-flex">
                <button class="btn-supp" a href="">Supprimer le compte</button>
                <button class="btn-mettre-a-jour" a href="">Mettre à jour</button>
            </div>



            </form>

            <?php if (isset($_COOKIE['password_updated'])): ?>
                <p class="message green">Mot de passe mis à jour avec succès.</p>
            <?php endif; ?>
            
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>