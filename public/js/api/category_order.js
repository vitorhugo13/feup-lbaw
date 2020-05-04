'use strict'

let orderByNameButton = document.querySelector('#sidebar-navigation ul .name-order')
let orderByPostsButton = document.querySelector('#sidebar-navigation ul .posts-order')
let orderByActivityButton = document.querySelector('#sidebar-navigation ul .activity-order')

let categoryDeck = document.getElementById('category-deck')
let categoriesInput = document.getElementById('categories')
let orderedCategories = []

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function updateCategories() {
    categoriesInput.value = categoriesList.toString()
}

function order(criteria, order){
    fetch('../api/categories/' + criteria + "/" + order, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response);
            return;
        }
        response.json().then(data => {
            categoryDeck.innerHTML = data['deck'];
        })
    })

    //updateCategoryDeck()
}

function orderByName() {
    order('title', 'ASC')    
}

function orderByPosts() {
    order('num_posts', 'DESC')    
}

function orderByActivity() {
    order('last_activity', 'DESC')    
}

function updateCategoryDeck(){
}

orderByNameButton.addEventListener('click', orderByName)
orderByPostsButton.addEventListener('click', orderByPosts)
orderByActivityButton.addEventListener('click', orderByActivity)
