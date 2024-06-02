<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /notLoggedIn.php');

    echo <<<ERROR
    <h1>Något gick fel</h1>
    <span class="error">Du måste vara inloggad för att använda denna sida</span>

    <a href="/" class="button primary">Logga in</a>
    ERROR;
    die();
}