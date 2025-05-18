<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/get-request-detail.php';

    $date_creation = (new DateTime($demande['date_demande']))->format('d/m/Y H\hi');
    $start_at = (new DateTime($demande['date_debut']))->format('d/m/Y H\hi');
    $end_at = (new DateTime($demande['date_fin']))->format('d/m/Y H\hi');
    $commentaire = $demande['commentaire'];
   
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
        <div class="content-bloc">
            <h1>
                Demande de <span><?= htmlspecialchars($demande['nom'] . ' ' . $demande['prenom']) ?></span>
            </h1>
            <h3>Demande du <td><?= htmlspecialchars($date_creation) ?></td></h3>
            <p>
                Type de demande : <td><?= htmlspecialchars($demande['type_demande']) ?></td><br>
                Période : <td><?= htmlspecialchars($start_at) ?> </td>au <td><?= htmlspecialchars($end_at) ?></td><br>
                Nombre de jours : <td><?= htmlspecialchars($demande['jours_demandes']) ?> jours</td><br><br>
                Statut de la demande : <?php
                                        $status = $demande['status'] ?? null;

                                        if ($status === 0 || $status === '0') {
                                            $class = 'refused';
                                            $text = 'Refusé';
                                        } elseif ($status === 1 || $status === '1') {
                                            $class = 'accepted';
                                            $text = 'Validé';
                                        } elseif (is_null($status)) {
                                            $class = 'pending';
                                            $text = 'En cours';
                                        }
                                        ?>

                                        <span class="<?= $class ?>"><?= $text ?></span>
            </p>
            <form action="" method="post">
                <label for="text">Commentaire du collaborateur :</label>
                <div class="input-container">
                    <textarea id="text" name="text" rows="4" cols="50" readonly>
                        <?= htmlspecialchars($demande['commentaire']) ?>
                    </textarea>
                </div>
                <br>
            </form>

            <a href="M-historique-demandes-mana.php"><button class="btn-return">Retourner à la liste de mes demandes</button></a>
            
        </div>
    </section>
    <script src="script.js"></script>
</body>
