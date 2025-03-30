<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

$sql = "SELECT id, name FROM position";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$positions = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($positions as &$position) {
    // Requête pour compter le nombre de demandes associées à chaque type
    $sql_count = "SELECT COUNT(*) FROM position WHERE name = :id";
    $stmt_count = $connexion->prepare($sql_count);
    $stmt_count->bindParam(':id', $position['id'], PDO::PARAM_INT);
    $stmt_count->execute();
    $result = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $position['position_count'] = $result['COUNT(*)'];
}

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
                Postes
            </h1>
            <a href="ajout-poste.php">
                Ajouter un poste
            </a>
        </div>
            <table id="requestsTable">
                <thead>
                <tr>
                    <th class="request-type" onclick="sortTable(0)">
                        <div class="text-and-arrow">
                            <p>Nom du poste</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input class="type-de-demandes" type="search" id="searchType" onkeyup="filterTable(0)">
                    </th>
                    <th class="request-type" onclick="sortTable(1)">
                        <div class="text-and-arrow nb-demandes-associées">
                            <p>Nb personnes liées</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input class="demandes-associees" type="search" id="searchDate" onkeyup="filterTable(1)">
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($positions as $position): ?>
                        <tr>
                            <td><?= htmlspecialchars($position['name']) ?></td>
                            <td><?= $position['position_count'] ?></td>
                            <td>
                                <form action="ajout-poste.php" method="GET">
                                    <input type="hidden" name="id" value="<?= $position['id'] ?>">
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