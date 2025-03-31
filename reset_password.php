<?php
require './includes/db.php'; // Inclure votre connexion à la base de données

if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
    var_dump($token); // Affiche le jeton transmis dans l'URL

    // Vérifier le jeton dans la base de données
    $stmt = $connexion->prepare("SELECT * FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $resetRequest = $stmt->fetch();

    var_dump($resetRequest); // Vérifie si le jeton correspond à un enregistrement dans la base de données

    if ($resetRequest) {
        // Récupérer la date de création du token
        $createdAt = new DateTime($resetRequest['pwd_created_at']);
        $now = new DateTime();
        $interval = $now->diff($createdAt);

        // Vérifier si le jeton a expiré (1 heure d'expiration)
        if ($interval->h < 1 && $interval->d == 0) {
            // Afficher le formulaire de réinitialisation du mot de passe
            ?>
            <form action="update_password.php" method="POST">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" name="new_password" required>
                <button type="submit">Réinitialiser le mot de passe</button>
            </form>
            <?php
        } else {
            // Si le jeton est expiré
            echo "Le jeton a expiré.";
        }
    } else {
        // Si le jeton est invalide
        echo "Jeton invalide.";
    }
} else {
    echo "Aucun jeton fourni.";
}
?>

