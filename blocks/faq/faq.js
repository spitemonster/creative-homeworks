window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.faq:not(.initialized)').forEach((faq) => {
        faq.classList.add('initialized')
        const items = faq.querySelectorAll('details')
        items.forEach((item) => {
            item.addEventListener('toggle', (e) => {
                if (item.hasAttribute('open')) {
                    items.forEach((i) => {
                        if (i !== item) {
                            i.removeAttribute('open')
                        }
                    })
                }
            })
        })
    })
})
