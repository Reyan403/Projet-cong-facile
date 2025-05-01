<?php
$errors = [];
$message = '';
$request_id = $_GET['id'] ?? null;
$type_name = '';

// Traitement de la suppression
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    // Redirection vers la page de suppression pour confirmation
    if (!empty($_POST['id'])) {
        header('Location: M-alerte_suppression.php?id=' . $_POST['id']);
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
                    setcookie('message', 'La demande a été mise à jour avec succès.', time() + 10, "/"); 
                    header('Location: M-ajout-demande.php');
                    exit();
                } else {
                    $errors[] = "Erreur lors de la mise à jour.";
                }
            } else {
                $sql_insert = "INSERT INTO request_type (name) VALUES (:name)";
                $stmt_insert = $connexion->prepare($sql_insert);
                $stmt_insert->bindParam(':name', $type);
                if ($stmt_insert->execute()) {
                    setcookie('message', 'La demande a été ajoutée avec succès.', time() + 10, "/"); 
                    header('Location: M-ajout-demande.php');
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