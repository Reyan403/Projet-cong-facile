<?php

include 'includes/db.php';
include 'includes/affichage-avatar.php';
<<<<<<< HEAD
include 'includes/M-check-connected.php';

$sql = "SELECT id, name FROM request_type";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$request_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($request_types as &$request_type) {
    // Requête pour compter le nombre de demandes associées à chaque type
    $sql_count = "SELECT COUNT(*) FROM request WHERE request_type_id = :id";
    $stmt_count = $connexion->prepare($sql_count);
    $stmt_count->bindParam(':id', $request_type['id'], PDO::PARAM_INT);
    $stmt_count->execute();
    $result = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $request_type['request_count'] = $result['COUNT(*)'];
}

=======
include 'includes/M-check-enabled.php';
include 'M-info.php';
>>>>>>> 588c1621517f3d698e1a7baa727b1be0ae31b779
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menu-manager.php'; ?>

<div class="content-bloc2">
    <div class="flex">
        <h1>Mon équipe</h1>
        <a href="M-equipe2.php">Ajouter un collaborateur</a>
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
                        <form action="M-equipe2.php" method="GET">
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
