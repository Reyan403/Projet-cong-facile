<?php

$nom = $prenom = $email = $new_password = $confirm_password = $service = "";

$errors = [];

$pattern = "/^(?![-'])(?!.*[-']$)(?:(?:[\p{L}]+[-']?)+){2,}$/u";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $service = $_POST['direction_nom'] ?? '';

    if (empty($nom)) {
        $errors['nom'] = 'Veuillez entrer votre nom';
    } elseif (!preg_match($pattern, $nom)) {
        $errors['nom'] = "Le nom doit contenir au moins deux lettres, sans chiffres ni caractères spéciaux, et peut inclure des traits d’union ou des apostrophes.";
    }

    if (empty($prenom)) {
        $errors['prenom'] = 'Veuillez entrer votre prénom';
    } elseif (!preg_match($pattern, $prenom)) {
        $errors['prenom'] = "Le prénom doit contenir au moins deux lettres, sans chiffres ni caractères spéciaux, et peut inclure des traits d’union ou des apostrophes.";
    }

    if (empty($email)) {
        $errors['email'] = 'Veuillez entrer votre adresse mail';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L’adresse email n’est pas valide.";
    }

    if (empty($service)) {
        $errors['service'] = 'Veuillez sélectionner un service';
    }

    if (empty($new_password)) {
        $errors['new_password'] = "Le nouveau mot de passe est obligatoire.";
    } elseif (strlen($new_password) < 10) {
        $errors['new_password'] = "Le mot de passe doit comporter au moins 10 caractères.";
    } elseif (!preg_match('/[A-Z]/', $new_password)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins une majuscule.";
    } elseif (!preg_match('/[a-z]/', $new_password)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins une minuscule.";
    } elseif (!preg_match('/[0-9]/', $new_password)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins un chiffre.";
    } elseif (!preg_match('/[\W_]/', $new_password)) {
        $errors['new_password'] = "Le mot de passe doit contenir au moins un caractère spécial.";
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = "La confirmation du mot de passe est obligatoire.";
    } elseif ($new_password !== $confirm_password) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $department_id = $service;

        // Insérer dans person
        $stmtPerson = $connexion->prepare("INSERT INTO person (first_name, last_name, department_id) VALUES (:prenom, :nom, :department_id)");
        $stmtPerson->bindParam(':prenom', $prenom);
        $stmtPerson->bindParam(':nom', $nom);
        $stmtPerson->bindParam(':department_id', $department_id);
        $stmtPerson->execute();

        $person_id = $connexion->lastInsertId();

        // Insérer dans user avec id = person_id
        $stmtUser = $connexion->prepare("INSERT INTO user (id, person_id, email, password, role) 
                                        VALUES (:id, :person_id, :email, :password, :role)");
        $stmtUser->bindParam(':id', $person_id, PDO::PARAM_INT);
        $stmtUser->bindParam(':person_id', $person_id, PDO::PARAM_INT);
        $stmtUser->bindParam(':email', $email);
        $stmtUser->bindParam(':password', $hashed_password);

        $role = 'manager';
        $stmtUser->bindParam(':role', $role);

        $stmtUser->execute();

        header("Location: M-liste-manager.php");
        exit;
    }
}
?>
