'use strict'

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function updateVote(elem, num){
    let val = elem.querySelector('span')
    val.innerText = Number(val.innerText) + num;
    
    if(Number(val.innerText) < 0)
        val.innerText = 0
}

let upvote = document.getElementsByClassName('upvotes')[0]
let downvote = document.getElementsByClassName('downvotes')[0]

upvote.addEventListener('click', function (event) {
    let id = star.getAttribute('data-id')

    let upvoted = upvote.classList.contains('selected')
    let downvoted = downvote.classList.contains('selected')
    let action

    if(upvoted && !downvoted)
        action = 'DELETE'
    else if(!upvoted && !downvoted)
        action = 'POST'
    else if(!upvoted && downvoted)
        action = 'PUT'


    fetch('../api/contents/' + id + '/votes', {
        method: action,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: encodeForAjax({type: 'upvote'})

    }).then(response => {
        if (response['status'] != 200) {
            console.log(response);
            return;
        }
        response.json().then(data => {
            console.log(data['success'])
            if (action == 'DELETE') {
                upvote.classList.remove('selected')
                updateVote(upvote, -1)
            } 
            else if(action == 'POST') {
                upvote.classList.add('selected')
                updateVote(upvote, 1)                
            }
            else if(action == 'PUT'){
                downvote.classList.remove('selected');
                upvote.classList.add('selected')
                updateVote(downvote, -1)
                updateVote(upvote, 1)
            }
        })
    })
});

downvote.addEventListener('click', function (event) {
    let id = star.getAttribute('data-id')

    let upvoted = upvote.classList.contains('selected')
    let downvoted = downvote.classList.contains('selected')
    let action

    if (!upvoted && downvoted)
        action = 'DELETE'
    else if (!upvoted && !downvoted)
        action = 'POST'
    else if (upvoted && !downvoted)
        action = 'PUT'

    fetch('../api/contents/' + id + '/votes', {
        method: action,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: encodeForAjax({ type: 'downvote' })

    }).then(response => {
        if (response['status'] != 200) {
            console.log(response);
            return;
        }
        response.json().then(data => {
            console.log(data['success'])
            if (action == 'DELETE') {
                downvote.classList.remove('selected')
                updateVote(downvote, -1)
            }
            else if (action == 'POST') {
                downvote.classList.add('selected')
                updateVote(downvote, 1)
            }
            else if (action == 'PUT') {
                upvote.classList.remove('selected');
                downvote.classList.add('selected')
                updateVote(upvote, -1)
                updateVote(downvote, 1)
            }
        })
    })
});

