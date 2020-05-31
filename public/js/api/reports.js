'use strict'

const postsButton = document.getElementById('posts-nav')
const commentsButton = document.getElementById('comments-nav')
const contestsButton = document.getElementById('contests-nav')

const postsTable = document.getElementById('posts-table')
const commentsTable = document.getElementById('comments-table')
const contestsTable = document.getElementById('contests-table')

postsButton.addEventListener('click', getEntries.bind(this, 'posts'))
commentsButton.addEventListener('click', getEntries.bind(this, 'comments'))
contestsButton.addEventListener('click', getEntries.bind(this, 'contests'))

let tables = { 'posts' : postsTable, 'comments' : commentsTable, 'contests' : contestsTable }
getEntries('posts')

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function getEntries(criteria) {

    tables[criteria].textContent = ''

    fetch('../api/reports/' + criteria, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response)
            // return;
        }
        response.json().then(data => {
            console.log(data)
            if (criteria == 'contests') {
                drawContestEntries(data['contests'])
            }
            else if (criteria == 'posts') {
                drawPostEntries(data['reports'])
            }
            else {
                drawCommentEntries(data['reports'])
            }
            // window.scrollTo(0, 0) //TODO: Automatically scroll to top?
        })
    })
}

function drawPostEntries(list) {
    for (let i = 0; i < list.length; i++) {
        let report = drawPostReportEntry(list[i])
        postsTable.insertAdjacentElement('beforeend', report)
    }
}

function drawContestEntries(list) {
    for (let i = 0; i < list.length; i++) {
        let report = drawContestEntry(list[i])
        contestsTable.insertAdjacentElement('beforeend', report)
    }
}

function drawCommentEntries(list) {
    for (let i = 0; i < list.length; i++) {
        let report = drawCommentReportEntry(list[i])
        commentsTable.insertAdjacentElement('beforeend', report)
    }
}

function drawPostReportEntry(report) {
    let row = document.createElement('tr')

    let title = document.createElement('td')
    title.setAttribute('class', 'data-title')
    title.innerHTML = '<span>' + report['title'] + '</span>'
    row.appendChild(title)

    let reason = document.createElement('td')
    reason.setAttribute('class', 'data-reason')
    reason.innerHTML = '<span>' + report['reason'] + '</span>'
    row.appendChild(reason)

    let date = document.createElement('td')
    date.setAttribute('class', 'data-date')
    date.innerHTML = '<span>' + report['date'] + '</span>'
    row.appendChild(date)

    let dropdown = document.createElement('td')

    let icon = document.createElement('i')
    icon.setAttribute('class', 'fas fa-ellipsis-v')
    icon.setAttribute('data-toggle', 'dropdown')
    dropdown.appendChild(icon)

    let menu = document.createElement('div')
    menu.setAttribute('class', 'dropdown-menu dropdown-menu-right')
    menu.innerHTML += '<a class="dropdown-item" href="#">Move</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Delete</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Block User</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Resolve</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Ignore</a>'
    dropdown.appendChild(menu)

    row.appendChild(dropdown)

    return row
}

function drawCommentReportEntry(report) {
    let row = document.createElement('tr')

    let content = document.createElement('td')
    content.setAttribute('class', 'data-content')
    content.innerHTML = '<span>' + report['content'] + '</span>'
    row.appendChild(content)

    let reason = document.createElement('td')
    reason.setAttribute('class', 'data-reason')
    reason.innerHTML = '<span>' + report['reason'] + '</span>'
    row.appendChild(reason)

    let date = document.createElement('td')
    date.setAttribute('class', 'data-date')
    date.innerHTML = '<span>' + report['date'] + '</span>'
    row.appendChild(date)

    let dropdown = document.createElement('td')

    let icon = document.createElement('i')
    icon.setAttribute('class', 'fas fa-ellipsis-v')
    icon.setAttribute('data-toggle', 'dropdown')
    dropdown.appendChild(icon)

    let menu = document.createElement('div')
    menu.setAttribute('class', 'dropdown-menu dropdown-menu-right')
    menu.innerHTML += '<a class="dropdown-item" href="#">Move</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Delete</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Block User</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Resolve</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Ignore</a>'
    dropdown.appendChild(menu)

    row.appendChild(dropdown)

    return row
}

function drawContestEntry(contest) {
    let row = document.createElement('tr')

    let title = document.createElement('td')
    title.setAttribute('class', 'data-justification')
    title.innerHTML = '<span>' + contest['justification'] + '</span>'
    row.appendChild(title)

    let reason = document.createElement('td')
    reason.setAttribute('class', 'data-reason')
    reason.innerHTML = '<span>' + contest['reason'] + '</span>'
    row.appendChild(reason)

    let date = document.createElement('td')
    date.setAttribute('class', 'data-date')
    date.innerHTML = '<span>' + contest['time'] + '</span>'
    row.appendChild(date)

    let dropdown = document.createElement('td')

    let icon = document.createElement('i')
    icon.setAttribute('class', 'fas fa-ellipsis-v')
    icon.setAttribute('data-toggle', 'dropdown')
    dropdown.appendChild(icon)

    let menu = document.createElement('div')
    menu.setAttribute('class', 'dropdown-menu dropdown-menu-right')
    // menu.innerHTML += '<a class="dropdown-item" href="#">Move</a>'
    // menu.innerHTML += '<a class="dropdown-item" href="#">Delete</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Accept</a>'
    menu.innerHTML += '<a class="dropdown-item" href="#">Reject</a>'
    // menu.innerHTML += '<a class="dropdown-item" href="#">Ignore</a>'
    dropdown.appendChild(menu)

    row.appendChild(dropdown)

    return row
}