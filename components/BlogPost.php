<?php
// Format datetime
date_default_timezone_set('Europe/Stockholm');
$prettyDatetime = date("H:i d/m/Y", strtotime(Prop('datetime')));

// Get author name
$result = queryDB('SELECT userFullName FROM users WHERE userId=:authorId', array('authorId' => Prop('authorId')));
if ($result === null || empty($result)) {
    $author = 'Okänd användare';
} else {
    $author = $result[0]['userFullName'];
}
?>

<div class="blogPost">
    <?php
    if (Prop('profileLink', true)) {
        echo "<a class=\"author\" href=\"/profile.php?id=" . Prop('authorId') . "\">$author</a>";
    } else {
        echo "<span class=\"author\">$author</span>";
    }
    ?>
    <time datetime="<?= Prop('datetime') ?>"><?= $prettyDatetime ?></time>
    <div class="markdown">
        <?= Prop('text') ?>
    </div>
    <?php
    if (Prop('myPost', false)) {
        echo "<div class=\"blogButtons\">
            <a href=\"/editPost.php?datetime=" . urlencode(Prop('datetime')) . "\" aria-label=\"Redigera inlägg\"><img src=\"/img/pen.svg\"></a>
            <a href=\"/deletePost.php?datetime=" . urlencode(Prop('datetime')) . "\" aria-label=\"Radera inlägg\"><img src=\"/img/trash.svg\"></a>
        </div>";
    }
    ?>
</div>