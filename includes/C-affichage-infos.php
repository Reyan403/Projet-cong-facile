<?php
$user_id = $_SESSION['user']['id']; 

$stmt = $connexion->prepare("
    SELECT u.email, u.password, p.last_name, p.first_name, p.position_id, pos.name AS poste,
       p.manager_id, d.name AS service, m.first_name AS manager_first_name, m.last_name AS manager_last_name
    FROM user u
    JOIN person p ON u.person_id = p.id
    JOIN department d ON p.department_id = d.id
    LEFT JOIN position pos ON p.position_id = pos.id
    LEFT JOIN person m ON p.manager_id = m.id
    WHERE u.id = ?
");
$stmt->execute([$user_id]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

$errors = [];

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Champs requis
    if (empty($currentPassword)) {
        $errors['current_password'] = "Le mot de passe actuel est obligatoire.";
    }

    if (empty($newPassword)) {
        $errors['new_password'] = "Le nouveau mot de passe est obligatoire.";
    }

    if (empty($confirmPassword)) {
        $errors['confirm_password'] = "La confirmation du mot de passe est obligatoire.";
    }

    // Vérification du mot de passe actuel
    if (!empty($currentPassword) && !password_verify($currentPassword, $userData['password'])) {
        $errors['current_password'] = "Le mot de passe ne correspond pas au vôtre.";
    }

    // Vérification des nouveaux mots de passe
    if ($newPassword !== $confirmPassword) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }

    // Règles de sécurité
    if (strlen($newPassword) < 10) {
        $errors['new_password'] = "Le mot de passe doit comporter au moins 10 caractères.";
    }
    if (!preg_match('/[A-Z]/', $newPassword)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins une majuscule.";
    }
    if (!preg_match('/[a-z]/', $newPassword)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins une minuscule.";
    }
    if (!preg_match('/[0-9]/', $newPassword)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins un chiffre.";
    }
    if (!preg_match('/[\W_]/', $newPassword)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins un caractère spécial.";
    }

    // Mise à jour si aucune erreur
    if (empty($errors)) {
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
