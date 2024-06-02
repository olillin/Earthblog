<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uppdaterar inlägg</title>
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
        } else if (!isset($_POST['bloggtext']) || empty($_POST['bloggtext'])) {
            echo Component('Error', message: 'Du kan inte skapa ett tomt blogginlägg.');
        } else {
            // Get input
            $datetime = $_POST['datetime'];
            $bloggtext = $_POST['bloggtext'];
            // Check how many bloggposts match
            $count = queryDB(
                'SELECT COUNT(*) FROM bloggtext WHERE datetime=:datetime',
                array(
                    'datetime' => $datetime,
                )
            );
            if ($count === null) {
                // Failed check
                echo Component('Error', message: 'Försök igen senare.');
            } else {
                if ($count[0]['COUNT(*)'] == 0) {
                    echo Component('Error', message: 'Kunde inte hitta inlägget.');
                } else if ($count[0]['COUNT(*)'] > 1) {
                    echo Component('Error', message: 'Detta inlägg går inte att uppdatera.');
                } else {
                    $result = queryDB(
                        'UPDATE bloggtext SET bloggtext=:bloggtext WHERE datetime=:datetime',
                        array(
                            'bloggtext' => urlencode($bloggtext),
                            'datetime' => $datetime,
                        )
                    );
                    if ($result === null) {
                        // Failed update
                        echo Component('Error', message: 'Försök igen senare.');
                    } else {
                        echo <<<SUCCESS
                        <h1>Uppdaterade blogginlägg</h1>
                        <span class="success">Omdirigerar till hemskärmen...</span>
    
                        <a href="/blogg.php" class="button primary">Omdirigeras inte automatiskt? Klicka här</a>
                        SUCCESS;
                        header('Location: /blogg.php');
                    }
                }
            }
        }
        ?>
    </main>

    <?= Component('Footer') ?>
</body>

</html>