<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-check-enabled.php';

$sql = "
    SELECT position.id, position.name, COUNT(person.id) AS position_count
    FROM position
    LEFT JOIN person ON position.id = person.position_id
    GROUP BY position.id
";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$positions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
     <div class="content-bloc2">
        <div class="flex">
            <h1>
                Postes
            </h1>
            <a href="M-ajout-poste.php">
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
                            <form action="M-ajout-poste.php" method="GET">
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