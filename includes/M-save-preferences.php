<?php

$data = json_decode(file_get_contents('php://input'), true);
$userId = $_SESSION['user_id']; // ou autre identifiant de l'utilisateur connecté

$sql = "UPDATE user SET notify_on_decision = :notifyDecision, notify_before_leave = :notifyUpcoming WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->execute([
    ':notifyDecision' => $data['notify_decision'],
    ':notifyUpcoming' => $data['notify_upcoming'],
    ':id' => $userId
]);

echo json_encode(['message' => 'Préférences enregistrées avec succès']);
