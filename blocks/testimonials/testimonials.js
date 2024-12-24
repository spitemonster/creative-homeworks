// window.addEventListener('DOMContentLoaded', () => {
//     const testimonialCards = document.querySelectorAll('.testimonial-card')

//     if (testimonialCards.length == 0) {
//         return
//     }

//     const container = document.createElement('div')
//     container.classList.add('lightbox-container')

//     container.addEventListener('click', () => {})

//     testimonialCards.forEach((card) => {
//         const lightbox = card.cloneNode(true)
//         lightbox.classList.add('lightbox')
//         lightbox.removeChild(lightbox.querySelector('button'))
//         lightbox.style.removeProperty('--line-clamp')
//         container.appendChild(lightbox)

//         card.addEventListener('click', (e) => {
//             const target = e.target

//             if (target.className.includes('lightbox-trigger')) {
//                 lightbox.style.display = 'block'
//                 document.body.classList.add('lightbox-shown')
//             }
//         })
//     })

//     document.body.appendChild(container)
// })
