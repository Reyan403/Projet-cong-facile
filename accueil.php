<?php
include 'includes/affichage-avatar.php';
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
include 'includes/menu-collaborateur.php';
?>
        <div class="content-bloc">
            <h1>
                CongéFacile
            </h1>
            <p>
                CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l’entreprise.
                Plus besoin d’échanges interminables ou de formulaires papier : en quelques clics, vous pouvez gérer vos absences en toute transparence et simplicité.
            </p>
            <h2>
                Etapes
            </h2>
            <div class="content-timeline">
                <div class="timeline">
                    <div class="step">
                        <div class="circle active">1</div>
                        <div class="text">Étape 1</div>
                    </div>
                    <div class="line"></div>
                    <div class="step">
                        <div class="circle">2</div>
                        <div class="text">Étape 2</div>
                    </div>
                    <div class="line"></div>
                    <div class="step">
                        <div class="circle">3</div>
                        <div class="text">Étape 3</div>
                    </div>
                </div>
                <div class="name-steps">
                    <div class="name-step">
                        <p>
                            J'effectue ma demande de congés
                        </p>
                    </div>
                    <div class="name-step">
                        <p>
                            Mon manager valide ou refuse la demande
                        </p>
                    </div>
                    <div class="name-step">
                        <p>
                            Je consulte l'historique de mes demandes
                        </p>
                    </div>
                </div>
            </div>
            <div class="mail-mentalworks">
                <p>
                    En cas de difficulté avec l'application, veuillez envoyer un email à <a href="https://mentalworks.fr/nous-contacter/">contact@mentalworks.fr</a>.
                </p>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
