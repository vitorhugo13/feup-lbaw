'use strict'
let commentArea = document.getElementById('comment-area')
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

function cancelReply() {
    commentSection.parentNode.insertBefore(commentArea, commentSection)
    contentArea.placeholder = 'Leave a comment!'    

    cancelBtn.removeEventListener('click', cancelReply)
    postBtn.removeEventListener('click', addReply)

    postBtn.addEventListener('click', addThread)
    postBtn.removeAttribute('data-thread-id')
}

function addComment(threadID) {
    if (contentArea.value == '') return;

    let postID = postBtn.getAttribute('data-post-id')
    let request = {
        'body': contentArea.value,
        'thread': threadID,
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
        console.log(response)
        if (response['status'] == 200)
            response.json().then(data => {
                console.log(data)
                if (threadID == -1)
                    addThreadToPage(data['id'], data['thread_id'])
                else
                    addReplyToPage(data['id'], data['thread_id'])
            })
    })
}

function addThread() {
    addComment(-1)
}

function addReply(event) {
    let threadID = event.currentTarget.getAttribute('data-thread-id')
    addComment(threadID)
}

function addThreadToPage(id, threadID) {
    let thread = document.createElement('div')
    let comment = document.createElement('div')
    let replies = document.createElement('div')

    thread.classList.add('thread', 'my-4')
    thread.setAttribute('data-id', threadID)
    replies.classList.add('replies', 'ml-5')

    fetch('../api/comments/' + id + '?thread_id=' + threadID , {
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
                refreshReplyListeners()
            })
    })
}

function addReplyToPage(id, threadID) {
    let comment = document.createElement('div')
    let replies = document.querySelector('.thread[data-id="' + threadID + '"] .replies')

    fetch('../api/comments/' + id + '?thread_id=' + threadID, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'text/html'
        }
    }).then(response => {
        if (response['status'] == 200)
            response.text().then(data => {
                replies.append(comment)
                comment.outerHTML = data
                clearContentArea()
                refreshReplyListeners()
            })
    })
}

function replyClicked(ev) {
    let threadID = ev.currentTarget.getAttribute('data-id')
    let thread = document.querySelector('.thread[data-id="' + threadID + '"]')
    
    contentArea.placeholder = 'Leave a reply!'
    thread.parentNode.insertBefore(commentArea, thread.nextSibling)

    let pos = contentArea.getBoundingClientRect()
    window.scrollTo(0, pos.top)
    contentArea.focus()

    postBtn.removeEventListener('click', addThread)

    cancelBtn.addEventListener('click', cancelReply)
    postBtn.addEventListener('click', addReply)
    postBtn.setAttribute('data-thread-id', threadID)
}

function refreshReplyListeners() {
    let replyBtns = document.getElementsByClassName('reply-btn')

    Array.from(replyBtns).forEach(reply => {
        reply.addEventListener('click', replyClicked)
    });
}

refreshReplyListeners()
cancelBtn.addEventListener('click', clearContentArea)
postBtn.addEventListener('click', addThread)
