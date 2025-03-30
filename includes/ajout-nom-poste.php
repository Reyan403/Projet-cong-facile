<?php

require './includes/db.php'; // Assurez-vous d'inclure la connexion à la base de données

$errors = [];
$message = '';
$position_id = $_GET['id'] ?? null;
$type_name = '';

// Traitement de la suppression
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    // Redirection vers la page de suppression pour confirmation
    if (!empty($_POST['id'])) {
        header('Location: alerte_sup_postes.php?id=' . $_POST['id']);
        exit();
    } else {
        $errors[] = "Impossible de supprimer un type non existant.";
    }
}
// Traitement de l'ajout ou de la mise à jour d'un poste
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $type = trim($_POST['type'] ?? '');
    $position_id = $_POST['id'] ?? null;

    if (!empty($type)) {
        // Vérification de l'existence du poste
        $sql_check = "SELECT id FROM position WHERE name = :name";
        $stmt_check = $connexion->prepare($sql_check);
        $stmt_check->bindParam(':name', $type);
        $stmt_check->execute();
        $existing_position = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existing_position && (!$position_id || $existing_position['id'] != $position_id)) {
            $errors[] = "Ce poste existe déjà.";
        } else {
            if ($position_id) {
                // Mise à jour d'un poste existant
                $sql_update = "UPDATE position SET name = :name WHERE id = :id";
                $stmt_update = $connexion->prepare($sql_update);
                $stmt_update->bindParam(':name', $type);
                $stmt_update->bindParam(':id', $position_id, PDO::PARAM_INT);
                if ($stmt_update->execute()) {
                    $message = "Le poste a été mis à jour avec succès.";
                } else {
                    $errors[] = "Erreur lors de la mise à jour.";
                }
            } else {
                // Ajout d'un nouveau poste
                $sql_insert = "INSERT INTO position (name) VALUES (:name)";
                $stmt_insert = $connexion->prepare($sql_insert);
                $stmt_insert->bindParam(':name', $type);
                if ($stmt_insert->execute()) {
                    $message = "Le poste a été ajouté avec succès.";
                    header('Location: ajout-position.php?success=1');
                    exit();
                } else {
                    $errors[] = "Erreur lors de l'ajout.";
                }
            }
        }
    } else {
        $errors[] = "Veuillez entrer un nom de poste.";
    }
}

// Gestion des messages de succès
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message = "Le poste a été ajouté avec succès.";
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Récupération des postes
$sql = "SELECT id, name FROM position";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$positions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération du nom du poste en fonction de l'id
if ($position_id) {
    $sql = "SELECT name FROM position WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $position_id, PDO::PARAM_INT);
    $stmt->execute();
    $position = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($position) {
        $type_name = $position['name'];
    }
}
?>
