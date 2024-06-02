<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera — Earthblog</title>
    <link rel="stylesheet" href="/style/common.css">
    <?php require_once './phpDefaults.php' ?>
</head>

<body>
    <main>
        <p>Välkommen till</p>
        <span class="logo big">Earthblog ⛰️</span>
        <h1>Skapa konto</h1>
        <form action="/post/register.php" method="POST">
            <?= Component('LabeledInput', id: "fullName", type: "text", label: "Ditt namn") ?>
            <?= Component('LabeledInput', id: "username", type: "text", label: "Användarnamn") ?>
            <?= Component('LabeledInput', id: "password", type: "password", label: "Lösenord") ?>

            <span class="row center">
                <button class="button primary" type="submit">Registrera</button>
            </span>
        </form>
        <span class="notice">Har du redan ett konto? <a href="/">Klicka här</a></span>
    </main>

    <?= Component('Footer') ?>
</body>

</html>