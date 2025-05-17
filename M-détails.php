<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/M-check-connected.php';
?>


<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
        <div class="content-bloc">
            <h1>
                Développeur Web
            </h1>
            <form action="traitement.php" method="post">
            <label for="text">Nom du poste</label>
                <div class="input-container">
                    <input type="text" id="text" name="text" placeholder="$mettrevariable">
                </div>
            <br>
            </form>
            <div class="btn-flex">
                <button class="btn-supp" a href="">Supprimer</button>
                <button class="btn-mettre-a-jour" a href="">Mettre à jour</button>
            </div>

        </div>
    </section>
    <script src="script.js"></script>
</body>