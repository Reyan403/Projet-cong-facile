<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-check-connected.php';
include 'includes/accepter-refuser.php';
include 'includes/get-request-detail.php';
?>

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
                Demande de <span><?= htmlspecialchars($demande['nom'] . ' ' . $demande['prenom']) ?></span>
            </h1>
            <h3>Demande du <span><?= htmlspecialchars($date_creation) ?></span></h3>
            <p>
                Période : <span><?= htmlspecialchars($start_at) ?></span> au <span><?= htmlspecialchars($end_at) ?></span><br>
                Type de demande : <span><?= htmlspecialchars($demande['type_demande']) ?></span><br>
                Nombre de jours : <span><?= htmlspecialchars($demande['jours_demandes']) ?> jours</span><br>
            </p>
            <form action="" method="post">
            <label for="text">Commentaire supplémentaire</label>
            <div class="input-container">
                <input type="text" id="text" name="text" value="<?= htmlspecialchars($demande['commentaire']) ?>" readonly>
            </div>
            <br>

            </form>
            <?php if (!empty($cheminFichier) && file_exists($_SERVER['DOCUMENT_ROOT'] . $cheminFichier)) : ?>
                <a href="<?= htmlspecialchars($cheminFichier) ?>" download>
                    <button type="button" class="telechargement">
                        Télécharger le justificatif <i class='bx bx-download'></i>
                    </button>
                </a>
            <?php else : ?>
                <p>Aucun justificatif disponible.</p>
            <?php endif; ?>

            <div class="answer-request">   
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
        </div>
    </section>
    <script src="script.js"></script>
</body> 
</html> 