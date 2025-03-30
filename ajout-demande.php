<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

$errors = [];
$message = '';
$request_id = $_GET['id'] ?? null;
$type_name = '';

// Traitement de la suppression
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    // Redirection vers la page de suppression pour confirmation
    if (!empty($_POST['id'])) {
        header('Location: alerte_suppression.php?id=' . $_POST['id']);
        exit();
    } else {
        $errors[] = "Impossible de supprimer un type non existant.";
    }
}

// Mise à jour ou ajout d'un type de demande
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $type = trim($_POST['type'] ?? '');
    $request_id = $_POST['id'] ?? null;

    if (!empty($type)) {
        // Vérification de l'existence du type
        $sql_check = "SELECT id FROM request_type WHERE name = :name";
        $stmt_check = $connexion->prepare($sql_check);
        $stmt_check->bindParam(':name', $type);
        $stmt_check->execute();
        $existing_type = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existing_type && (!$request_id || $existing_type['id'] != $request_id)) {
            $errors[] = "Ce type de demande existe déjà.";
        } else {
            if ($request_id) {
                $sql_update = "UPDATE request_type SET name = :name WHERE id = :id";
                $stmt_update = $connexion->prepare($sql_update);
                $stmt_update->bindParam(':name', $type);
                $stmt_update->bindParam(':id', $request_id, PDO::PARAM_INT);
                if ($stmt_update->execute()) {
                    $message = "Le type de demande a été mis à jour avec succès.";
                } else {
                    $errors[] = "Erreur lors de la mise à jour.";
                }
            } else {
                $sql_insert = "INSERT INTO request_type (name) VALUES (:name)";
                $stmt_insert = $connexion->prepare($sql_insert);
                $stmt_insert->bindParam(':name', $type);
                if ($stmt_insert->execute()) {
                    $message = "Le nouveau type de demande a été ajouté avec succès.";
                    header('Location: ajout-demande.php?success=1');
                    exit();
                } else {
                    $errors[] = "Erreur lors de l'ajout.";
                }
            }
        }
    } else {
        $errors[] = "Veuillez entrer un nom.";
    }
}

//Gestion des messages de succès
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message = "Le nouveau type de demande a été ajouté avec succès.";
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

//Récupération des types de demandes
$sql = "SELECT id, name FROM request_type";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$request_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($request_types as &$type) {
    $sql_count = "SELECT COUNT(*) FROM request WHERE request_type_id = :id";  
    $stmt_count = $connexion->prepare($sql_count);
    $stmt_count->bindParam(':id', $type['id'], PDO::PARAM_INT);  
    $stmt_count->execute();
    $result = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $type['request_count'] = $result['COUNT(*)'];  
}

//Récupération du nom du type en fonction de l'id
if ($request_id) {
    $sql = "SELECT name FROM request_type WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $request_id, PDO::PARAM_INT);
    $stmt->execute();
    $request_type = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($request_type) {
        $type_name = $request_type['name'];
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
        <h1>Type de demandes </h1>
            <form action="" method="POST">
                <label for="type">Nom du type</label>
                <input type="text" name="type" class="input-type" value="<?= htmlspecialchars($type_name) ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($request_id) ?>">

                <div class="two-buttons-type2">
                    <button type="submit" name="remove" class="btn-remove">Supprimer</button>
                    <button type="submit" name="update" class="btn-update">Mettre à jour</button>
                </div>

                <?php
                foreach ($errors as $error) {
                    echo '<span class="error">' . $error . '</span>';
                }
                if (!empty($message)) {
                    echo '<span class="message green">' . $message . '</span>';
                }

                if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
                    echo '<span class="message green">Le type de demande a été supprimé avec succès.</span>';
                }
                ?>
            </form>
        </div>
    </section>
</body>
</html>
