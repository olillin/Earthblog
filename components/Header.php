<?php require_once __DIR__ . '/../phpDefaults.php' ?>

<header class="row align-center">
    <a href="/blogg.php">
        <span class="logo">Earthblog ⛰️</span>
    </a>
    <nav class="row space-around align-center">
        <a href="/blogg.php">Hem</a>
        <?php
        $userId = $_SESSION['user'];

        if (isset($userId)) {
            $result = queryDB(
                'SELECT (userFullName) FROM users WHERE userId=:userId',
                array(
                    'userId' => $userId
                )
            );

            if ($result !== null) {
                $userFullName = $result[0]['userFullName'];
                $profilePicture = Component('ProfilePicture', name: $userFullName);
                echo "<span>Inloggad som<br>$profilePicture<span class=\"loggedInUser\">$userFullName</span></span>";
            }

            echo "<a href=\"/profile?id=$userId\">Min profil</a>";
        }
        ?>
        <a href="/post/logout.php">Logga ut</a>
    </nav>
</header>