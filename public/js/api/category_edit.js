'use strict'

let editButtons = document.querySelectorAll('a[data-target="#edit-category"]')
let editConfirmButton = document.querySelector('#edit-category .modal-footer > .btn-primary')
let editInput = document.getElementById('edit-category-name')
let lastClickedID = -1

function editClicked(ev) {
    editInput.value = ''
    lastClickedID = ev.currentTarget.getAttribute('data-category-id')
    console.log('Clicked on category ' + lastClickedID)
}

function confirmEdit(ev) {
    ev.preventDefault()
    let newName = editInput.value
    console.log('New category name = ' + newName)

    if(lastClickedID == 1) return


    fetch( '../api/categories/' + lastClickedID, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'name=' + newName
    }).then(response => {
        console.log(response)
        response.json().then(data => console.log(data))
        if(response['status'] != 200) {
            return
        }

        changeCardName(newName)
        lastClickedID = -1
    })
}

function changeCardName(name) {
    let title = document.querySelector('.card[data-category-id="' + lastClickedID + '"] .card-title')

    title.textContent = '! ' + name
}

editButtons.forEach(btn => btn.addEventListener('click', editClicked))
editConfirmButton.addEventListener('click', confirmEdit)
