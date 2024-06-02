<?php
// Get props
$datetime = Prop('datetime');
$authorId = Prop('authorId');
$profileLink = Prop('profileLink', true);
$text = Prop('text');
$myPost = Prop('myPost', false);

// Format datetime
$prettyDatetime = date("H:i d/m/Y", strtotime($datetime));

// Get author name
$result = queryDB('SELECT userFullName FROM users WHERE userId=:authorId', array('authorId' => $authorId));
if ($result === null || empty($result)) {
    $author = 'Okänd användare';
} else {
    $author = $result[0]['userFullName'];
}
// Get profile picture
$profilePicture = Component('ProfilePicture', name: $author);
?>

<div class="blogPost">
    <span class="topRow row space-between">
        <span class="info start align-center">
            <?php
            if ($profileLink) {
                echo "<a class=\"author\" href=\"/profile.php?id=" . $authorId . "\">$profilePicture$author</a>";
            } else {
                echo "<span class=\"author\">$profilePicture$author</span>";
            }
            ?>
            <time datetime="<?= $datetime ?>"><?= $prettyDatetime ?></time>
        </span>
        <?php
        if ($myPost) {
            echo "<span class=\"blogButtons\">
                <a href=\"/editPost.php?datetime=" . urlencode($datetime) . "\" aria-label=\"Redigera inlägg\"><img src=\"/img/pen.svg\"></a>
                <a href=\"/deletePost.php?datetime=" . urlencode($datetime) . "\" aria-label=\"Radera inlägg\"><img src=\"/img/trash.svg\"></a>
            </span>";
        }
        ?>
    </span>
    <div class="markdown">
        <?= $text ?>
    </div>
</div>