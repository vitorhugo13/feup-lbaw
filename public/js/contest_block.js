'use strict'

let submit_contest = document.querySelector('.modal-footer .submitContest')

submit_contest.addEventListener('click', function(){
    let contest_reason = document.querySelector('.contest-reason .justification').value
    let user_id = document.getElementsByClassName('user-info')[0].getAttribute('data-user-id')

    
    fetch('../api/reports/' + user_id + '/contests', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response);
            return;
        }
        response.json().then(data => {
            console.log(data['success'])
        })
    })

    $('#contest-modal').modal('hide')
})