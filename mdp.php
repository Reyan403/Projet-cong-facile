<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mdp</title>
    <link rel="stylesheet" href="mdp.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header>
        <img src="./PNG/logo-mentalworks-blanc.png" alt="">
        <div class="background-gray">
        </div>
    </header>

    <section>
        <h1>Mot de passe oublié</h1>
        <p>Renseignez votre adresse email dans le champ ci-dessous.<br>
        Vous recevrez par la suite un email avec un lien vous permettant de réinitialiser votre mot de passe.</p>
        <form action="traitement.php" method="post">
            <label for="email">Adresse email</label>
            <div class="input-container">
                <i class='bx bx-envelope'></i>
                <input type="email" id="email" name="email" placeholder="****@mentalworks.fr" required>
            </div>
            <br>
            <button class="btn-submit" type="submit">Demander à réinitialiser mot de passe</button>
        </form>

        <p><a class="click" href="">Cliquez ici</a> pour retourner à la page de connexion.</p>

    </section>
</body>
</html>

