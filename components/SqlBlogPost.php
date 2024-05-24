<?php
$datetime = Prop('row')['datetime'];

// Get user full name
$userId = Prop('row')['userId'];
$userResult = queryDB('SELECT userFullName FROM users WHERE userId=:userId', array('userId' => $userId));
if ($userResult === null || empty($userResult)) {
    $userFullName = 'Okänd användare';
} else {
    $userFullName = $userResult[0]['userFullName'];
}

$parsedown = new Parsedown();
$bloggtext = urldecode(Prop('row')['bloggtext']);
$sanitizedBloggtext = htmlspecialchars($bloggtext);
$bloggbody = $parsedown->text($sanitizedBloggtext);

echo Component(
    'BlogPost',
    text: $bloggbody,
    author: $userFullName,
    datetime: $datetime,
    myPost: Prop('myPost', $userId === $_SESSION['user']),
);