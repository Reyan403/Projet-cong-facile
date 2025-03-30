<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header('Location: ajout-demande.php');
        exit();
    } else if (isset($_POST['confirm']) && isset($_POST['id'])) {
        $sql = "DELETE FROM request_type WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection avec message de succès
            header('Location: ajout-demande.php?deleted=1');
            exit();
        } else {
            $error = "Erreur lors de la suppression.";
        }
    }
}

// Récupération de l'ID depuis l'URL
$request_id = $_GET['id'] ?? null;
$type_name = '';

// Vérifier si l'ID est valide
if ($request_id) {
    $sql = "SELECT name FROM request_type WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $request_id, PDO::PARAM_INT);
    $stmt->execute();
    $request_type = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($request_type) {
        $type_name = $request_type['name'];
    } else {
        $error = "Ce type de demande n'existe pas.";
    }
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
        <h1>Êtes-vous sûr de vouloir supprimer "<?= htmlspecialchars($type_name) ?>" ?</h1>
        
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($request_id) ?>">
            
            <div class="two-buttons-type2">
                <button type="submit" name="confirm" class="btn-remove">Confirmer</button>
                <button type="submit" name="cancel" class="btn-update">Annuler</button>
            </div>

            <?php if (isset($error)) 
            { echo '<span class="error">' . $error . '</span>'; } 
            ?>
        </form>
    </div>
    </section>
</body>
</html>