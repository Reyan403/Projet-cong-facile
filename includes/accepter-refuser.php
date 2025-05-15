<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $demande_id = $_POST['demande_id'] ?? null;

    if ($demande_id && ($action === 'valider' || $action === 'refuser')) {
        // Définir la valeur à mettre dans answer
        $answer_value = ($action === 'valider') ? 1 : 0;

        $sql = "UPDATE request SET answer = :answer WHERE id = :id AND answer IS NULL";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':answer', $answer_value, PDO::PARAM_INT);
        $stmt->bindParam(':id', $demande_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
