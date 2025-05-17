<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-check-enabled.php';

$sql = "
    SELECT request_type.id, request_type.name, COUNT(request.id) AS request_count
    FROM request_type
    LEFT JOIN request ON request_type.id = request.request_type_id
    GROUP BY request_type.id
";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$request_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
     <div class="content-bloc2">
        <div class="flex">
            <h1>
                Type de demandes
            </h1>
            <a href="M-ajout-demande.php">
                Ajouter un type de demande
            </a>
        </div>
            <table id="requestsTable">
                <thead>
                <tr>
                    <th class="request-type" onclick="sortTable(0)">
                        <div class="text-and-arrow">
                            <p>Nom du type de demande</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input class="type-de-demandes" type="search" id="searchType" onkeyup="filterTable(0)">
                    </th>
                    <th class="request-type" onclick="sortTable(1)">
                        <div class="text-and-arrow nb-demandes-associées">
                            <p>Nb demandes associées</p>
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
                    <?php foreach ($request_types as $request_type): ?>
                        <tr>
                            <td><?= htmlspecialchars($request_type['name']) ?></td>
                            <td><?= $request_type['request_count'] ?></td>
                            <td>
                                <form action="M-ajout-demande.php" method="GET">
                                    <input type="hidden" name="id" value="<?= $request_type['id'] ?>">
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