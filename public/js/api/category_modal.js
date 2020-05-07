'use strict'

let editButtons = document.querySelectorAll('a[data-targe="#edit-category"]')
let editConfirmButton = document.querySelector('#edit-category .modal-footer > button[type="submit"]')
let editInput = document.getElementById('new-category-name')
let lastClickedID = -1

function editClicked(ev) {
    let lastClickedID = ev.currentTarget.getAttribute('data-category-id')
}

function confirmEdit(ev) {
    let newName = editInput.value

    fetch( '../api/categories/' + lastClickedID, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: {'name': newName}
    }).then(response => {
        if(response['status'] != 200) {
            console.log(response)
            return
        }

        response.json()
    })
}

editButtons.forEach(btn => btn.addEventListener('click', editClicked))
editConfirmButton.addEventListener('click', confirmEdit)