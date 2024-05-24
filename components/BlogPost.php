<?php
// Format datetime
date_default_timezone_set('Europe/Stockholm');
$prettyDatetime = date("H:i d/m/Y", strtotime(Prop('datetime')));
?>
<div class="blogPost">
    <span class="author"><?= Prop('author') ?></span>
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