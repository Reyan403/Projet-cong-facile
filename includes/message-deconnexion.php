<?php
session_start();
include 'deconnexion.php';

if (isset($_SESSION['message']) && is_array($_SESSION['message'])) {
    $alerte = $_SESSION['message'];  
    $couleur = $alerte['type'] === 'success' ? 'green' : 'red';
    unset($_SESSION['message']); // Suppression après affichage
} else {
    $alerte = null; // Pour éviter une erreur d'accès à une variable non définie
}

?>