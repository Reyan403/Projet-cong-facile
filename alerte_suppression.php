<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';

if($_SERVER ['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['cancel'])) {
        header('Location: ajout-demande.php');
        exit();
    } else if(isset($_POST['confirm'])) {
        $sql = "DELETE FROM request_type WHERE name = :name";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->execute();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <title>Mentalworks</title>
    </head>
<body>
<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
        <div class="content-bloc">
            <h1>
                Êtes-vous sûr de vouloir supprimer ce type de demande ?
            </h1>
            <form action="" method="POST">
                <div class="two-buttons-type2">
                    <button type="submit" name ="confirm" class="btn-remove">Confirmer</button>
                    <button type="submit" name ="cancel" class="btn-update">Annuler</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>