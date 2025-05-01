<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/ajout-nom-poste.php';

$message = null;
if (isset($_COOKIE['message'])) {
    $message = $_COOKIE['message'];
    setcookie('message', '', time() - 3600, "/"); // Supprime le cookie
}

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
      <div class="content-bloc">
        <h1>
            <?= htmlspecialchars($type_name) ?>
        </h1>
            <form action="" method="POST">
                <label for="type">Nom du type</label>
                <input type="text" name="type" class="input-type" value="<?= htmlspecialchars($type_name) ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($position_id) ?>">

                <div class="two-buttons-type2">
                    <button type="submit" name="remove" class="btn-remove">Supprimer</button>
                    <button type="submit" name="update" class="btn-update">Mettre à jour</button>
                    <a class="btn-cancel" href="M-postes.php">Annuler</a>
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
