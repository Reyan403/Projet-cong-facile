<?php

$errors = [];

$user_id = $_GET['id'];

$stmt_managers = $connexion->prepare("
    SELECT u.email, u.password, p.last_name, p.first_name, d.name AS service
    FROM person p
    LEFT JOIN user u ON u.person_id = p.id
    LEFT JOIN department d ON p.department_id = d.id
    WHERE p.id = :id
");
$stmt_managers->bindParam(':id', $user_id);
$stmt_managers->execute();
$userData = $stmt_managers->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($newPassword)) {
        $errors['new_password'] = "Le nouveau mot de passe est obligatoire.";
    }

    if (empty($confirmPassword)) {
        $errors['confirm_password'] = "La confirmation du mot de passe est obligatoire.";
    }

    // Vérification des nouveaux mots de passe
    if ($newPassword !== $confirmPassword) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }

    // Règles de sécurité
    if (!empty($newPassword)) {
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

