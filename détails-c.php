<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/get-requests_C.php';

?>


<?php foreach ($demandes as $demande) : 
    $date_creation = (new DateTime($demande['date_creation']))->format('d/m/Y H\hi');
    $start_at = (new DateTime($demande['start_at']))->format('d/m/Y H\hi');
    $end_at = (new DateTime($demande['end_at']))->format('d/m/Y H\hi');
    endforeach; ?>

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
include 'includes/menu-collaborateur.php';
?>
        <div class="content-bloc">
            <h1>
                Ma demande de congé
            </h1>
            <h3>Demande du <td><?= htmlspecialchars($date_creation) ?></td></h3>
            <p>
                Type de demande : <td><?= htmlspecialchars($demande['type_demande']) ?></td><br>
                Période : <td><?= htmlspecialchars($start_at) ?> </td>au <td><?= htmlspecialchars($end_at) ?></td><br>
                Nombre de jours : <td><?= htmlspecialchars($demande['jours_demandes']) ?> jours</td><br><br>
                Statut de la demande : <td><?= isset($demande['statut']) ? htmlspecialchars($demande['statut']) : 'Non défini' ?></td>
            </p>
            <form action="traitement.php" method="post">
            <label for="text">Commentaire du manager :</label>
                <div class="input-container">
                    <input type="text" id="text" name="text" placeholder="Profite bien de tes vacances à Mayorque et surtout, n'oublie pas la carte postale !!!">
                </div>
            <br>
            </form>
            <a href="historique-demandes.php"><button class="btn-return">Retourner à la liste de mes demandes</button></a>
            
        </div></button>
    </section>
    <script src="script.js"></script>
</body>

