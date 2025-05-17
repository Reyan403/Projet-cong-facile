<?php

$request_id = $_GET['id'] ?? null;

$sql_request = "
    SELECT 
        request.id,
        request.request_type_id,
        request_type.name AS type_demande,
        request.created_at AS date_demande,
        request.start_at AS date_debut,
        request.end_at AS date_fin,
        request.jours_demandes,
        request.comment AS commentaire,
        request.receipt_file AS justificatif,
        person.first_name AS prenom,
        person.last_name AS nom
    FROM request
    JOIN request_type ON request.request_type_id = request_type.id
    JOIN person ON request.collaborator_id = person.id
    WHERE request.id = :request_id

";

$stmt = $connexion->prepare($sql_request);
$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
$stmt->execute();
$demande = $stmt->fetch(PDO::FETCH_ASSOC);

$cheminFichier = !empty($demande['justificatif']) ? $demande['justificatif'] : null;
?>
