'use strict'

let blockButton = document.getElementById('confirm-block')
let time = document.getElementById('block-time-input')

blockButton.addEventListener('click', requestBlock)

function requestBlock(ev) {
    if(ev.currentTarget != blockButton)
        return

    let id = document.getElementsByClassName('user-info')[0].getAttribute('data-user-id')
    fetch('../api/users/' + id + '/block', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'time=' + time.value
    }).then(response => {
        console.log(response)
        response.json().then(data => {
            console.log(data)
            addAlert('success', data['success'])
            //TODO: somehow update the page
        })
    })
}