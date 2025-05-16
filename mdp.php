

<?php
include 'includes/header.php';
?>

<div class="menu" id="menu">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
        <a href="./index.php">Connexion</a>
    </div>

<section class="bloc">
        <div class="sidebar">
            <div class="content-menu">
                <div class="other-menu">
                    <a href="./index.php">Connexion</a>
                </div>
            </div>
        </div>
        <div class="content-bloc">
            <h1>Mot de passe oublié</h1>
            <p>Renseignez votre adresse email dans le champ ci-dessous.
            Vous recevrez par la suite un email avec un lien vous permettant de réinitialiser votre mot de passe.</p>
            <form action="forgot_password.php" method="post">
                <label for="email">Adresse email</label>
                <input type="text" name="email" id="email" placeholder="****@mentalworks.fr" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
                <button class="btn-submit-mdp" type="submit">Demander à réinitialiser mot de passe</button>
            </form>

        <p><a class="mdp-forgot" href="./index.php"><strong>Cliquez ici</strong></a> pour retourner à la page de connexion.</p>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>

