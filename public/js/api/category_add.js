'use strict'

let addButton = document.querySelector('a[data-target="#new-category-modal"]')
let addConfirmButton = document.querySelector('#new-category-modal .modal-footer > .btn-primary')
let addInput = document.getElementById('new-category-name')
let cardsList = document.querySelector('section.category-cards')

function confirmAddition(ev) {
    ev.preventDefault()
    let newName = addInput.value
    console.log('New category name = ' + newName)

    fetch('../api/categories', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'name=' + newName
    }).then(response => {
        console.log(response)
        if (response['status'] != 200) {
            return
        }
        
        response.json().then(data => {
            console.log(data['success'])
            addCard(data['category'])            
        })
    })
}

/**
 * Client side render of a category card
 * 
 * @param {category as a json} category 
 */
function addCard(category) {
    let aside = document.createElement('aside')
    let a = document.createElement('a')
    let starEl = document.createElement('i')
    
    let title = document.createElement('h5')
    let header = document.createElement('header')
    let body = document.createElement('div')

    let footer = document.createElement('footer')
    let posts = document.createElement('p')
    let active = document.createElement('p')

    let article = document.createElement('article')
    let card = document.createElement('div')

    aside.appendChild(a)
    aside.appendChild(starEl)
    a.outerHTML = '<a data-toggle="modal" data-category-id="' + category.id + '" data-target="#edit-category-modal" style="cursor: pointer;"><i class="fas fa-pen"></i></a>'
    starEl.outerHTML = '<i class="far fa-star" data-id="' + category.id + '"></i>'

    title.classList.add('card-title')
    title.textContent = '! ' + category.title
    header.classList.add('d-flex', 'flex-row', 'justify-content-between')
    header.appendChild(title)
    header.appendChild(aside)
    body.classList.add('card-body')
    body.appendChild(header)
    
    posts.textContent = '0 posts'
    active.textContent = 'Last active: just now'
    footer.classList.add('card-footer', 'd-flex', 'flex-row', 'justify-content-between')
    footer.appendChild(posts)
    footer.appendChild(active)

    article.classList.add('card', 'category-card')
    article.setAttribute('data-category-id', category.id)
    article.appendChild(body)
    article.appendChild(footer)

    card.classList.add('col', 'mb-4', 'px-3', 'px-sm-0')
    card.appendChild(article)

    cardsList.appendChild(card)

    let pos = card.getBoundingClientRect()
    window.scrollTo(0, pos.top)
    refreshCardListeners()
}

function refreshCardListeners() {
    let newStars = document.getElementsByClassName('fa-star')
    let newEditButtons = document.querySelectorAll('a[data-target="#edit-category-modal"]')

    Array.from(newStars).forEach(element => element.addEventListener('click', star))
    newEditButtons.forEach(element => element.addEventListener('click', editClicked))
}

addButton.addEventListener('click', () => addInput.value = '')
addConfirmButton.addEventListener('click', confirmAddition)
