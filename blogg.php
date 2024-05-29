<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogg</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once './phpDefaults.php' ?>
</head>

<body>
    <?php require_once './checkLogin.php' ?>

    <?= Component('Header') ?>
    <main>
        <h1>Välkommen till bloggen!</h1>

        <div class="feed">
            <?= Component('CreateBlogPostForm') ?>

            <ul id="feed">
                <?php
                $result = queryDB("SELECT * FROM bloggtext ORDER BY datetime DESC");

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
    </main>
</body>

</html>