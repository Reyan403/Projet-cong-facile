<?php
include 'includes/db.php';

// Déclaration des variables
$type_demande = $date_debut = $date_fin = $jours_demandes = $justificatif = "";
$errors = [];

// Vérification de l'utilisateur connecté
$collaborator_id = $_SESSION['user']['id'] ?? null;
$department_id = $_SESSION['user']['department_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type_demande = $_POST['type_demande'] ?? '';
    $date_debut = $_POST['date_debut'] ?? '';
    $date_fin = $_POST['date_fin'] ?? '';
    $jours_demandes = $_POST['jours_demandes'] ?? '';
    $commentaire = $_POST['commentaire'] ?? '';

    // Vérification des champs obligatoires (sans `jours_demandes`)
    if (empty($_POST['type_demande'])) { 
        $errors['type_demande'] = "Veuillez choisir un type de demande.";
    }

    if (empty($_POST['date_debut'])) { 
        $errors['date_debut'] = "Veuillez choisir une date de début.";
    } else if (!empty($_POST['date_fin']) && $_POST['date_debut'] > $_POST['date_fin']) {
        $errors['date_debut'] = "La date de début ne peut pas être supérieure à la date de fin.";
    }

    if (empty($_POST['date_fin'])) {
        $errors['date_fin'] = "Veuillez choisir une date de fin.";
    }

    // Gestion du fichier uploadé (justificatif)
    if (!empty($_FILES['receipt_file']['name'])) { 
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'; 

        // Vérifier si le dossier 'uploads' existe, sinon le créer
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); 
        }

        $filename = time() . '_' . basename($_FILES['receipt_file']['name']);
        $target_file = $upload_dir . $filename;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $max_size = 10 * 1024 * 1024; // 10 Mo

        // Vérifier la taille et le format
        if ($_FILES['receipt_file']['size'] > $max_size) {
            $errors['file'] = "❌ Le fichier est trop volumineux (max 10 Mo).";
        } elseif (!in_array($file_type, ['jpg', 'jpeg', 'png', 'pdf', 'docx', 'txt'])) {
            $errors['file'] = "❌ Format de fichier non supporté. Seuls JPG, JPEG, PNG, PDF, TXT et DOCX sont autorisés.";
        } elseif (!move_uploaded_file($_FILES['receipt_file']['tmp_name'], $target_file)) {
            $errors['file'] = "❌ Échec du téléchargement du fichier.";
        } else {
            $justificatif = '/uploads/' . $filename;
        }
    }

    // Si aucune erreur, insérer la demande dans la base de données
    if (empty($errors)) {
        // Assurez-vous que le type de demande est valide
        $type_demande_id = $_POST['type_demande']; // Récupération de l'ID correspondant

        $sql = "INSERT INTO request (request_type_id, collaborator_id, department_id, created_at, start_at, end_at, comment, receipt_file, jours_demandes) 
                VALUES (:request_type_id, :collaborator_id, :department_id, NOW(), :start_at, :end_at, :comment, :receipt_file, :jours_demandes)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ':request_type_id' => $type_demande_id,
            ':collaborator_id' => $collaborator_id, 
            ':department_id' => $department_id,     
            ':start_at' => $date_debut,
            ':end_at' => $date_fin,
            ':comment' => $commentaire,
            ':jours_demandes' => $jours_demandes,
            ':receipt_file' => $justificatif ?? null
        ]);

        // Rediriger l'utilisateur après l'enregistrement
        header("Location: C-demande-envoye.php");
        exit();
    }
}
?>
