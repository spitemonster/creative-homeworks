import '@appnest/masonry-layout'

window.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.site-header')
    const announcementBar = document.querySelector('.announcement-bar')
    const annoumcenetBarClose = document.querySelector(
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

    annoumcenetBarClose.addEventListener('click', (e) => {
        e.preventDefault()
        e.stopPropagation()
        sessionStorage.setItem('announcement-bar-closed', true)

        announcementBar.classList.remove('show')
    })
})
