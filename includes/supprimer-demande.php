<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header('Location: M-ajout-demande.php');
        exit();
    } else if (isset($_POST['confirm']) && isset($_POST['id'])) {
        $sql = "DELETE FROM request_type WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection avec message de succès
            header('Location: M-type_de_demandes.php');
            exit();
        } else {
            $errors = "Erreur lors de la suppression.";
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
        $errors = "Ce type de demande n'existe pas.";
    }
}
?>