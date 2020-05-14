'use strict'

let checkboxes = document.querySelectorAll('.category-checkbox')
let feed = document.getElementById('feed')
let selectedCategories = []

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function filter(){
    fetch('../api/filter/' + selectedCategories, {
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

function checkClicked(){
    checkboxes.forEach(function(elem){
        if(elem.checked)
            selectedCategories.push(elem.getAttribute('value'))
    })
}

function clicked(event){
    let title = event.currentTarget.getAttribute('value')
    let index = selectedCategories.indexOf(title)

    if(index == -1)
        selectedCategories.push(title)
    else
        selectedCategories.splice(index, 1)

    console.log(selectedCategories)
    filter()
}

checkClicked()
checkboxes.forEach(btn => btn.addEventListener('click', clicked))
