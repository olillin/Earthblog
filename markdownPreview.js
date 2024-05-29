// Tabs
const tabpanels = document.querySelectorAll('#tabpanels > [role=tabpanel]')

/** @param {number} tabIndex The tab to change to */
function switchToTab(tabIndex) {
    tabpanels.forEach((tab, i) => {
        let hidden = i !== tabIndex
        tab.hidden = hidden
        tab.ariaHidden = hidden
    })

    if (tabIndex === 1) {
        refreshMarkdownPreview()
    }
}
switchToTab(0)

// Preview markdown
const bloggtextarea = document.getElementById('bloggtextarea')
const markdownPreview = document.getElementById('markdownPreview')

function refreshMarkdownPreview() {
    const parsed = marked.parse(bloggtextarea.value)
    markdownPreview.innerHTML = parsed
}
