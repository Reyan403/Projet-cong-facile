<?php
include 'includes/db.php';

$manager_id = 1; // ID du manager connecté

$sql = "SELECT r.created_at, r.request_type_id, r.start_at, r.end_at,
               p.last_name, p.first_name, rt.name AS request_type_name,
               DATEDIFF(r.end_at, r.start_at) AS jours_demandes
        FROM request r 
        JOIN person p ON r.collaborator_id = p.id
        JOIN request_type rt ON r.request_type_id = rt.id
        WHERE p.manager_id = :manager_id";

$stmt = $connexion->prepare($sql);
$stmt->bindParam(':manager_id', $manager_id, PDO::PARAM_INT);
$stmt->execute();
$demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>