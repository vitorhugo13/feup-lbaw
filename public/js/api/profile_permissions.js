'use strict'

let promoteButton = document.getElementById('confirm-promote')
let demoteButton = document.getElementById('confirm-demote')
let id = document.getElementsByClassName('user-info')[0].getAttribute('data-user-id')

promoteButton.addEventListener('click', promote)
demoteButton.addEventListener('click', demote)

function sendRequest(role) {
    fetch('../api/users/' + id + '/role', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'role=' + role
    }).then(response => {
        console.log(response)
        response.json().then(data => {
            console.log(data)
            addAlert('success', data['success'])
        })
    })
}

function promote() {
    sendRequest('Moderator')
}

function demote() {
    sendRequest('Member')
}