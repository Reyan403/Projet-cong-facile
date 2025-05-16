<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
?>



<?php
include 'includes/header.php';
include 'includes/menu-collaborateur.php';
?>

    <div class="content-bloc">
        <h1>
            Mes préférences
        </h1>
        <div class="btn-switch">
            <button id="switchBtn"></button>
            <p>
                Être alerté par email lorsqu'une demande de congé est acceptée ou refusée
            </p>
        </div>
        <div class="btn-switch">
            <button id="switchBtn2"></button>
            <p>
                Recevoir un rappel par email lorsqu'un congé arrive la semaine prochaine
            </p>
        </div>
        <button class="button-save">Enregistrer mes préférences</button>
    </div>

    <script src="script.js"></script>
</body>
</html>