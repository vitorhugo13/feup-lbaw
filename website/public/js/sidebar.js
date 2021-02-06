'use strict'

let overlay = document.getElementsByClassName('overlay')[0]
let sidebar = document.getElementById('sidebar')
let btn = document.getElementById('side-toggle')
let angleLeft = document.getElementById('angle-left')
let angleRight = document.getElementById('angle-right')
let footer = document.getElementById('footer')

let sidebarTopOffset = sidebar.offsetTop
let topAcc = 0
let lastScroll = 0

function toggleSidebar() {
    if (sidebar.classList.contains('active')) {
        collapse()
    } else {
        show()
    }

    sidebar.classList.toggle('active')
    overlay.classList.toggle('active')
}

function collapse() {
    angleRight.classList.add('active')
    angleLeft.classList.remove('active')
    btn.style['background-color'] = 'var(--main-color)'
}

function show() {
    angleRight.classList.remove('active')
    angleLeft.classList.add('active')
    btn.style['background-color'] = 'var(--main-color)'
}

function relocateSidebar() {
    let windowTop = window.pageYOffset
    let footerTop = footer.offsetTop
    let sidebarTop = sidebar.offsetTop
    let sidebarHeight = sidebar.offsetHeight

    let margin = 10

    if ((windowTop + sidebarTop + sidebarHeight) > (footerTop - margin)) {
        let offset = footerTop - margin - windowTop - sidebarHeight

        sidebar.style.top = offset + 'px'
        topAcc = offset
    } else if (footerTop - windowTop > sidebarHeight + sidebarTopOffset) {
        sidebar.style.top = 'auto'
    } else if (footerTop - windowTop > sidebarHeight) {
        topAcc -= windowTop - lastScroll
        sidebar.style.top = topAcc + 'px'
    }

    lastScroll = windowTop
}

overlay.addEventListener('click', toggleSidebar)
btn.addEventListener('click', toggleSidebar)
window.addEventListener('scroll', relocateSidebar)