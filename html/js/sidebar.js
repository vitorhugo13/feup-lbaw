'use strict'

let overlay = document.getElementsByClassName('overlay')[0]
let sidebar = document.getElementById('sidebar')
let btn = document.getElementById('side-toggle')
let angleLeft = document.getElementById('angle-left')
let angleRight = document.getElementById('angle-right')

function toggleSidebar() {
    if(sidebar.classList.contains('active')){
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
    btn.style['background-color'] = 'var(--background)'
}

function show() {
    angleRight.classList.remove('active')
    angleLeft.classList.add('active')
    btn.style['background-color'] = 'var(--background-strong)'
}

overlay.addEventListener('click', toggleSidebar)
btn.addEventListener('click', toggleSidebar)