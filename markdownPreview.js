// Tabs
const tabpanels = document.querySelectorAll('#tabpanels > [role=tabpanel]')
const tabbuttons = document.querySelectorAll('#tablist > [role=tab]')

/** @param {number} tabIndex The tab to change to */
function switchToTab(tabIndex) {
    tabpanels.forEach((tab, i) => {
        let hidden = i !== tabIndex
        tab.hidden = hidden
        tab.ariaHidden = hidden
    })
    tabbuttons.forEach((button, i) => {
        if (i === tabIndex) {
            button.classList.add('selected')
        } else {
            button.classList.remove('selected')
        }
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
