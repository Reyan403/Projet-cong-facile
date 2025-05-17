<?php

include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-check-enabled.php';

// Vérifier que l'utilisateur est connecté
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
    IFNULL(SUM(request.jours_demandes), 0) AS total_jours
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

<?php include 'includes/header.php'; ?>
<?php include 'includes/menu-manager.php'; ?>

<div class="content-bloc2">
    <div class="flex">
        <h1>Mon équipe</h1>
        <a href="M-ajout-collaborateur.php">Ajouter un collaborateur</a>
    </div>
    <table id="requestsTable">
        <thead>
            <tr>
                <th class="request-type" onclick="sortTable(0)">
                    <div class="text-and-arrow">
                        <p>Nom</p>
                        <div class="arrow">
                            <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                            <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                        </div>
                    </div>
                    <input class="demandes-associees" type="search" onkeyup="filterTable(0)">
                </th>
                <th class="request-type" onclick="sortTable(1)">
                    <div class="text-and-arrow nb-demandes-associées">
                        <p>Prénom</p>
                        <div class="arrow">
                            <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                            <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                        </div>
                    </div>
                    <input class="demandes-associees" type="search" onkeyup="filterTable(1)">
                </th>
                <th class="request-type" onclick="sortTable(2)">
                    <div class="text-and-arrow nb-demandes-associées">
                        <p>Adresse email</p>
                        <div class="arrow">
                            <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                            <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                        </div>
                    </div>
                    <input class="demandes-moyenne" type="search" onkeyup="filterTable(2)">
                </th>
                <th class="request-type" onclick="sortTable(3)">
                    <div class="text-and-arrow nb-demandes-associées">
                        <p>Poste</p>
                        <div class="arrow">
                            <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                            <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                        </div>
                    </div>
                    <input class="demandes-moyenne" type="search" onkeyup="filterTable(3)">
                </th>
                <th class="request-type" onclick="sortTable(4)">
                    <div class="text-and-arrow nb-demandes-associées">
                        <p>Nb congés posés sur l'année</p>
                        <div class="arrow">
                            <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                            <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                        </div>
                    </div>
                    <input class="demandes-moyenne" type="search" onkeyup="filterTable(4)">
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($team_members as $member): ?>
                <tr>
                    <td><?= htmlspecialchars($member['last_name']) ?></td>
                    <td><?= htmlspecialchars($member['first_name']) ?></td>
                    <td><?= htmlspecialchars($member['email']) ?></td>
                    <td><?= htmlspecialchars($member['name']) ?></td>
                    <td><?= $member['total_jours'] ?></td>
                    <td>
                        <form action="M-ajout-demande.php" method="GET">
                            <input type="hidden" name="id" value="<?= $member['id'] ?>">
                            <button type="submit" class="details-btn">Détails</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="script.js"></script>
</body>
</html>
