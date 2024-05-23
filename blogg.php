<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogg</title>
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
                        <form id="createBlogg" action="/createBlogg.php" method="POST">
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
                        $bloggtext = $row['bloggtext'];

                        // Format datetime
                        $datetime = $row['datetime'];

                        $prettyDatetime = date("h:i d/m/Y", strtotime($datetime));

                        // Get user full name
                        $userId = $row['userId'];
                        $userResult = queryDB('SELECT userFullName FROM users WHERE userId=:userId', array('userId' => $userId));
                        if ($userResult === null || empty($userResult)) {
                            $userFullName = 'Okänd användare';
                        } else {
                            $userFullName = $userResult[0]['userFullName'];
                        }

                        $parsedown = new Parsedown();
                        $bloggbody = $parsedown->text($bloggtext);
                        echo "<li class=\"bloggMessage\">
                            <p>$bloggbody</p>
                            <span class=\"author\">$userFullName</span>
                            <time datetime=\"$datetime\">$prettyDatetime</time>
                            </li>";
                    }
                }
                ?>
            </ul>
        </div>
    </main>
</body>

</html>