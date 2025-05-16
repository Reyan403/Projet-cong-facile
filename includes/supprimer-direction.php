<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header('Location: M-directions-services.php');
        exit();
    } else if (isset($_POST['confirm']) && isset($_POST['id'])) {
        $sql = "DELETE FROM department WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection avec message de succès
            header('Location: M-directions-services.php');
            exit();
        } else {
            $errors = "Erreur lors de la suppression.";
        }
    }
}

// Récupération de l'ID depuis l'URL
$department_id = $_GET['id'] ?? null;
$type_name = '';

// Vérifier si l'ID est valide
if ($department_id) {
    $sql = "SELECT name FROM department WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $department_id, PDO::PARAM_INT);
    $stmt->execute();
    $department = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($department) {
        $type_name = $department['name'];
    } else {
        $errors = "Ce type de demande n'existe pas.";
    }
}
?>