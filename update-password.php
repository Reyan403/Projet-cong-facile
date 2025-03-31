<?php
require './includes/db.php'; // Inclure votre connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer le token et le nouveau mot de passe
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Vérifier si le jeton existe dans la base de données
    $stmt = $connexion->prepare("SELECT * FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $resetRequest = $stmt->fetch();

    if ($resetRequest) {
        // Récupérer l'email associé au jeton
        $email = $resetRequest['email'];

        // Hasher le mot de passe
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Mettre à jour le mot de passe de l'utilisateur
        $stmt = $connexion->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->execute([$hashedPassword, $email]);

        // Supprimer le jeton de la table pour éviter son utilisation multiple
        $stmt = $connexion->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->execute([$token]);

        echo "Votre mot de passe a été mis à jour avec succès.";
    } else {
        echo "Jeton invalide ou expiré.";
    }
}
?>
