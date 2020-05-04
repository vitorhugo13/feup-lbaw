'use strict'

let reset = document.querySelector('#btn-2')
reset.addEventListener('click', resetPhoto)

function resetPhoto(){
    
    //FIXME: change route
    fetch('../../api/delete/photo', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response);
            return;
        }
        response.json().then(data => {
            console.log(data['success'])
            console.log(data['id'])

            location.replace("./users/" + data['id']);
        })
    })
}



