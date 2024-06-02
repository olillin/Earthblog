<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raderar inlägg</title>
    <link rel="stylesheet" href="/style/common.css">
    <?php require_once '../phpDefaults.php' ?>
</head>

<body>
    <main>

        <?php
        require_once '../checkLogin.php';

        // Validate input
        if (!isset($_POST['datetime']) || empty($_POST['datetime'])) {
            echo Component('Error', message: 'Du har inte valt något blogginlägg.');
        } else {
            // Get input
            $datetime = $_POST['datetime'];
            // Check how many bloggposts match
            $count = queryDB(
                'SELECT COUNT(*) FROM bloggtext WHERE datetime=:datetime',
                array(
                    'datetime' => $datetime,
                )
            );
            if ($count === null) {
                // Failed check
                echo Component('Error', message: 'Något gick fel, försök igen senare.');
            } else if ($count[0]['COUNT(*)'] != 1) {
                echo Component('Error', message: 'Detta inlägg går inte att radera.');
            } else {
                $result = queryDB(
                    'DELETE FROM bloggtext WHERE datetime=:datetime',
                    array(
                        'datetime' => $datetime,
                    )
                );
                if ($result === null) {
                    // Failed deletion
                    echo Component('Error', message: 'Något gick fel, försök igen senare.');
                } else {
                    echo <<<SUCCESS
                    <span class="success">Raderade blogginlägg, omdirigerar till hemskärmen...</span>
    
                    <a href="/blogg.php" class="button primary">Omdirigeras inte automatiskt? Klicka här</a>
                    SUCCESS;
                    header('Location: /blogg.php');
                }
            }
        }
        ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>