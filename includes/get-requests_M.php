<?php
include 'includes/db.php';

$department_id = $_SESSION['user']['department_id'] ?? null;

if ($department_id) {
    $sql = "SELECT r.id, r.created_at, r.request_type_id, r.start_at, r.end_at,
                   p.last_name, p.first_name, rt.name AS request_type_name,
                   DATEDIFF(r.end_at, r.start_at) AS jours_demandes
            FROM request r 
            JOIN person p ON r.collaborator_id = p.id
            JOIN request_type rt ON r.request_type_id = rt.id
            WHERE p.department_id = :department_id
            AND r.answer IS NULL";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
    $stmt->execute();
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $demandes = []; // Aucune demande si le département est inconnu
}
?>
