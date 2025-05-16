<?php
// Récupération de l'ID du collaborateur depuis la session
$collaborator_id = $_SESSION['collaborator_id']; 

// Requête SQL pour récupérer l'historique des demandes du collaborateur sans tri
$sql = "SELECT r.id, r.start_at, r.end_at, r.request_type_id, 
               DATEDIFF(r.end_at, r.start_at) AS jours_demandes,
               rt.name AS type_demande, r.created_at AS date_creation,
               r.answer AS status
        FROM request r
        LEFT JOIN request_type rt ON r.request_type_id = rt.id
        WHERE r.collaborator_id = ?"; 

// Préparer la requête SQL
$stmt = $connexion->prepare($sql);

// Exécuter la requête avec l'ID du collaborateur comme paramètre
$stmt->execute([$collaborator_id]);

// Récupérer toutes les demandes du collaborateur
$demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>