'use strict';

let timeoutID = setTimeout(removeAlerts, 6000)
function removeAlerts() {
    document.getElementById('alert-section').textContent = ''
}

function addAlert(type, msg) {
    let alertSection = document.getElementById('alert-section')
    let div = document.createElement('div')
    let btn = document.createElement('button')
    let span = document.createElement('span')

    span.setAttribute('aria-hidden', 'true')
    span.innerHTML = '&times;'

    btn.setAttribute('data-dismiss', 'alert')
    btn.setAttribute('aria-label', 'Close')
    btn.classList.add('close')

    div.classList.add('alert', 'alert-'+type, 'alert-dismissible', 'fade', 'show')
    div.setAttribute('role', 'alert')
    div.textContent = msg

    btn.append(span)
    div.append(btn)
    alertSection.append(div)

    timeoutID = setTimeout(removeAlerts, 6000)
    refreshAlertButtons()
}

function refreshAlertButtons() {
    let btns = document.querySelectorAll('#alert-section button.close')
    btns.forEach(btn => btn.addEventListener('click', () => clearTimeout(timeoutID)))
}