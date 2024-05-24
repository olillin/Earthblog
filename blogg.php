<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogg</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once './config.php' ?>
</head>

<body>
    <?php require_once './checkLogin.php' ?>
    <header class="w-100 pad-left__s pad-right__s pad-up__s pad-down__s">
        <a href="/logout.php" class="right-0 bg-">Logga ut</a>
    </header>
    <main>
        <h1>Välkommen till bloggen!</h1>

        <div class="feed">
            <form id="createBlog" action="/post/create.php" method="POST">
                <h2>Nytt blogginlägg</h2>
                <?= Component('Blogtext') ?>
                <button type="submit">Publicera</button>
            </form>

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