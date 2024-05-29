<?php require_once __DIR__ . '/../phpDefaults.php' ?>

<header>
    <span class="title">Earthblog ⛰️</span>
    <a href="/blogg.php">Hem</a>
    <?php
    $userId = $_SESSION['user'];

    if (isset($userId)) {
        echo "<a href=\"/profile?id=$userId\">Min profil</a>";

        $result = queryDB(
            'SELECT (userFullName) FROM users WHERE userId=:userId',
            array(
                'userId' => $userId
            )
        );

        if ($result !== null) {
            $userFullName = $result[0]['userFullName'];
            echo "<span>Inloggad som <span class=\"loggedInUser\">$userFullName</span></span>";
        }
    }
    ?>
    <a href="/logout.php">Logga ut</a>
</header>