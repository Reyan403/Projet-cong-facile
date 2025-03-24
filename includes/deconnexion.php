<?php

// On démarre la session
session_start();

// On supprime les données de la sesssion.
session_destroy();

// On redémarre la session pour y ajouter un message.
session_start();

$_SESSION['message'] = [
    'type' => 'success',
    'message' => 'Vous êtes maintenant déconnecté.',
];

// On redirige l'utilisateur sur la page d'accueil.
header('Location: index.php');

exit();