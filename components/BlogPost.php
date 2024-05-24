<?php
// Format datetime
date_default_timezone_set('Europe/Stockholm');
$prettyDatetime = date("H:i d/m/Y", strtotime(Prop('datetime')));
?>
<div class="bloggPost">
    <div class="markdown">
        <?= Prop('text') ?>
    </div>
    <span class="author"><?= Prop('author') ?></span>
    <time datetime="<?= Prop('datetime') ?>"><?= $prettyDatetime ?></time>";
    <?php
    if (Prop('myPost', false)) {
        echo "<div class=\"bloggButtons\">
            <a href=\"/editPost.php?datetime=" . urlencode(Prop('datetime')) . "\" aria-label=\"Redigera inlägg\"><img src=\"/img/pen.svg\"></a>
            <a href=\"/deletePost.php?datetime=" . urlencode(Prop('datetime')) . "\" aria-label=\"Radera inlägg\"><img src=\"/img/trash.svg\"></a>
        </div>";
    }
    ?>
</div>