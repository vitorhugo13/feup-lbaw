'use strict'

let blockButton = document.getElementById('confirm-block')
let time = document.getElementById('block-time-input')
let selectedAuthor = -1
let fileID = -1

blockButton.addEventListener('click', requestBlock)

function refreshBlockListeners() {
    let blocks = document.getElementsByClassName('dropdown-block')
    Array.from(blocks).forEach(element => { element.addEventListener('click', block) })
}

function requestBlock(ev) {
    if(ev.currentTarget != blockButton || selectedAuthor === -1 || fileID === -1)
        return

    fetch('../api/users/' + selectedAuthor + '/block', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'time=' + time.value + '&id=' + fileID
    }).then(response => {
        console.log(response)
        response.json().then(data => {
            console.log(data)
            addAlert('success', data['success'])            
        })
    })

    selectedAuthor = -1
    fileID = -1
}

function block(ev) {
    selectedAuthor = ev.currentTarget.getAttribute('data-author')
    fileID = ev.currentTarget.getAttribute('data-file')
    console.log(fileID)
    console.log(selectedAuthor)
}