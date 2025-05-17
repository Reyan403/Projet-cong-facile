<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $demande_id = $_POST['demande_id'] ?? null;
    $answerComment = $_POST['commentaire'] ?? null;

    if ($demande_id && ($action === 'valider' || $action === 'refuser')) {
        $answer_value = ($action === 'valider') ? 1 : 0;

        $sql = "UPDATE request 
                SET answer = :answer, 
                    answer_comment = :answer_comment, 
                    answer_at = NOW() 
                WHERE id = :id AND answer IS NULL";

        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':answer', $answer_value, PDO::PARAM_INT);
        $stmt->bindParam(':answer_comment', $answerComment, PDO::PARAM_STR);
        $stmt->bindParam(':id', $demande_id, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: M-historique-demandes-mana.php');
        exit;
    }
}
?>
