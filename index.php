<?php

include 'includes/db.php';

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
    <div class="background-gray"></div>
    <header>
        <div class="logo-mentalworks">
            <img src="./PNG/logo-mentalworks-blanc.png" alt="">
        </div>
        <div class="burger-menu" onclick="toggleMenu()">
            <img src="./PNG/burger-bar (1).png" alt="Menu">
        </div>
    </header>
    <div class="menu" id="menu">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
        <a href="./index.php">Connexion</a>
    </div>

    <section class="bloc">
        <div class="sidebar">
            <div class="content-menu">
                <a href="./index.php">Connexion</a>
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
                        <img src="./PNG/les-yeux-croises.png" class="toggle-password" id="toggleEye" onclick="togglePassword()">
                    </div>
                    </label>
                    <button type="submit" class="button-connexion">Connexion au portail</button>
                </form>
                <p>
                    Vous avez oublié votre mot de passe ? <a href="#" class="mdp-forgot"><strong>Cliquez ici</strong></a> pour le réinitialiser.
                </p>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>