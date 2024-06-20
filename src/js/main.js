import '@appnest/masonry-layout'

window.addEventListener('DOMContentLoaded', () => {
    const isEditor =
        typeof wp !== 'undefined' && typeof wp.blocks !== 'undefined'

    const header = document.querySelector('.site-header')
    const announcementBar = document.querySelector('.announcement-bar')
    const announcementBarClose = document.querySelector(
        '.announcement-bar__close'
    )

    const menuItemsWithChildren = document.querySelectorAll(
        '.wp-block-navigation-item.has-child'
    )

    if (sessionStorage.getItem('announcement-bar-closed') != true) {
        announcementBar.classList.add('show')
    }

    menuItemsWithChildren.forEach((c) => {
        c.addEventListener('mouseover', () => {
            const child = c.querySelector('.wp-block-navigation-submenu')
            const height = child.offsetHeight

            header.style.setProperty('--submenu-height', `${height}px`)
        })
    })

    announcementBarClose.addEventListener('click', (e) => {
        e.preventDefault()
        e.stopPropagation()
        sessionStorage.setItem('announcement-bar-closed', true)

        announcementBar.classList.remove('show')
    })

    const tags = document.querySelectorAll('.wp-block-post-terms a')

    let prev = 6
    const tagColorOptions = [
        'tag-blue',
        'tag-green',
        'tag-purple',
        'tag-orange',
    ]

    tags.forEach((t) => {
        let randi = Math.floor(Math.random() * tagColorOptions.length)
        // ensure no two colors end up in a row
        while (randi == prev) {
            randi = Math.floor(Math.random() * tagColorOptions.length)
        }

        prev = randi

        const rand = tagColorOptions[randi]

        t.classList.add(rand)
    })

    if (isEditor) {
        const linkBlocks = document.querySelectorAll('.link-block')
        linkBlocks.forEach((l) => {
            l.addEventListener('click', (e) => {
                e.preventDefault()
            })
        })
    }
})
