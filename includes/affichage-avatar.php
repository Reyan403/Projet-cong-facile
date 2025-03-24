<?php
session_start();
// Vérification si l'utilisateur est bien connecté
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Vérification et affichage sécurisé des informations
$firstName = $_SESSION['user']['first_name'] ?? 'Utilisateur';
$lastName = $_SESSION['user']['last_name'] ?? 'Inconnu';
$role = $_SESSION['user']['role'] ?? 'Non défini';
?>
