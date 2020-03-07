'use strict'

let overlay = document.getElementsByClassName('overlay')[0]
let sidebar = document.getElementById('sidebar')
let btn = document.getElementById('side-toggle')
let angleLeft = document.getElementById('angle-left')
let angleRight = document.getElementById('angle-right')

function collapse() {
    sidebar.classList.remove('active')
    overlay .classList.remove('active')

    
    angleRight.classList.add('active')
    angleLeft.classList.remove('active')
}

function show() {
    sidebar.classList.add('active')
    overlay .classList.add('active')

    angleRight.classList.remove('active')
    angleLeft.classList.add('active')
}

angleLeft.addEventListener('click', collapse)
overlay.addEventListener('click', collapse)
angleRight.addEventListener('click', show)