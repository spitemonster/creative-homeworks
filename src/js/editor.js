wp.domReady(() => {
    // prevent link blocks from opening in the editor
    const linkBlocks = document.querySelectorAll('.link-block')
    linkBlocks.forEach((l) => {
        l.addEventListener('click', (e) => {
            e.preventDefault()
        })
    })

    // set editor css property for styles that rely on it
    const observer = new MutationObserver(() => {
        const editorArea = document.querySelector('.editor-styles-wrapper')
        let currentWidth = 0

        if (editorArea && editorArea.clientWidth > currentWidth) {
            currentWidth = editorArea.clientWidth
            document.body.style.setProperty(
                '--editor-area-width',
                `${currentWidth}px`
            )
        }
    })

    observer.observe(document.body, { childList: true, subtree: true })
})
