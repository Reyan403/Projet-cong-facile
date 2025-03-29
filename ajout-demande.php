<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $type = $_POST['type'] ?? '';
    $update = $_POST['update'] ?? '';
    $remove = $_POST['remove'] ?? '';

    if (isset($remove) && empty($type)) {
        $errors['remove'] = 'Vous devez sélectionner un type de demande pour le supprimer.';
    }

    if (isset($update) && empty($type)) {
        $errors['update'] = 'Vous devez ajouter un type de demande avant de pouvoir le mettre à jour.';
    }

    if (empty($errors)) {
        // Si vous voulez mettre à jour un type de demande
        if (isset($update) && !empty($type)) {
            // Vérification que le type de demande n'existe pas déjà dans la base
            $sql_check = "SELECT * FROM request_type WHERE name = :name";
            $stmt_check = $connexion->prepare($sql_check);
            $stmt_check->bindParam(':name', $type);
            $stmt_check->execute();
            $existing_type = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if (!$existing_type) {
                $sql = "INSERT INTO request_type (name) VALUES (:name)";
                $stmt = $connexion->prepare($sql);
                $stmt->bindParam(':name', $type);
                
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Le type de demande a été ajouté avec succès.";
                    header('Location: ' . $_SERVER['PHP_SELF']);
                    exit;
                } else {
                    $message = "Erreur lors de l'ajout du type de demande.";
                }
            }
        }
        
        // Si vous voulez supprimer un type de demande
        if (isset($remove) && !empty($type)) {
            // Redirection vers la page de confirmation de suppression
            header('Location: alerte_suppression.php');
            exit();
        }
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$sql = "SELECT id, name FROM request_type";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$request_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

$request_id = $_GET['id'] ?? null;
$type_name = ''; 

if ($request_id) {
    // Récupérer le nom du type en fonction de l'id
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
            <h1>
                Types de demandes
            </h1>
            <form action="" method="POST">
                <label for="type">Nom du type</label>
                <input type="text" name="type" class="input-type" value="<?= htmlspecialchars($type_name) ?>">
                <div class="two-buttons-type2">
                    <button type="submit" name ="remove" class="btn-remove">Supprimer</button>
                    <button type="submit" name ="update" class="btn-update">Mettre à jour</button>
                </div>
                <?php
                    if (isset($errors['remove'])) {
                        echo '<span class="error">' . $errors['remove'] . '</span>';
                    }
                    if (isset($errors['update'])) {
                        echo '<span class="error">' . $errors['update'] . '</span>';
                    } else {
                        if (isset($message)) {
                            echo '<span class=" message green">' . $message . '</span>';
                        }
                    }
                ?>
            </form>
        </div>
    </section>
</body>
</html>