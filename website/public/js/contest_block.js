'use strict'

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function clearErrorMessage() {
    let error = document.getElementById('empty-error')
    if (error != null)
        error.remove()
}

clearErrorMessage()

let contest_button2 = document.querySelector('button.contest-button')
contest_button2.addEventListener('click', clearErrorMessage)

let submit_contest = document.querySelector('.modal-footer .submitContest')
submit_contest.addEventListener('click', function() {
    clearErrorMessage()

    let justification = document.querySelector('.contest-reason .justification').value
    let user_id = document.getElementsByClassName('user-info')[0].getAttribute('data-user-id')
    let report_file_id = document.querySelector('#reportFile').getAttribute("value")

    if (justification.match(/^\s*$/g)) {
        let modal = document.querySelector('.contest-reason')

        let error = document.createElement('span')
        error.setAttribute('id', 'empty-error')
        error.setAttribute('class', 'error')
        error.innerHTML = 'Justification cannot be empty.'

        modal.insertAdjacentElement('beforeend', error)

        return
    }
        
    fetch('../api/reports/' + report_file_id + '/contests', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: encodeForAjax({'user_id': user_id, 'justification': justification})
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response)
            addAlert('warning', 'Contest not submited!')
            // return;
        }
        response.json().then(data => {
            console.log(data)
            addAlert('success', 'Contest successfuly submited.')
            document.querySelector('.contest-button').remove()


            let nBut = document.createElement('button')
            nBut.setAttribute('class', 'already-contested')
            nBut.setAttribute('title', 'You can only contest once.')
            nBut.innerHTML = "<i class=\"fas fa-exclamation-circle\"></i><strong> Contest </strong>"

            document.getElementById('blocked').insertAdjacentElement('beforeend', nBut)

        })
    })

    $('#contest-modal').modal('hide')
})