<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
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
                Type de demandes
            </h1>
            <a href="ajout-demande.php">
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

                </tbody>
            </table>
        </div>
    </section> 
    <script src="script.js"></script>
</body>
</html>