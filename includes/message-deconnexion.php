<?php

// Vérifie si un message de déconnexion existe et l'affiche
if (isset($_SESSION['message'])) {
    $messageType = $_SESSION['message']['type']; // 'success', 'error', etc.
    $messageContent = $_SESSION['message']['message']; // Le texte du message

    // Affiche le message dans une div spécifique
    echo "<div class='message $messageType'>$messageContent</div>";

    // Efface le message de la session après l'avoir affiché
    unset($_SESSION['message']);
}
?>