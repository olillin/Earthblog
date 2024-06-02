<?php
require_once './phpDefaults.php';

if (!isset($_GET['id'])) {
    $error = 'Ingen användare har valts.';
} else {
    $result = queryDB('SELECT (userFullName) FROM users WHERE userId=:userId', array('userId' => $_GET['id']));
    if ($result === null || empty($result)) {
        $profileName = 'Okänd användare';
    } else if (count($result) > 1) {
        $error = 'Fick ogiltigt svar från databas, flera användare.';
    } else {
        $profileName = $result[0]['userFullName'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $profileName ?></title>
    <link rel="stylesheet" href="/style/common.css">
    <link rel="stylesheet" href="/style/blogg.css">
</head>

<body>
    <?php require_once './checkLogin.php' ?>

    <?= Component('Header') ?>

    <main>
        <?php
        if (isset($error)) {
            echo Component('Error', message: $error);
        } else { ?>
            <h1><?= Component('ProfilePicture', name: $profileName) . $profileName ?></h1>

            <h2>Senaste inlägg</h2>
            <ul id="feed" class="feed">
                <?php
                $result = queryDB(
                    'SELECT * FROM bloggtext WHERE userId=:id ORDER BY datetime DESC',
                    array(
                        'id' => $_GET['id'],
                    )
                );

                if ($result === null) {
                    echo <<<ERROR
                        <span class="error">Det gick inte att ladda in flödet, försök igen senare.</span>
                        ERROR;
                } else {
                    foreach ($result as $row) {
                        echo '<li>' . Component(
                            'SqlBlogPost',
                            row: $row,
                            profileLink: false,
                        ) . '</li>';
                    }
                }
                ?>
            </ul>
        <?php } ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>