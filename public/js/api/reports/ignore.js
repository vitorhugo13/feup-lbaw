'use strict'

function refreshIgnoreListeners() {
    let items = document.getElementsByClassName('dropdown-ignore')
    Array.from(items).forEach(element => { element.addEventListener('click', ignore) })
}

function ignore(event) {
    let elem = event.currentTarget
    let file = elem.parentNode.getAttribute('data-id')

    fetch('../api/reports/' + file, {
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
