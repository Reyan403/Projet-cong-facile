<?php /*
include 'includes/db.php'; // Inclure la connexion à la base de données

// Vérifier si la demande et l'action sont définies
if (isset($_POST['demande_id']) && isset($_POST['action'])) {
    $demande_id = $_POST['demande_id'];
    $action = $_POST['action'];
    $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';

    // Mettre à jour le champ answer selon l'action (valider ou refuser)
    if ($action == 'valider') {
        $answer = 1; // 1 pour validé
    } elseif ($action == 'refuser') {
        $answer = 0; // 0 pour refusé
    } else {
        // Si l'action n'est pas validée ou refusée, il n'y a rien à faire
        echo "Action invalide.";
        exit;
    }

    // Préparer la requête pour mettre à jour la demande
    $requete = $connexion->prepare("UPDATE request SET answer = :answer, answer_comment = :commentaire, answer_at = CURRENT_TIMESTAMP WHERE id = :demande_id");
    $requete->execute([
        'answer' => $answer,
        'commentaire' => $commentaire,
        'demande_id' => $demande_id
    ]);

    // Rediriger l'utilisateur après l'action
    header('Location: historique-demandes-mana.php'); // Remplacer par la page où tu veux rediriger l'utilisateur
    exit;
} else {
    echo "Erreur : la demande ou l'action n'est pas définie.";
}*/
?>






<?php
$errors = [];
$message = '';
$request_id = $_GET['id'] ?? null;
$type_name = '';

// Traitement de la validation d'une demande
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['validate'])) {
    $request_id = $_POST['id'] ?? null;

    if ($request_id) {
        // Mettre à jour la demande avec l'état "validé" (answer = 1)
        $sql_update = "UPDATE request SET answer = 1, answer_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt_update = $connexion->prepare($sql_update);
        $stmt_update->bindParam(':id', $request_id, PDO::PARAM_INT);

        if ($stmt_update->execute()) {
            $message = "La demande a été validée avec succès.";
        } else {
            $errors[] = "Erreur lors de la validation de la demande.";
        }
    } else {
        $errors[] = "L'ID de la demande est manquant.";
    }
}

// Gestion des messages de succès
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message = "Le nouveau type de demande a été ajouté avec succès.";
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Récupération des types de demandes
$sql = "SELECT id, name FROM request_type";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$request_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
///////////////////////////////////////////////////////
foreach ($request_types as &$type) {
    $sql_count = "SELECT COUNT(*) FROM request WHERE request_type_id = :id";  
    $stmt_count = $connexion->prepare($sql_count);
    $stmt_count->bindParam(':id', $type['id'], PDO::PARAM_INT);  
    $stmt_count->execute();
    $result = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $type['request_count'] = $result['COUNT(*)'];  
}

// Récupération du nom du type en fonction de l'id
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
