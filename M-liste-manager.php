<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

$stmt_ajout_manager = $connexion->prepare("
    SELECT p.id, p.last_name, p.first_name, d.name AS department_name
    FROM person p
    JOIN department d ON p.department_id = d.id
    JOIN user u ON u.person_id = p.id
    WHERE u.role = 'manager'
");

$stmt_ajout_manager->execute();
$managers = $stmt_ajout_manager->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <title>Mentalworks</title>
    </head>
<body>
<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
     <div class="content-bloc2">
        <div class="flex">
            <h1>
                Managers
            </h1>
            <a href="M-ajout-manager.php">
                Ajouter un manager
            </a>
        </div>
            <table id="requestsTable">
                <thead>
                <tr>
                <tr>
                    <th class="request-type" onclick="sortTable(0)">
                        <div class="text-and-arrow">
                            <p>Nom de famille</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchType" onkeyup="filterTable(0)">
                    </th>
                    <th class="request-type" onclick="sortTable(1)">
                        <div class="text-and-arrow">
                            <p>Prénom</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchDate" onkeyup="filterTable(1)">
                    </th>
                    <th class="request-type" onclick="sortTable(2)">
                        <div class="text-and-arrow">
                            <p>Service rattaché</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchStartDate" onkeyup="filterTable(2)">
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($managers as $manager): ?>
                        <tr>
                            <td><?= htmlspecialchars($manager['last_name']) ?></td>
                            <td><?= htmlspecialchars($manager['first_name']) ?></td>
                            <td><?= htmlspecialchars($manager['department_name']) ?></td>
                            <td>
                                <form action="M-modifier-manager.php" method="GET">
                                    <input type="hidden" name="id" value="<?= $manager['id'] ?>">
                                    <button type="submit" class="details-btn">Détails</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section> 
    <script src="script.js"></script>
</body>
</html>