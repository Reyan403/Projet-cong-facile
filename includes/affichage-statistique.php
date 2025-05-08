<?php

$manager_id = $_SESSION['user']['id'] ?? null;

// Récupérer le department_id du manager
$sqlDept = "SELECT department_id FROM person WHERE id = :manager_id";
$stmtDept = $connexion->prepare($sqlDept);
$stmtDept->bindParam(':manager_id', $manager_id);
$stmtDept->execute();
$manager = $stmtDept->fetch(PDO::FETCH_ASSOC);

if ($manager && $manager['department_id']) {
    $department_id = $manager['department_id'];

    // Requête SQL pour récupérer tous les types de demandes, même ceux sans demandes associées
    $sql = "
        SELECT rt.name AS type_label, 
               COUNT(r.id) AS total
        FROM request_type rt
        LEFT JOIN request r ON r.request_type_id = rt.id 
                           AND EXISTS (
                               SELECT 1 FROM person p
                               WHERE p.id = r.collaborator_id
                               AND p.department_id = :department_id 
                               AND p.manager_id = :manager_id
                           )
        GROUP BY rt.id, rt.name
    ";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':department_id', $department_id);
    $stmt->bindParam(':manager_id', $manager_id); // Assurez-vous que le manager_id est bien utilisé dans la requête
    $stmt->execute();
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $values = [];

    foreach ($demandes as $demande) {
        $labels[] = $demande['type_label'];
        $values[] = (int)$demande['total'];
    }
} else {
    $labels = [];
    $values = [];
}



?>