<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/get-requests_M.php';
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
if (isset($_SESSION['collaborator_id'])) {
    $requete = $connexion->prepare("SELECT comment FROM request WHERE collaborator_id = :collaborator_id ORDER BY created_at DESC LIMIT 1");
    $requete->execute(['collaborator_id' => $_SESSION['collaborator_id']]);
    $commentairecollaborateur = $requete->fetchColumn() ?? ''; // Si null, mettre une chaîne vide
} else {
    echo "Erreur : Collaborator ID non défini en session.";
}
?>
<?php foreach ($demandes as $demande) : 
                        // Convertir les dates en format 03/10/2025 18h30
                        $date_creation = (new DateTime($demande['created_at']))->format('d/m/Y H\hi');
                        $start_at = (new DateTime($demande['start_at']))->format('d/m/Y H\hi');
                        $end_at = (new DateTime($demande['end_at']))->format('d/m/Y H\hi');
                        
                    ?>
                       
                    <?php endforeach; ?>
        <div class="content-bloc">
            <h1>
                Demande de <td><?= htmlspecialchars($demande['last_name'] . ' ' . $demande['first_name']) ?></td>
            </h1>
            <h3>Demande du <td><?= htmlspecialchars($date_creation) ?></td>
            <p>
                Type de demande : <td><?= htmlspecialchars($demande['request_type_name']) ?></td><br>
                Période : <td><?= htmlspecialchars($start_at) ?></td> au <td><?= htmlspecialchars($end_at) ?></td><br>
                Nombre de jours : <td><?= htmlspecialchars($demande['jours_demandes']) ?> jours</td><br>
            </p>
            <form action="traitement.php" method="post">
            <label for="text">Commentaire supplémentaire</label>
            <div class="input-container">
            <input type="text" id="text" name="text" placeholder="Ajoutez un commentaire..." value="<?php echo htmlspecialchars($commentairecollaborateur); ?>">
            </div>
            <br>

            </form>
            <button class="telechargement">Télécharger le justificatif <i class='bx bx-download'></i></button>
            <h1>
                Répondre à la demande
            </h1>
            
            
            <form action="traitement.php" method="post">
            <label for="text"><p>Saisir un commentaire</p></label>
                <div class="input-container-com2">
                    <input type="text" id="text" name="text">
                </div>
            <br>
            </form>
            <div class="btn-assemble">
                <button class="refus">Refuser la demande</button>
                <button class="valid" id="validate-request">Valider la demande</button>
            </div>

            <div id="confirmation-message" style="display: none;">
            <p>Votre demande a bien été validée.</p>
            </div>

        </div>
    </section>
    <script src="script.js"></script>
</body>
</body>
</html>