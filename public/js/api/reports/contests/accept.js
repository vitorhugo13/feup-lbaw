'use strict'

function refreshAcceptListeners() {
    let items = document.getElementsByClassName('dropdown-accept')
    Array.from(items).forEach(element => { element.addEventListener('click', accept) })
}

function accept(event) {
    let elem = event.currentTarget
    let file = elem.parentNode.getAttribute('data-id')

    fetch('../api/reports/contests/' + file, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response)
            return
        }
        response.json().then(data => {
            console.log(data['success'])
            elem.closest('tr').remove()
        })
    })
}
