<?php
require './includes/db.php'; // Inclure votre connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'e-mail existe
    $stmt = $connexion->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Générer un jeton unique
        $token = bin2hex(random_bytes(50));

        // Stocker le jeton dans la base de données
        $stmt = $connexion->prepare("INSERT INTO password_resets (email, token, pwd_created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$email, $token]);


        // Préparer l'envoi de l'e-mail
        require './PHPMailer/PHPMailer-master/src/Exception.php';
        require './PHPMailer/PHPMailer-master//src/PHPMailer.php';
        require './PHPMailer/PHPMailer-master//src/SMTP.php';


        $mail = new PHPMailer\PHPMailer\PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Exemple : smtp.gmail.com
        $mail->SMTPAuth = true;
        $mail->Username = 'julie.denes29@gmail.com'; // Votre e-mail SMTP
        $mail->Password = 'tlcz uaoe rqcl erwd';     // Votre mot de passe SMTP
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('votre-email@example.com', 'Mentalworks');
        $mail->addAddress($email);

        $mail->Subject = 'Réinitialisation du mot de passe';
        $resetLink = "http://localhost/GitHub/Projet-cong-facile/reset_password.php?token=" . $token;
        $mail->Body    = 'Cliquez sur ce lien pour réinitialiser votre mot de passe : ' . $resetLink;

        // Envoyer l'e-mail
        if (!$mail->send()) {
            echo 'Message non envoyé. Erreur: ' . $mail->ErrorInfo;
        } else {
            echo 'Le lien de réinitialisation du mot de passe a été envoyé à votre e-mail.';
        }
    } else {
        echo "Aucun utilisateur trouvé avec cette adresse e-mail.";
    }
}
?>
