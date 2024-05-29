<div class="tabs">
    <span id="tablist" role="tablist">
        <button role="tab" type="button" onclick="switchToTab(0)">Skriv</button>
        <button role="tab" type="button" onclick="switchToTab(1)">Förhandsgranska</button>
    </span>
    <div id="tabpanels">
        <div role="tabpanel">
            <textarea name="bloggtext"
                      id="bloggtextarea"
                      placeholder="<?= Prop('placeholder', 'Idag har jag...') ?>"><?= Prop('value') ?></textarea>
            <span id="markdownNotice">
                Blogginlägg på denna sida stödjer
                <a href="https://sv.wikipedia.org/wiki/Markdown" tabindex="0">markdown</a>
            </span>
        </div>
        <div role="tabpanel">
            <div id="markdownPreview" class="markdown">

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="/markdownPreview.js"></script>