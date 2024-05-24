<div class="tabs">
    <span id="tabHeader">
        <button class="tabButton">Skriv</button>
        <button class="tabButton">Förhandsgranska</button>
    </span>
    <div id="tabs">
        <div id="bloggtext" class="tab">
            <textarea name="bloggtext"
                      id="bloggtextarea"
                      placeholder="<?= Prop('placeholder', 'Idag har jag...') ?>"><?= Prop('value') ?></textarea>
            <span id="markdownNotice">
                Blogginlägg på denna sida stödjer
                <a href="https://sv.wikipedia.org/wiki/Markdown" tabindex="0">markdown</a>
            </span>
        </div>
        <div class="tab">
            <div id="markdownPreview" class="markdown">

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="/markdownPreview.js"></script>