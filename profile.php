<?php
require_once './config.php';

if (!isset($_GET['id'])) {
    $error = 'Ingen användare har valts.';
} else {
    $result = queryDB('SELECT (userFullName) FROM users WHERE userId=:userId', array('userId' => $_GET['id']));
    if ($result === null) {
        $error = 'Något gick fel, försök igen senare.';
    } else if (empty($result)) {
        $error = 'Det gick inte att hitta användaren.';
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
    <link rel="stylesheet" href="/style.css">
    <title><?php
    if (isset($profileName)) {
        echo $profileName;
    } else {
        echo 'Profilen finns inte';
    }
    ?></title>
</head>

<body>
    <?php
    require_once './checkLogin.php';

    if (isset($error)) {
        echo <<<ERROR
        <span class="error">$error</span>

        <a href="/blogg.php">Tillbaka till hemskärmen</a>
        ERROR;
        die();
    }

    ?>
    <h1><?= $profileName ?></h1>

    <h3>Senaste inlägg</h3>

    <div class="feed">
        <?php
        if ($_SESSION['user'] == $_GET['id']) {
            echo Component('CreateBlogPostForm');
        }
        ?>

        <ul id="feed">
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
                        row: $row
                    ) . '</li>';
                }
            }
            ?>
        </ul>
    </div>
</body>

</html>