'use strict'

let freshButton = document.querySelector('#sidebar-navigation .nav .fresh-tab')
let hotButton = document.querySelector('#sidebar-navigation .nav .hot-tab')
let topButton = document.querySelector('#sidebar-navigation .nav .top-tab')

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
            window.scrollTo(0, 0) //TODO: Automatically scroll to top?
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

freshButton.addEventListener('click', freshSelection)
hotButton.addEventListener('click', hotSelection)
topButton.addEventListener('click', topSelection)
