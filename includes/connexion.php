<?php

// nécessite d'être définies ici pour être utilisées dans les fonctions.
$erreurs = [];
$data = [];

// Si je ne suis pas en POST, je n'ai pas besoin de traiter le formulaire.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.
    $data['email'] = trim($data['email'] ?? '');
    $data['password'] = trim($data['password'] ?? '');

    // Vérification de l'email

    // Vérification si le champ n'est pas vide.
    if (empty($data['email'])) {
        $erreurs['email'] = 'Veuillez saisir votre email.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Veuillez saisir un email valide.';
    }

    // Vérification du mot de passe

    // Vérification si le champ n'est pas vide.
    if (empty($data['password'])) {
        $erreurs['password'] = 'Veuillez saisir votre mot de passe.';
    }

    // On doit vérifier que l'user existe en base de données
    // Vérifier également son mot de passe
    // Si ok : on le "connecte".

    $requete = $connexion->prepare('
        SELECT id, email, password, enabled, created_at, role, person_id
        FROM user
        WHERE email = :email
    ');

    $requete->bindParam('email', $data['email']);
    $requete->execute();
    $user = $requete->fetch(\PDO::FETCH_ASSOC);

    // user non trouvé en base de données.
    if ($user === false || !password_verify($data['password'], $user['password'])) {
        $erreurs['email'] = 'Compte non valide, veuillez réessayer.';
    } else {
        if (password_verify($data['password'], $user['password'])) {
            // OK l'utilisateur peut se connecter.
            // On créé une session avec ses données.
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'enabled' => $user['enabled'],
                'created_at' => $user['created_at'],
                'role' => $user['role'],
                'person_id' => $user['person_id']
            ];
        
            $_SESSION['message'] = [
                'type' => 'success',
                'message' => 'Vous êtes maintenant connecté.',
            ];
        
            // Redirection selon le rôle de l'utilisateur
            if ($user['role'] === 'employe') {
                header('Location: accueil.php');
            } elseif ($user['role'] === 'manager') {
                header('Location: accueil2.php');
            } else {
                // Si le rôle n'est pas reconnu, rediriger vers une page par défaut
                header('Location: index.php');
            }
        }
    }

    // On réinitialise le mot de passe à l'affichage.
    $data['password'] = '';
}

?>