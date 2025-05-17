<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/ajout-type-de-demande.php';
include 'includes/M-check-connected.php';

$message = null;
if (isset($_COOKIE['message'])) {
    $message = $_COOKIE['message'];
    setcookie('message', '', time() - 3600, "/"); // Supprime le cookie
}
?>


<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
      <div class="content-bloc">
        <h1>Type de demandes </h1>
            <form action="" method="POST">
                <label for="type">Nom du type</label>
                <input type="text" name="type" class="input-type" value="<?= htmlspecialchars($type_name) ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($request_id) ?>">

                <div class="two-buttons-type2">
                    <button type="submit" name="remove" class="btn-remove">Supprimer</button>
                    <button type="submit" name="update" class="btn-update">Mettre à jour</button>
                    <a class="btn-cancel" href="M-type_de_demandes.php">Annuler</a>
                </div>

                <?php
                foreach ($errors as $error) {
                    echo '<span class="error">' . $error . '</span>';
                }
                ?>

                <?php 
                    if ($message): 
                        echo "<div class='message green'>" . htmlspecialchars($message) . "</div>";
                    endif; 
                ?>
            </form>
        </div>
    </section>
</body>
</html>
  