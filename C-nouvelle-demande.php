<?php
include 'includes/affichage-avatar.php';
include 'includes/db.php';
include 'includes/C-check-connected.php';

$sql = "SELECT id, name FROM request_type";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$request_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $type_demande = $_POST['type_demande'] ?? '';
}

include 'includes/affichage-erreurs.php';
?>


<?php
include 'includes/header.php';
include 'includes/menu-collaborateur.php';
?>
        <div class="content-bloc">
            <h1>
                Effectuer une nouvelle demande
            </h1>
            <div class="form-container">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="type-demande">Type de demande - champ obligatoire</label>
                            <select id="type-demande" name="type_demande">
                                <option value="" <?= empty($type_demande) ? 'selected' : '' ?>>Sélectionner un type</option>
                                <?php foreach ($request_types as $request_type): ?>
                                    <option value="<?= $request_type['id'] ?>" <?= ($type_demande == $request_type['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($request_type['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <span class="error"><?= $errors['type_demande'] ?? ''; ?></span>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group">
                            <label for="date-debut">Date début - champ obligatoire</label>
                            <input type="datetime-local" id="date-debut" name="date_debut" value="<?php echo htmlspecialchars($date_debut); ?>" onchange="calculerJours()">
                            <span class="error"> <?php echo $errors['date_debut'] ?? ''; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="date-fin">Date de fin - champ obligatoire</label>
                            <input type="datetime-local" id="date-fin" name="date_fin" value="<?php echo htmlspecialchars($date_fin); ?>" onchange="calculerJours()">
                            <span class="error"> <?php echo $errors['date_fin'] ?? ''; ?> </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jours-demandes">Nombre de jours demandés</label>
                        <input type="number" id="jours-demandes" name="jours_demandes" value="0" <?= htmlspecialchars($jours_demandes) ?> min="0" readonly>
                    </div>

        
                    <div class="form-group">
                        <label for="receipt_file">Justificatif si applicable</label>
                        <input type="file" name="receipt_file" id="receipt_file" hidden onchange="updateFileName(this)">
                        <button type="button" class="upload-btn" onclick="document.getElementById('receipt_file').click();">
                            <img src="./PNG/fichier-texte.png" alt=""> <span id="file-name">Sélectionner un fichier</span>
                        </button>
                        <span class="error"><?php echo $errors['file'] ?? ''; ?></span>
                    </div>
       
                    <div class="form-group">
                        <label for="commentaire">Commentaire supplémentaire</label>
                        <textarea id="commentaire" name="commentaire" placeholder="Si congé exceptionnel ou sans solde, vous pouvez préciser votre demande."></textarea>
                    </div>
                    <button type="submit" class="button-connexion">Soumettre ma demande*</button>
                </form>
                <p>
                    *En cas d'erreur de saisie ou de changements, vous pourrez modifier votre demande tant que celle-ci n'a pas été validée par le manager.
                </p>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>