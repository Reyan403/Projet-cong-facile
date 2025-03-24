<?php
// Démarre la session
session_start(); 

// Nettoie toutes les variables de session
session_unset(); 

// Détruit la session
session_destroy(); 

$_SESSION['message'] = [
    'type' => 'success',
    'message' => 'Vous êtes maintenant déconnecté.',
];

// Redirige vers index.php
header("Location: index.php");
exit; // Arrête l'exécution du script pour éviter tout affichage supplémentaire
?>
