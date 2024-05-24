<?php
$datetime = Prop('row')['datetime'];

// Get user full name
$authorId = Prop('row')['userId'];

$parsedown = new Parsedown();
$bloggtext = urldecode(Prop('row')['bloggtext']);
$sanitizedBloggtext = htmlspecialchars($bloggtext);
$bloggbody = $parsedown->text($sanitizedBloggtext);

echo Component(
    'BlogPost',
    text: $bloggbody,
    authorId: $authorId,
    datetime: $datetime,
    myPost: Prop('myPost', $authorId === $_SESSION['user']),
    profileLink: Prop('profileLink', true),
);