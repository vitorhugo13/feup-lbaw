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

let upvotes = document.getElementsByClassName('upvotes')
let downvotes = document.getElementsByClassName('downvotes')

Array.from(upvotes).forEach(element => { element.addEventListener('click', upvote) })
Array.from(downvotes).forEach(element => { element.addEventListener('click', downvote) })

function upvote(event) {
    let id = event.currentTarget.getAttribute('data-id')

    let upvote = event.currentTarget
    let downvote = event.currentTarget.parentNode.getElementsByClassName('downvotes')[0]

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
}

function downvote (event) {
    let id = event.currentTarget.getAttribute('data-id')

    let downvote = event.currentTarget
    let upvote = event.currentTarget.parentNode.getElementsByClassName('upvotes')[0]

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
}

