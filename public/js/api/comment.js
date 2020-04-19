'use strict'

let commentArea = document.getElementById('comment-area')
let contentArea = document.getElementById('comment-content')
let cancelBtn = document.getElementById('cancel-btn')
let postBtn = document.getElementById('post-btn')
let commentSection = document.getElementById('comments')
let numComments = document.getElementById('num-comments')
let confirmDeleteBtn = document.getElementById('confirm-delete')
let commentID = -1


function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function updateNumComments(val) {
    numComments.innerHTML = parseInt(numComments.innerHTML) + val
}

function decreaseNumComments(val){
    numComments.innerHTML = val
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

function cancelEdit(comID, threadID, content) {
    let commentBody = document.querySelector('.comment[data-comment-id="' + comID + '"] .comment-body')
    let commentFooter = document.querySelector('.comment[data-comment-id="' + comID + '"] footer')
    let btnSpan = document.querySelector('.comment[data-comment-id="' + comID + '"] footer > span')
    let replyBtn = document.createElement('button')

    commentBody.outerHTML = '<p class="comment-body">' + content + '</p>'
    btnSpan.remove()
    commentFooter.append(replyBtn)
    replyBtn.outerHTML = '<button class="reply-btn d-flex align-items-center" data-id="' + threadID + '" data-comment-id="' + comID + '"><span>Reply</span></button>'

    let newBtn = document.querySelector('.comment[data-comment-id="' + comID + '"] footer .reply-btn')
    newBtn.addEventListener('click', replyClicked)
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
        if (response['status'] == 200)
            response.json().then(data => {
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
                updateNumComments(1)
                clearContentArea()
                refreshButtonListeners()
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
                updateNumComments(1)
                clearContentArea()
                cancelReply()
                refreshButtonListeners()
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

function deleteComment(event) {
    commentID = event.currentTarget.getAttribute('data-comment-id')
}

function confirmDeletion() {
    if(commentID == -1) return

    fetch('../api/comments/' + commentID, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        if (response['status'] == 200)
            response.json().then(data => {
                removeCommentFromPage()
                decreaseNumComments(data.num)
            })
    })      
}

function removeCommentFromPage() {
    let comment = document.querySelector('.comment[data-comment-id="' + commentID + '"]')
    
    if(comment.parentElement.classList.contains('thread')){
        comment.parentElement.remove()
    }
    else
        comment.remove()

    commentID = -1
}

function editComment(event) {
    let comID = event.currentTarget.getAttribute('data-comment-id')
    let threadID = event.currentTarget.getAttribute('data-thread-id')
    let commentBody = document.querySelector('.comment[data-comment-id="' + comID + '"] .comment-body')
    let replyButton = document.querySelector('.reply-btn[data-comment-id="' + comID + '"]')
    let commentFooter = document.querySelector('.comment[data-comment-id="' + comID + '"] footer')
    let cancelBtn = document.createElement('button')
    let confirmBtn = document.createElement('button')
    let btnSpan = document.createElement('span')
    let oldContent = commentBody.textContent

    commentBody.outerHTML = '<textarea class="comment-body" placeholder="You are editing your post..." oninput="auto_grow(this)">' + commentBody.textContent + '</textarea>'

    cancelBtn.innerHTML = 'Cancel'
    cancelBtn.classList.add('cancel-edit-btn', 'mr-2')
    cancelBtn.setAttribute('data-comment-id', comID)
    cancelBtn.setAttribute('data-thread-id', threadID)
    confirmBtn.innerHTML = 'Confirm'
    confirmBtn.classList.add('confirm-edit-btn')
    confirmBtn.setAttribute('data-comment-id', comID)
    confirmBtn.setAttribute('data-thread-id', threadID)
    
    btnSpan.append(cancelBtn)
    btnSpan.append(confirmBtn)
    commentFooter.append(btnSpan)
    replyButton.remove()

    cancelBtn.addEventListener('click', ev => cancelEdit(comID, threadID, oldContent))
    confirmBtn.addEventListener('click', confirmEdit)
}

function confirmEdit(event) {
    let comID = event.currentTarget.getAttribute('data-comment-id')
    let threadID = event.currentTarget.getAttribute('data-thread-id')
    let content = document.querySelector('.comment[data-comment-id="' + comID + '"] .comment-body').value
    if (comID == null || content == '') return

    fetch('../api/comments/' + comID, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: 'body=' + content
    }).then(response => {
        if (response['status'] == 200)
            response.json().then(data => {
                cancelEdit(comID, threadID, content)
            })
    }) 
}

function refreshButtonListeners() {
    let replyBtns = document.getElementsByClassName('reply-btn')
    let deleteBtns = document.getElementsByClassName('delete-comment-btn')
    let editBtns = document.getElementsByClassName('edit-comment-btn')

    Array.from(replyBtns).forEach(reply => {
        reply.addEventListener('click', replyClicked)
    })

    Array.from(deleteBtns).forEach(deleteBtn => {
        deleteBtn.addEventListener('click', deleteComment)
    })

    Array.from(editBtns).forEach(editBtn => {
        editBtn.addEventListener('click', editComment)
    })

    //from rating.js
    refreshVoteListeners()
}

refreshButtonListeners()
cancelBtn.addEventListener('click', clearContentArea)
postBtn.addEventListener('click', addThread)
confirmDeleteBtn.addEventListener('click', confirmDeletion)
