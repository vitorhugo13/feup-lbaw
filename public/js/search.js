let username_filter = document.getElementById('filter-username')
let category_filter = document.getElementById('filter-category')
let title_filter = document.getElementById('filter-title')
let page = 0

let filters = [0,0,0]

function update_filter(){

    let active_filters = ['username', 'category', 'title']

    for(let i = 0; i < filters.length; i++){
        if(filters[i] == 0)
            active_filters.slice(i, 1)
    }

    /*
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
    })*/
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