<?php // Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
    header('Location: index.php');
    exit;
}

// Récupérer les infos à jour depuis la BDD
$sql = "SELECT person.id AS person_id, person.department_id 
        FROM user 
        JOIN person ON person.id = user.person_id 
        WHERE user.id = :id LIMIT 1";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
$stmt->execute();
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$currentUser) {
    header('Location: index.php');
    exit;
}

$managerPersonId = $currentUser['person_id'];
$managerDepartmentId = $currentUser['department_id'];

// Requête principale pour récupérer les collaborateurs du manager
$sql = "SELECT 
    person.id,
    person.last_name, 
    person.first_name, 
    user.email, 
    position.name,
    department.name AS department_name,
    COUNT(request.jours_demandes)AS total_jours
FROM person
JOIN user ON user.person_id = person.id
JOIN department ON person.department_id = department.id
JOIN position ON person.position_id = position.id
LEFT JOIN request ON person.id = request.collaborator_id
WHERE person.manager_id = :manager_id AND person.department_id = :department_id
GROUP BY person.id, person.last_name, person.first_name, user.email, position.name, department.name";

$stmt = $connexion->prepare($sql);
$stmt->bindParam(':manager_id', $managerPersonId, PDO::PARAM_INT);
$stmt->bindParam(':department_id', $managerDepartmentId, PDO::PARAM_INT);
$stmt->execute();
$team_members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
