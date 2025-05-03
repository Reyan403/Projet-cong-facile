<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

$user_id = $_SESSION['user']['id']; 

$stmt = $connexion->prepare("
    SELECT u.email, u.password, p.last_name, p.first_name, d.name AS service
    FROM user u
    JOIN person p ON u.person_id = p.id
    JOIN department d ON p.department_id = d.id
    WHERE u.id = ?
");
$stmt->execute([$user_id]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

$error = [];

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Champs requis
    if (empty($currentPassword)) {
        $error['current_password'] = "Le mot de passe actuel est obligatoire.";
    }

    if (empty($newPassword)) {
        $error['new_password'] = "Le nouveau mot de passe est obligatoire.";
    }

    if (empty($confirmPassword)) {
        $error['confirm_password'] = "La confirmation du mot de passe est obligatoire.";
    }

    // Vérification du mot de passe actuel
    if (!empty($currentPassword) && !password_verify($currentPassword, $userData['password'])) {
        $error['current_password'] = "Le mot de passe ne correspond pas au vôtre.";
    }

    // Vérification des nouveaux mots de passe
    if ($newPassword !== $confirmPassword) {
        $error['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }

    // Règles de sécurité
    if (strlen($newPassword) < 10) {
        $error['new_password'] = "Le mot de passe doit comporter au moins 10 caractères.";
    }
    if (!preg_match('/[A-Z]/', $newPassword)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins une majuscule.";
    }
    if (!preg_match('/[a-z]/', $newPassword)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins une minuscule.";
    }
    if (!preg_match('/[0-9]/', $newPassword)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins un chiffre.";
    }
    if (!preg_match('/[\W_]/', $newPassword)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins un caractère spécial.";
    }

    // Mise à jour si aucune erreur
    if (empty($error)) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
        $update = $connexion->prepare("UPDATE user SET password = ? WHERE id = ?");
        $update->execute([$newHashedPassword, $user_id]);
    
        // Définir un cookie de succès (durée de 30 secondes)
        setcookie('password_updated', '1', time() + 1, '/');
    
        // Redirection pour éviter une nouvelle soumission du formulaire en cas de refresh
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}
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

                    <!-- Champ mot de passe actuel -->
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
                            <!-- Champ nouveau mot de passe -->
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
                            <!-- Champ confirmation du mot de passe -->
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