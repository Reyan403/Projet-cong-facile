<?php

$nom = $prenom = $email = $new_password = $confirm_password = "";

$error = [];

$pattern = "/^(?![-'])(?!.*[-']$)(?:(?:[\p{L}]+[-']?)+){2,}$/u";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($nom)) {
        $error['nom'] = 'Veuillez entrer votre nom';
    } elseif (!preg_match($pattern, $nom)) {
        $error['nom'] = "Le nom doit contenir au moins deux lettres, sans chiffres ni caractères spéciaux, et peut inclure des traits d’union ou des apostrophes.";
    }

    if (empty($prenom)) {
        $error['prenom'] = 'Veuillez entrer votre prénom';
    } elseif (!preg_match($pattern, $prenom)) {
        $error['prenom'] = "Le prénom doit contenir au moins deux lettres, sans chiffres ni caractères spéciaux, et peut inclure des traits d’union ou des apostrophes.";
    }

    if (empty($email)) {
        $error['email'] = 'Veuillez entrer votre adresse mail';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "L’adresse email n’est pas valide.";
    }

    if(empty($service)) {
        $error['service'] = 'Veuillez sélectionner un service';
    }

    if (empty($new_password)) {
        $error['new_password'] = "Le nouveau mot de passe est obligatoire.";
    } elseif (strlen($new_password) < 10) {
        $error['new_password'] = "Le mot de passe doit comporter au moins 10 caractères.";
    } elseif (!preg_match('/[A-Z]/', $new_password)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins une majuscule.";
    } elseif (!preg_match('/[a-z]/', $new_password)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins une minuscule.";
    } elseif (!preg_match('/[0-9]/', $new_password)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins un chiffre.";
    } elseif (!preg_match('/[\W_]/', $new_password)) {
        $error['new_password'] = "Le mot de passe doit contenir au moins un caractère spécial.";
    }

    if (empty($confirm_password)) {
        $error['confirm_password'] = "La confirmation du mot de passe est obligatoire.";
    } elseif ($new_password !== $confirm_password) {
        $error['confirm_password'] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($error)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmtDept = $connexion->prepare("INSERT INTO department (service_name) VALUES (:service)");
        $stmtDept->bindParam(':service', $service);
        $stmtDept->execute();
        $department_id = $connexion->lastInsertId(); // Récupérer l'ID du service inséré

        // 2. Insérer dans la table person (nom, prénom)
        $stmtPerson = $connexion->prepare("INSERT INTO person (first_name, last_name) VALUES (:prenom, :nom)");
        $stmtPerson->bindParam(':prenom', $prenom);
        $stmtPerson->bindParam(':nom', $nom);
        $stmtPerson->execute();
        $person_id = $connexion->lastInsertId(); // Récupérer l'ID de la personne insérée

        // 3. Insérer dans la table user (email, mot de passe, rôle, liens avec person et department)
        $stmtUser = $connexion->prepare("INSERT INTO user (email, password, role, person_id, department_id) 
                                          VALUES (:email, :password, :role, :person_id, :department_id)");
        $stmtUser->bindParam(':email', $email);
        $stmtUser->bindParam(':password', $hashed_password);
        $stmtUser->bindParam(':role', $role); // Le rôle par défaut sera 'manager'
        $stmtUser->bindParam(':person_id', $person_id);
        $stmtUser->bindParam(':department_id', $department_id);

        // Définir le rôle comme "manager"
        $role = 'manager';
        $stmtUser->execute();
    }
}

?>

