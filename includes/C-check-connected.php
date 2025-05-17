<?php
include 'includes/db.php';

// Vérifier que l'utilisateur est connecté (id dans session)
if (!isset($_SESSION['user']['id'])) {
    header('Location: index.php');
    exit;
}

// Récupérer les infos à jour depuis la BDD
$sql = "SELECT connected, role FROM user WHERE id = :id LIMIT 1";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
$stmt->execute();
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$currentUser || $currentUser['connected'] != 1 || $currentUser['role'] !== 'employe') {
    // Si désactivé, ou pas employe => redirection
    header('Location: index.php');
    exit;
}
?>
