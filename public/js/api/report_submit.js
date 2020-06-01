'use strict'

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

let send = document.querySelector('.sendReport')
let reportButtons = document.querySelectorAll('a[data-target="#report-modal"]')
let content_id = -1

send.addEventListener('click', function(){

    let e = document.getElementById("report-reason");
    let reason = e.options[e.selectedIndex].text;

    if(content_id == -1)
        return


    fetch('../api/reports/create', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: encodeForAjax({'content': content_id, 'reason': reason})
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response)
            addAlert('warning', 'Report not submited!')
            return;
        }
        response.json().then(data => {
            console.log(data)
            addAlert('success', 'Report successfuly submited.')
        })
    })

    content_id = -1
    $('#report-modal').modal('hide')

})

reportButtons.forEach(btn => btn.addEventListener('click', function(event){
    console.log(event.currentTarget)
    content_id = event.currentTarget.getAttribute('data-content-id')
}))