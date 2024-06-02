<form id="createBlog" class="createBlog" action="/post/update.php" method="POST">
    <div class="tabs">
        <span id="tablist" role="tablist" class="row start">
            <button role="tab" type="button" onclick="switchToTab(0)" class="selected">Skriv</button>
            <button role="tab" type="button" onclick="switchToTab(1)">Förhandsgranska</button>
        </span>
        <div id="tabpanels" class="tabpanels">
            <div role="tabpanel">
                <textarea name="bloggtext"
                          id="bloggtextarea"
                          rows="5"
                          placeholder="<?= Prop('placeholder', 'Idag har jag...') ?>"><?= Prop('text') ?></textarea>
                <span id="markdownNotice">
                    Blogginlägg på denna sida stödjer
                    <a href="https://www.markdownguide.org/cheat-sheet/" tabindex="0">markdown</a>
                </span>
            </div>
            <div role="tabpanel">
                <div class="blogPost">
                    <?php
                    // Format datetime
                    $datetime = Prop('datetime');
                    $prettyDatetime = date("H:i d/m/Y", strtotime($datetime));

                    // Get author name
                    $result = queryDB('SELECT userFullName FROM users WHERE userId=:authorId', array('authorId' => Prop('authorId')));
                    if ($result === null || empty($result)) {
                        $author = 'Okänd användare';
                    } else {
                        $author = $result[0]['userFullName'];
                    }
                    $profilePicture = Component('ProfilePicture', name: $author);

                    echo "<span class=\"author\">$profilePicture$author</span>";
                    ?>
                    <time datetime="<?= $datetime ?>"><?= $prettyDatetime ?></time>
                    <div class="markdown">
                        <div id="markdownPreview" class="markdown">

                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="datetime" value="<?= $datetime ?>">
            <span class="buttonRow">
                <button type="submit" class="button primary">Spara</button>
                <a href="/blogg.php" class="button">Avbryt</a>
            </span>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="/markdownPreview.js"></script>
</form>