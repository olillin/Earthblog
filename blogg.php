<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogg</title>
    <link rel="stylesheet" href="/style.css">
    <?php require_once './config.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>

<body>
    <?php require_once './checkLogin.php' ?>
    <main>
        <header class="w-100 pad-left__s pad-right__s pad-up__s pad-down__s">
            <a href="/logout.php" class="right-0 bg-">Logga ut</a>
        </header>
        <h1>Välkommen till bloggen!</h1>

        <div class="feed">
            <div class="tabs">
                <span id="tabHeader">
                    <a class="tabButton" href="">Skriv</a>
                    <a class="tabButton" href="">Förhandsgranska</a>
                </span>

                <div id="tabs">
                    <div class="tab">
                        <h2>Nytt blogginlägg</h2>
                        <form id="createBlog" action="/post/create.php" method="POST">
                            <textarea name="bloggtext" id="bloggtext" placeholder="Idag har jag..."></textarea>
                            <span id="markdownNotice" hidden>
                                Blogginlägg på denna sida stödjer
                                <a href="https://sv.wikipedia.org/wiki/Markdown">markdown</a>
                            </span>

                            <button type="submit">Publicera</button>
                        </form>
                    </div>
                    <div class="tab">
                        <div id="markdownPreview" class="markdown">

                        </div>
                    </div>
                </div>
            </div>
            <script src="/markdownPreview.js"></script>

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