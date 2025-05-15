<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $action = $_POST['action'];

    if ($action === 'valider') {
        $sql_request = "UPDATE request SET answer = 1 WHERE answer IS NULL";
        $stmt_request = $connexion->prepare($sql_request);
        $stmt_request->execute();
    } elseif ($action === 'refuser') {
        $sql_request = "UPDATE request SET answer = 0 WHERE answer IS NULL";
        $stmt_request = $connexion->prepare($sql_request);
        $stmt_request->execute();
    }
}


?>