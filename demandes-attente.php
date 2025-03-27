<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

$collaborator_id = $_SESSION['collaborator_id']; 

// Requête SQL pour récupérer l'historique des demandes du collaborateur sans tri
$sql = "SELECT r.id, r.start_at, r.end_at, r.request_type_id, r.collaborateur_id, 
               DATEDIFF(r.end_at, r.start_at) AS jours_demandes,
               rt.name AS type_demande, r.created_at AS date_creation
        FROM request r
        LEFT JOIN request_type rt ON r.request_type_id = rt.id
        WHERE r.collaborator_id = ?"; 

// Préparer la requête SQL
$stmt = $connexion->prepare($sql);

// Exécuter la requête avec l'ID du collaborateur comme paramètre
$stmt->execute([$collaborator_id]);

// Récupérer toutes les demandes du collaborateur
$demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <h1>
                Historique des demandes
            </h1>
            <table id="requestsTable">
                <thead>
                <tr>
                    <th class="request-type" onclick="sortTable(0)">
                        <div class="text-and-arrow">
                            <p>Type de demande</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchType" onkeyup="filterTable(0)">
                    </th>
                    <th class="request-type" onclick="sortTable(1)">
                        <div class="text-and-arrow">
                            <p>Demandée le</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchDate" onkeyup="filterTable(1)">
                    </th>
                    <th class="request-type" onclick="sortTable(2)">
                        <div class="text-and-arrow">
                            <p>Collaborateur</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchStartDate" onkeyup="filterTable(2)">
                    </th>
                    <th class="request-type" onclick="sortTable(3)">
                        <div class="text-and-arrow">
                            <p>Date de début</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchEndDate" onkeyup="filterTable(3)">
                    </th>
                    <th class="request-type" onclick="sortTable(4)">
                        <div class="text-and-arrow">
                            <p>Date de fin</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchDays" onkeyup="filterTable(4)">
                    </th>
                    <th class="request-type" onclick="sortTable(5)">
                        <div class="text-and-arrow">
                            <p>Nb de jours</p>
                            <div class="arrow">
                                <img class="arrow-top" src="./PNG/fleche-droite (8).png" alt="flèche haut">
                                <img class="arrow-bottom" src="./PNG/fleche-droite (8).png" alt="flèche bas">
                            </div>
                        </div>
                        <input type="search" id="searchStatus" onkeyup="filterTable(5)">
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $demande) : 
                        // Convertir les dates en format 03/10/2025 18h30
                        $date_creation = (new DateTime($demande['date_creation']))->format('d/m/Y H\hi');
                        $start_at = (new DateTime($demande['start_at']))->format('d/m/Y H\hi');
                        $end_at = (new DateTime($demande['end_at']))->format('d/m/Y H\hi');
                        
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($demande['type_demande']) ?></td>
                            <td><?= htmlspecialchars($date_creation) ?></td>
                            <td><?= htmlspecialchars($demande['collaborator_id']) ?></td>
                            <td><?= htmlspecialchars($start_at) ?></td>
                            <td><?= htmlspecialchars($end_at) ?></td>
                            <td><?= htmlspecialchars($demande['jours_demandes']) ?> jours</td>
                            <td><button class="details-btn">Détails</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section> 
    <script src="script.js"></script>
</body>
</html>