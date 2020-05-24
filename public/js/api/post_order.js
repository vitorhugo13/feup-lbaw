'use strict'

let freshButtons = document.querySelectorAll('.fresh-tab')
let hotButtons = document.querySelectorAll('.hot-tab')
let topButtons = document.querySelectorAll('.top-tab')
let page = 0
let feed = document.getElementById('feed')
let criteria = 'fresh'

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function updateCategories() {
    categoriesInput.value = categoriesList.toString()
}

function order(page){
    fetch('../api/' + criteria + "/" + page, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response)
            return;
        }
        response.json().then(data => {
            feed.innerHTML = data['feed']
            window.scrollTo(0, 0)
            refreshVoteListeners()
            refreshStarsListeners()
        })
    })
}

function pageBottom(){
    fetch('../api/' + criteria + "/" + page, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response)
            return;
        }
        response.json().then(data => {
            let newPosts = data['feed']

            if(newPosts != null){
                feed.innerHTML += newPosts
                refreshVoteListeners()
                refreshStarsListeners()
            }
        })
    })
}

function freshSelection() {
    criteria = 'fresh'
    order(0)
    page = 0; 
}

function hotSelection() {
    criteria = 'hot'
    order(0)
    page = 0; 
}

function topSelection() {
    criteria = 'top'
    order(0)
    page = 0; 
}

freshButtons.forEach(btn => btn.addEventListener('click', freshSelection))
hotButtons.forEach(btn => btn.addEventListener('click', hotSelection))
topButtons.forEach(btn => btn.addEventListener('click', topSelection))
