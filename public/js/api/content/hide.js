'use strict'

function refreshHideListeners() {
    let items = document.getElementsByClassName('dropdown-hide')
    Array.from(items).forEach(element => { element.addEventListener('click', hide) })
}

function hide(event) {
    let elem = event.currentTarget
    let file = elem.parentNode.getAttribute('data-content')

    fetch('../api/contents/' + file, {
        method: 'PUT',
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
        })
    })
}
