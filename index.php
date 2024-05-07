<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in — Blogg</title>
    <?php require_once './config.php' ?>
</head>

<body class="flex flex-col items-center justify-center w-screen h-screen">
    <h1 class="m-bottom__m">Logga in</h1>
    <form action="/login.php" method="POST">
        <?= Component('LoginInput', id: "username", label: "Användarnamn") ?>
        <?= Component('LoginInput', id: "password", type: "password", label: "Lösenord") ?>

        <button class="primary" type="submit">Logga in</button>
    </form>
</body>

</html>