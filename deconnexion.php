<?php
session_start(); 
include 'includes/db.php'; 

// Mise à jour : désactive le compte si l'utilisateur est connecté
if (isset($_SESSION['user']['id'])) {
    $sql_enabled = 'UPDATE user SET enabled = 0 WHERE id = :id';
    $stmt = $connexion->prepare($sql_enabled);
    $stmt->bindParam(':id', $_SESSION['user']['id']);
    $stmt->execute();
}

// Stocke le message dans un cookie temporaire (valide 5 secondes)
setcookie("logout_message", "Vous êtes maintenant déconnecté.", time() + 5, "/");

// Nettoie la session
session_unset();
session_destroy();

// Redirige vers l'accueil
header("Location: index.php");
exit;
?>
