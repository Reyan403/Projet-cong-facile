<?php
include 'includes/db.php';

// ID du manager connecté
$manager_id = $_SESSION['user']['id'] ?? null;

// Récupérer le department_id du manager
$sqlDept = "SELECT department_id FROM person WHERE id = :manager_id";
$stmtDept = $connexion->prepare($sqlDept);
$stmtDept->bindParam(':manager_id', $manager_id);
$stmtDept->execute();
$manager = $stmtDept->fetch(PDO::FETCH_ASSOC);

if ($manager && $manager['department_id']) {
    $department_id = $manager['department_id'];

    // Requête pour récupérer les demandes des collaborateurs du même département
    $sql = "SELECT r.id, r.start_at, r.end_at,
                   DATEDIFF(r.end_at, r.start_at) AS jours_demandes,
                    rt.name AS type_demande,
                    r.created_at AS date_creation,
                    CONCAT(p.first_name, ' ', p.last_name) AS collaborateur
            FROM request r 
            JOIN person p ON r.collaborator_id = p.id
            JOIN request_type rt ON r.request_type_id = rt.id
            WHERE p.department_id = :department_id";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':department_id', $department_id);
    $stmt->execute();
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $demandes = [];
}
?>
