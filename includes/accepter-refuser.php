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

        // ✅ Envoi de l'e-mail si l'utilisateur a activé les notifications
        $sql = "SELECT u.email, p.alert_on_answer AS notify_on_decision
                FROM request r
                JOIN user u ON r.collaborator_id = u.id
                JOIN person p ON u.person_id = p.id
                WHERE r.id = :id";

        $stmt = $connexion->prepare($sql);
        $stmt->execute([':id' => $demande_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['notify_on_decision']) {
            $to = $user['email'];
            $subject = "Mise à jour de votre demande de congé";
            $statusText = ($answer_value === 1) ? "acceptée" : "refusée";
            $message = "Bonjour,\n\nVotre demande de congé a été traitée.";

            mail($to, $subject, $message); // Fonction mail standard
        }

        header('Location: M-historique-demandes-mana.php');
        exit;
    }
}

?>
