'use strict'

const notifications_tab = document.getElementById('notification-tray')

getNotifications()

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}


function getNotifications() {

    let request = {
    }

    fetch('../api/notifications', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: encodeForAjax(request)
    }).then(response => {
        if (response['status'] == 200)
            console.log(response);

        response.json().then(data => {
            addNotifications(data['notifications'])
        })
    })
}

function addNotifications(notifications) {
    console.log(notifications)
}


/* <div class="dropdown-item text-wrap notification"> */
/* </div> */