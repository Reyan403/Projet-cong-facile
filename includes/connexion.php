<?php
session_start();

include 'includes/db.php';

// Définition des variables
$erreurs = [];
$data = [];

// Si je ne suis pas en POST, on ne traite pas le formulaire.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Nettoyage des entrées
    $data['email'] = trim($data['email'] ?? '');
    $data['password'] = trim($data['password'] ?? '');

    // Vérification de l'email
    if (empty($data['email'])) {
        $erreurs['email'] = 'Veuillez saisir votre email.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Veuillez saisir un email valide.';
    }

    // Vérification du mot de passe
    if (empty($data['password'])) {
        $erreurs['password'] = 'Veuillez saisir votre mot de passe.';
    }

    // Vérification en base de données
    $requete = $connexion->prepare('
        SELECT u.id, u.email, u.password, u.connected, u.created_at, u.role, u.person_id,
               p.first_name, p.last_name, p.department_id
        FROM user u
        LEFT JOIN person p ON u.person_id = p.id
        WHERE u.email = :email
    ');

    $requete->bindParam(':email', $data['email']);
    $requete->execute();
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    // Vérification des informations utilisateur
   if (!$user || !password_verify($data['password'], $user['password'])) {
    $erreurs['email'] = 'Compte non valide, veuillez réessayer.';
    } else {
        // Stocker les informations dans la session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'connected' => $user['connected'],
            'created_at' => $user['created_at'],
            'role' => $user['role'],
            'person_id' => $user['person_id'],
            'first_name' => $user['first_name'] ?? 'Non défini',
            'last_name' => $user['last_name'] ?? 'Non défini',
            'department_id' => $user['department_id'] ?? null 
        ];

        $_SESSION['collaborator_id'] = $user['id'];
        $_SESSION['department_id'] = $user['department_id'];

        // ✅ Mettre à jour connected = 1 AVANT la redirection
        $sql_connected = 'UPDATE user SET connected = 1 WHERE id = :id';
        $stmt = $connexion->prepare($sql_connected);
        $stmt->bindParam(':id', $_SESSION['user']['id']);
        $stmt->execute();

        // Redirection selon le rôle
        if ($user['role'] === 'employe') {
            header('Location: C-accueil.php');
        } elseif ($user['role'] === 'manager') {
            header('Location: M-accueil2.php');
        } else {
            header('Location: index.php');
        }
        exit;
    }

    // Réinitialisation du mot de passe dans le formulaire
    $data['password'] = '';
}
?>

