let username_filter = document.getElementById('filter-username')
let category_filter = document.getElementById('filter-category')
let title_filter = document.getElementById('filter-title')
let feed = document.getElementById('search-results')
let query = document.getElementById('search-query').value
let page = 0

let filters = [username_filter.checked, category_filter.checked, title_filter.checked]
let filters_request = ''

function parse_filters() {
    let active_filters = ['username', 'category', 'title']
    filters_request = ''

    for(let i = 0; i < filters.length; i++){
        filters_request += active_filters[i]

        if(filters[i] != 0)
            filters_request += '=1'
        else  
            filters_request += '=0'

        if(i != filters.length - 1)
            filters_request += '&'
    }
}

function update_filter(){
    parse_filters()
    
    fetch('../api/search/0/filter?' + filters_request + '&search="' + query + '"', {
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
            page = 0
            feed.innerHTML = data['feed']
            window.scrollTo(0, 0)
            refreshVoteListeners()
            refreshStarsListeners()
        })
    })
}

function pageBottom(){
    fetch('../api/search/' + page + 'filter?' + filters_request + '&search="' + query + '"', {
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

function filter_username(){
    filters[0] = (filters[0] + 1) % 2 
    update_filter()
}

function filter_category(){
    filters[1] = (filters[1] + 1) % 2 
    update_filter()
}

function filter_title(){
    filters[2] = (filters[2] + 1) % 2 
    update_filter()
}

username_filter.addEventListener('click', filter_username)
category_filter.addEventListener('click', filter_category)
title_filter.addEventListener('click', filter_title)