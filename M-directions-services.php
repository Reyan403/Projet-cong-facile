<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-check-connected.php';

$sql = "
    SELECT department.id, department.name
    FROM department
    LEFT JOIN request ON department.id = request.department_id
    GROUP BY department.id
";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<?php

include 'includes/header.php';
include 'includes/menu-manager.php';
?>
     <div class="content-bloc2">
        <div class="flex">
            <h1>
                Directions/Services
            </h1>
            <a href="M-ajout-directions-services.php">
                Ajouter une direction/services
            </a>
        </div>
            <table id="requestsTable">
                <thead>
                <tr>
                    <th class="request-type" onclick="sortTable(0)">
                        <div class="text-and-arrow">
                            <p>Nom de la direction ou du service</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input class="type-de-demandes" type="search" id="searchType" onkeyup="filterTable(0)">
                    </th>
                    
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($departments as $department): ?>
                        <tr>
                            <td><?= htmlspecialchars($department['name']) ?></td>
                            
                            <td>
                                <form action="M-ajout-directions-services.php" method="GET">
                                    <input type="hidden" name="id" value="<?= $department['id'] ?>">
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