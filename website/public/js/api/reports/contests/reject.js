'use strict'

function refreshRejectListeners() {
    let items = document.getElementsByClassName('dropdown-reject')
    Array.from(items).forEach(element => { element.addEventListener('click', ignore) })
}