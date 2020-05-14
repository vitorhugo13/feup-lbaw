'use strict'

let editButtons = document.querySelectorAll('a[data-target="#edit-category-modal"]')
let editConfirmButton = document.querySelector('#edit-category-modal .modal-footer > .btn-primary')
let editInput = document.getElementById('edit-category-name')
let editErrorSpan = document.querySelector('#edit-category-name + span.error')
let lastClickedID = -1

function editClicked(ev) {
    editInput.value = ''
    editErrorSpan.textContent = ''
    lastClickedID = ev.currentTarget.getAttribute('data-category-id')
}

function confirmEdit(ev) {
    let newName = editInput.value
    ev.preventDefault()

    if(lastClickedID == -1) return


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

        response.json().then(data => {
            if (response['status'] != 200) {
                console.log(data['name'])

                editErrorSpan.textContent = ''
                data['name'].forEach(error => editErrorSpan.textContent += error + '\n')
            } else {
                console.log(data['success'])
                //Manually hiding the modal
                $('#edit-category-modal').modal('hide')
                changeCardName(newName)
                lastClickedID = -1
            }
        })
    })
}

function changeCardName(name) {
    let title = document.querySelector('.card[data-category-id="' + lastClickedID + '"] .card-title')

    title.textContent = '! ' + name
}

editButtons.forEach(btn => btn.addEventListener('click', editClicked))
editConfirmButton.addEventListener('click', confirmEdit)
