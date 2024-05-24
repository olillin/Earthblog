// Tabs
const tabHeaderButtons = document.querySelectorAll('#tabHeader > .tabButton')
const tabs = document.querySelectorAll('#tabs > .tab')

switchToTab(0)

for (let i = 0; i < tabHeaderButtons.length; i++) {
    tabHeaderButtons[i].addEventListener('click', ev => {
        ev.preventDefault()
        switchToTab(i)
    })
}

/** @param {number} tabIndex The tab to change to */
function switchToTab(tabIndex) {
    tabs.forEach((tab, i) => {
        let hidden = i !== tabIndex
        tab.hidden = hidden
        tab.ariaHidden = hidden
    })

    if (tabIndex === 1) {
        refreshMarkdownPreview()
    }
}

// Preview markdown
const bloggtextarea = document.getElementById('bloggtextarea')
const markdownPreview = document.getElementById('markdownPreview')

function refreshMarkdownPreview() {
    const parsed = marked.parse(bloggtextarea.value)
    markdownPreview.innerHTML = parsed
}

// Markdown notice
const notice = document.getElementById('markdownNotice')
const bloggtext = document.getElementById('bloggtext')
bloggtext.addEventListener('focusin', () => {
    console.log('focus')
    notice.hidden = false
})
bloggtext.addEventListener('focusout', () => {
    setTimeout(() => {
        if (!bloggtext.contains(document.activeElement)) {
            notice.hidden = true
        }
    }, 0)
})
