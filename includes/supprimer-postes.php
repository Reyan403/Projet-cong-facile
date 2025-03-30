<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header('Location: ajout-poste.php');
        exit();
    } else if (isset($_POST['confirm']) && isset($_POST['id'])) {
        $sql = "DELETE FROM position WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection avec message de succès
            header('Location: ajout-poste.php?deleted=1');
            exit();
        } else {
            $error = "Erreur lors de la suppression.";
        }
    }
}

// Récupération de l'ID depuis l'URL
$position_id = $_GET['id'] ?? null;
$type_name = '';

// Vérifier si l'ID est valide
if ($position_id) {
    $sql = "SELECT name FROM position WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $position_id, PDO::PARAM_INT);
    $stmt->execute();
    $position_type = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($position_type) {
        $type_name = $position_type['name'];
    } else {
        $error = "Ce type de demande n'existe pas.";
    }
}
?>