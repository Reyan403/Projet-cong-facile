<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/supprimer-postes.php';
include 'includes/M-check-enabled.php';
?>


<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>

<div class="content-bloc">
        <h1>Êtes-vous sûr de vouloir supprimer "<?= htmlspecialchars($type_name) ?>" ?</h1>
        
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($position_id) ?>">
            
            <div class="two-buttons-type2">
                <button type="submit" name="confirm" class="btn-remove">Confirmer</button>
                <button type="submit" name="cancel" class="btn-update">Annuler</button>
            </div>

            <?php if (isset($errors)) 
            { echo '<span class="error">' . $errors . '</span>'; } 
            ?>
        </form>
    </div>
    </section>

</body>
</html>
