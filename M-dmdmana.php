<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/accepter-refuser.php';
include 'includes/get-request-detail.php';

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
    <?php  
        $date_creation = (new DateTime($demande['date_demande']))->format('d/m/Y H\hi');
        $start_at = (new DateTime($demande['date_debut']))->format('d/m/Y H\hi');
        $end_at = (new DateTime($demande['date_fin']))->format('d/m/Y H\hi');
    ?>
    
        <div class="content-bloc">
            <h1>
                Demande de <td><?= htmlspecialchars($demande['nom'] . ' ' . $demande['prenom']) ?></td>
            </h1>
            <h3>Demande du <td><?= htmlspecialchars($date_creation) ?></td></h3>
            <p>
                Type de demande : <td><?= htmlspecialchars($demande['type_demande']) ?></td><br>
                Période : <td><?= htmlspecialchars($start_at) ?></td> au <td><?= htmlspecialchars($end_at) ?></td><br>
                Nombre de jours : <td><?= htmlspecialchars($demande['jours_demandes']) ?> jours</td><br>
            </p>
            <form action="" method="post">
            <label for="text">Commentaire supplémentaire</label>
            <div class="input-container">
                <input type="text" id="text" name="text" value="">
            </div>
            <br>

            </form>
            <button class="telechargement">Télécharger le justificatif <i class='bx bx-download'></i></button>
            <h1>
                Répondre à la demande
            </h1>
            
            
            <form action="" method="post">
            <input type="hidden" name="demande_id" value="<?= htmlspecialchars($demande['id']) ?>">

            <label for="commentaire">Saisir un commentaire</label>
            <div class="input-container-com2">
                <input type="text" id="commentaire" name="commentaire">
            </div>
            <br>
            
            <div class="btn-assemble">
                <button type="submit" name="action" value="refuser" class="refus">Refuser la demande</button>
                <button type="submit" name="action" value="valider" class="valid">Valider la demande</button>
            </div>
            </form>

        </div>
    </section>
    <script src="script.js"></script>
</body> 
</html> 