<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/get-request-detail.php';








    $date_creation = (new DateTime($demande['date_creation']))->format('d/m/Y H\hi');
    $start_at = (new DateTime($demande['start_at']))->format('d/m/Y H\hi');
    $end_at = (new DateTime($demande['end_at']))->format('d/m/Y H\hi');
    $commentaire = $demande['commentaire'];
    






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
            <form action="" method="post">
    <label for="text">Commentaire du manager :</label>
    <div class="input-container">
        <textarea id="text" name="text" rows="4" cols="50"><?= htmlspecialchars($commentaire) ?></textarea>
    </div>
    <br>
</form>

            <a href="C-historique-demandes.php"><button class="btn-return">Retourner à la liste de mes demandes</button></a>
            
        </div>
    </section>
    <script src="script.js"></script>
</body>
