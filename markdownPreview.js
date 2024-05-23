// Tabs
const tabHeaderButtons = document.querySelectorAll('#tabHeader > .tabButton')
const tabs = document.querySelectorAll('#tabs > .tab')

switchToTab(0)

for (let i = 0; i < tabHeaderButtons.length; i++) {
    console.log(tabHeaderButtons[i])
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
const bloggtext = document.getElementById('bloggtext')
const markdownPreview = document.getElementById('markdownPreview')

function refreshMarkdownPreview() {
    const parsed = marked.parse(bloggtext.value)
    markdownPreview.innerHTML = parsed
}
