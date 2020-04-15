'use strict'

let query = window.matchMedia('(max-width: 575px)')
let expandable = document.querySelector('.expandable-search input')
let collapsed = document.getElementById('collapsed-search')
let collapsedInput = collapsed.getElementsByTagName('input')[0]

function toggle() {
    if(!collapsed.classList.contains('active')) {
        addTransition();
        collapsedInput.focus()
        expandable.style['opacity'] = '0'
    } else {
        collapsedInput.blur()
        expandable.style['opacity'] = '1'
    }

    collapsed.classList.toggle('active')
}

function addToggleListener(query) {
    if (query.matches) { // If screen is < 576px wide
        expandable.addEventListener('click', toggle)
        collapsedInput.addEventListener('blur', toggle)
    } else {
        expandable.removeEventListener('click', toggle)
        collapsedInput.removeEventListener('blur', toggle)
    }
}

function addTransition() {
    let value = 'all .5s'
    
    collapsed.style['-webkit-transition'] = value;
    collapsed.style['-moz-transition'] = value;
    collapsed.style['transition'] = value;
}

addToggleListener(query) // Call listener function at run time
query.addListener(addToggleListener) // Attach listener function on state changes