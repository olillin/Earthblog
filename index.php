<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in — Blogg</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once './phpDefaults.php' ?>
</head>

<body>
    <h1>Logga in</h1>
    <form action="/post/login.php" method="POST">
        <?= Component('LoginInput', id: "username", type: "text", label: "Användarnamn") ?>
        <?= Component('LoginInput', id: "password", type: "password", label: "Lösenord") ?>

        <button class="primary" type="submit">Logga in</button>
    </form>
</body>

</html>