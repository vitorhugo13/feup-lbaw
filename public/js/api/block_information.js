'use strict'

let contest_button = document.querySelector('.contest-button')

contest_button.addEventListener('click', function(){

    fetch('../api/reports/contest/reasons', {
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
            document.querySelector('#reason_for_block').innerHTML = "olaaa"
            document.querySelector('#reportFile').setAttribute("value", 34)
        })
    })
})