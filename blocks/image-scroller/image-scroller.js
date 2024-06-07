window.addEventListener('DOMContentLoaded', () => {
    document
        .querySelectorAll('.image-scroller:not(.initialized)')
        .forEach((s) => {
            const list = s.querySelector('ul')
            const items = Array.from(list.children)

            items.forEach((i) => {
                const dup = i.cloneNode(true)
                dup.setAttribute('aria-hidden', true)
                list.append(dup)
            })

            s.classList.add('initialized')
        })
})
