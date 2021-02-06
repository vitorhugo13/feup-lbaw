'use strict'

let promoteButton = document.getElementById('confirm-promote')
let demoteButton = document.getElementById('confirm-demote')

promoteButton.addEventListener('click', promote)
demoteButton.addEventListener('click', demote)

function sendRequest(role) {
    let id = document.getElementsByClassName('user-info')[0].getAttribute('data-user-id')
    fetch('../api/users/' + id + '/role', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'role=' + encodeURIComponent(role)
    }).then(response => {
        console.log(response)
        response.json().then(data => {
            console.log(data)
            addAlert('success', data['success'])
            swapOption(role)
        })
    })
}

function promote() {
    sendRequest('Moderator')
}

function demote() {
    sendRequest('Member')
}

function swapOption(role) {
    if(role == 'Member'){
        let dropdownOption = document.querySelector('.dropdown-item[data-target="#demote-modal"]')
        dropdownOption.textContent = 'Promote'
        dropdownOption.setAttribute('data-target', '#promote-modal')
    } else {
        let dropdownOption = document.querySelector('.dropdown-item[data-target="#promote-modal"]')
        dropdownOption.textContent = 'Demote'
        dropdownOption.setAttribute('data-target', '#demote-modal')
    }
}