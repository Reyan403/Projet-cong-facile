<?php
session_start(); 

// Stocke le message dans un cookie temporaire (valide pendant 5 secondes)
setcookie("logout_message", "Vous êtes maintenant déconnecté.", time() + 5, "/");

// Nettoie toutes les variables de session
session_unset(); 

// Détruit la session
session_destroy(); 

// Redirige vers index.php
header("Location: index.php");
exit;
?>

