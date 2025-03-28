<?php
include 'includes/db.php';

$manager_id = 1; // ID du manager connecté

$sql = "SELECT COUNT(*) AS total 
        FROM request r 
        JOIN person p ON r.collaborator_id = p.id
        WHERE p.manager_id = :manager_id";

$stmt = $connexion->prepare($sql);
$stmt->bindParam(':manager_id', $manager_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

return $result['total'];
?>
