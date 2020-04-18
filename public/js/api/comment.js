'use strict'
// URL '/api/comments'

let contentArea = document.getElementById('comment-content')
let cancelBtn = document.getElementById('cancel-btn')
let postBtn = document.getElementById('post-btn')
let commentSection = document.getElementById('comments')

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function clearContentArea() {
    contentArea.value = ''
}

function addThread() {
    let postID = postBtn.getAttribute('data-id')
    console.log('POST ID: ' + postID)
    request = {
        'body': contentArea.value,
        'thread': -1,
        'post_id': postID
    }

    fetch('../api/comments', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: encodeForAjax(request)
    }).then(response => {
        if (response['status' == 200])
            response.json().then(data => {
                console.log(data)
                addThreadToPage(data)
            })
    })
}

function addThreadToPage(data) {
    let thread = document.createElement('div')
    let comment = document.createElement('div')
    let replies = document.createElement('div')

    thread.classList.add('thread', 'my-4')
    comment.classList.add('comment', 'p-3')
    replies.classList.add('replies', 'ml-5')

    fetch('../api/comments/' + data, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'text/html'
        }
    }).then(response => {
        if(response['status'] == 200)
            response.text().then()(data => {
                comment.innerHTML = data
                thread.append(comment)
                thread.append(replies)
                commentSection.append(thread)
            })
    })
}

cancelBtn.addEventListener('click', clearContentArea)
postBtn.addEventListener('click', addThread)