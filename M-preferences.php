<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
?>



<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>

    <div class="content-bloc">
        <h1>
            Mes préférences
        </h1>
        <div class="btn-switch">
            <button id="switchBtn"></button>
            <p>
                Être alerté par email lorsqu'une demande de congé arrive
            </p>
        </div>
        <button class="button-save">Enregistrer mes préférences</button>
    </div>

    <script src="script.js"></script>
</body>
</html>