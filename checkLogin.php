<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /notLoggedIn.php');

    echo <<<ERROR
    <main>
        <h1>Något gick fel</h1>
        <span class="error">Du måste vara inloggad för att använda denna sida.</span>
        <a href="/" class="button primary">Logga in</a>
    </main>
    ERROR;
    die();
} else {
    $result = queryDB(
        'SELECT * FROM users WHERE userId=:id',
        array(
            'id' => $_SESSION['user'],
        )
    );

    if ($result === null) {
        echo <<<ERROR
        <main>
            <h1>Något gick fel</h1>
            <span class="error">Det gick inte att validera ditt konto, försök att ladda om sidan.</span>
            <a href="." class="button primary">Ladda om sida</a>
            <a href="/post/logout.php" class="button">Logga ut</a>
        </main>
        ERROR;
        die();
    } else if (empty($result)) {
        echo <<<ERROR
        <main>
            <h1>Något gick fel</h1>
            <span class="error">Ditt konto har raderats och går inte längre att använda.</span>
            <a href="/post/logout.php" class="button primary">Logga ut</a>
        </main>
        ERROR;
        die();
    }
}