'use strict'

let freshButtons = document.querySelectorAll('.fresh-tab')
let hotButtons = document.querySelectorAll('.hot-tab')
let topButtons = document.querySelectorAll('.top-tab')

let feed = document.getElementById('feed')

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function updateCategories() {
    categoriesInput.value = categoriesList.toString()
}

function order(criteria){
    fetch('../api/' + criteria, {
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

function freshSelection() {
    order('fresh')    
}

function hotSelection() {
    order('hot')    
}

function topSelection() {
    order('top')    
}

freshButtons.forEach(btn => btn.addEventListener('click', freshSelection))
hotButtons.forEach(btn => btn.addEventListener('click', hotSelection))
topButtons.forEach(btn => btn.addEventListener('click', topSelection))
