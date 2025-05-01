<?php
include 'includes/db.php';

$manager_id = $_SESSION['user']['id'];  // On suppose que l'ID du manager est stocké dans la session

// Récupérer le department_id du manager à partir de la base de données
$sql_manager = "SELECT department_id FROM person WHERE id = :manager_id";
$stmt_manager = $connexion->prepare($sql_manager);
$stmt_manager->bindParam(':manager_id', $manager_id, PDO::PARAM_INT);
$stmt_manager->execute();
$manager = $stmt_manager->fetch(PDO::FETCH_ASSOC);

if ($manager) {
    $manager_department_id = $manager['department_id'];

    // Maintenant, on peut compter les demandes du même département que le manager
    $sql = "SELECT COUNT(*) AS total 
            FROM request r 
            JOIN person p ON r.collaborator_id = p.id
            WHERE p.manager_id = :manager_id
            AND p.department_id = :department_id";  // Filtrer par department_id

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':manager_id', $manager_id, PDO::PARAM_INT);
    $stmt->bindParam(':department_id', $manager_department_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
} else {
    return 0; // Si le manager n'a pas de département associé
}

?>
