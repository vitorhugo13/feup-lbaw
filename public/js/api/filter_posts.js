'use strict'

let checkboxes = document.querySelectorAll('.category-checkbox')
let feed = document.getElementById('feed')
let selectedCategories = []
let page = 0

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function filter(){
    fetch('../api/filter/' + JSON.stringify(selectedCategories) + "/" + page, {
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
            console.log(data['feed'])
            window.scrollTo(0, 0)
            refreshVoteListeners()
            refreshStarsListeners()
        })
    })
}

function pageBottom(){
    fetch('../api/filter/' + JSON.stringify(selectedCategories) + "/" + page, {
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

function checkClicked(){
    checkboxes.forEach(function(elem){
        if(elem.checked)
            selectedCategories.push(elem.getAttribute('value'))
    })
}

function clicked(event){
    let category = event.currentTarget.getAttribute('value')
    let index = selectedCategories.indexOf(category)

    if(index == -1)
        selectedCategories.push(category)
    else
        selectedCategories.splice(index, 1)

    filter()
    page = 0; 
}

checkClicked()
checkboxes.forEach(btn => btn.addEventListener('click', clicked))
