<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'valider_demande') {
    $id_demande = $_POST['id_demande'];

    // Effectuer la mise à jour de la demande dans la base de données
    $sql = "UPDATE demandes SET statut = 'validée' WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_demande]);
    
    // Répondre avec un message de succès
    echo "Demande validée";
}
?>