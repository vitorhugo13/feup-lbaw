'use strict'
let commentArea = document.getElementById('comment-area')
let contentArea = document.getElementById('comment-content')
let cancelBtn = document.getElementById('cancel-btn')
let postBtn = document.getElementById('post-btn')
let commentSection = document.getElementById('comments')
let replyBtns = document.getElementsByClassName('reply-btn')

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function clearContentArea() {
    contentArea.value = ''
}

function cancelReply() {
    commentSection.insertBefore(commentArea)
}

function addThread() {
    let postID = postBtn.getAttribute('data-id')
    let request = {
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
        if (response['status'] == 200)
            response.json().then(data => {
                addThreadToPage(data['id'])
            })
    })
}

function addThreadToPage(id) {
    let thread = document.createElement('div')
    let comment = document.createElement('div')
    let replies = document.createElement('div')

    thread.classList.add('thread', 'my-4')
    replies.classList.add('replies', 'ml-5')

    fetch('../api/comments/' + id, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'text/html'
        }
    }).then(response => {
        if(response['status'] == 200)
            response.text().then(data => {
                thread.append(comment)
                comment.outerHTML = data
                thread.append(replies)
                commentSection.append(thread)
                clearContentArea()
            })
    })
}

function addReply() {
    console.log('Adding reply...')
}

function replyClicked(ev) {
    let threadID = ev.target.getAttribute('data-id')
    let thread = document.querySelector('.thread[data-id="' + threadID + '"]')

    thread.parentNode.insertBefore(commentArea, thread.nextSibling)

    cancelBtn.removeEventListener('click', clearContentArea)
    postBtn.removeEventListener('click', addThread)

    cancelBtn.addEventListener('click', cancelReply)
    postBtn.addEventListener('click', addReply)
}

cancelBtn.addEventListener('click', clearContentArea)
postBtn.addEventListener('click', addThread)
replyBtns.addEventListener('click', replyClicked)