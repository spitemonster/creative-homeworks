function setupAnnouncementBar(announcementBar) {
    const announcementBarClose = announcementBar.querySelector(
        '.announcement-bar__close'
    )

    if (!announcementBarClose) {
        announcementBar.classList.add('show')
        return
    }

    // if we don't have this item in session storage or it's not true, show the announcement bar
    if (sessionStorage.getItem('announcement-bar-closed') != 'true') {
        announcementBar.classList.add('show')
    }

    announcementBarClose.addEventListener('click', (e) => {
        e.preventDefault()
        e.stopPropagation()
        sessionStorage.setItem('announcement-bar-closed', true)

        announcementBar.classList.remove('show')
    })
}

function setupMenu(header) {
    const menuItemsWithChildren = document.querySelectorAll(
        '.wp-block-navigation-item.has-child'
    )

    menuItemsWithChildren.forEach((c) => {
        const b = c.querySelector('button')
        const child = c.querySelector('.wp-block-navigation-submenu')
        const height = child.offsetHeight

        console.log(c)

        c.addEventListener('mouseover', (e) => {
            header.style.setProperty('--submenu-height', `${height}px`)
            console.log('mouseover')
        })

        c.addEventListener('mouseenter', (e) => {
            console.log('entered')
            b.setAttribute('aria-expanded', true)
        })

        c.addEventListener('mouseleave', (e) => {
            b.setAttribute('aria-expanded', false)
        })
    })
}

function setupHeader(headerContainer) {
    const navToggle = document.createElement('button')
    navToggle.id = 'nav-toggle'
    navToggle.innerHTML = `
		<span class="visually-hidden">Toggle Navigation</span>
		<span class="open"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12 10.93 5.719-5.72c.146-.146.339-.219.531-.219.404 0 .75.324.75.749 0 .193-.073.385-.219.532l-5.72 5.719 5.719 5.719c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.385-.073-.531-.219l-5.719-5.719-5.719 5.719c-.146.146-.339.219-.531.219-.401 0-.75-.323-.75-.75 0-.192.073-.384.22-.531l5.719-5.719-5.72-5.719c-.146-.147-.219-.339-.219-.532 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"/></svg></span>
		<span class="closed"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22 16.75c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75z" fill-rule="nonzero"/></svg></span>
	`
    const navigation = document.querySelector('.navigation-container')

    navToggle.addEventListener('click', () => {
        navigation.classList.toggle('is-menu-open')
    })

    headerContainer.append(navToggle)
}

function setupGravityForm(form) {
    form.style.display = ''
}

window.addEventListener('DOMContentLoaded', () => {
    const isEditor = typeof wp !== undefined && typeof wp.blocks !== undefined

    console.log('is editor?? ', isEditor)
    console.log(typeof wp)

    const announcementBar = document.querySelector('.announcement-bar')

    if (announcementBar) {
        setupAnnouncementBar(announcementBar)
    }

    if (isEditor) {
        const linkBlocks = document.querySelectorAll('.link-block')
        linkBlocks.forEach((l) => {
            l.addEventListener('click', (e) => {
                e.preventDefault()
            })
        })
    }

    // create responsive menu button and setup menu
    const header = document.querySelector('.site-header')
    if (header) {
        setupMenu(header)
    }

    const headerContainer = document.querySelector(
        '.site-header .wp-block-group:not(.is-style-breakout)'
    )

    if (headerContainer) {
        setupHeader(headerContainer)
    }

    // setup email fields to validate on change rather than waiting for submit
    document
        .querySelectorAll('.gform_fields input[type="email"]')
        .forEach((f) => {
            f.addEventListener('blur', (e) => {
                const valid = e.target.validity.valid

                if (valid) {
                    e.target.setAttribute('aria-invalid', false)
                }
            })
        })
})

// set editor css property for styles that rely on it
wp.domReady(() => {
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
