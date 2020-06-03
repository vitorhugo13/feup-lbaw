'use strict'

let addButton = document.querySelector('a[data-target="#new-category-modal"]')
let addConfirmButton = document.querySelector('#new-category-modal .modal-footer > .btn-primary')
let addInput = document.getElementById('new-category-name')
let addErrorSpan = document.querySelector('#new-category-name + span.error')
let cardsList = document.querySelector('section.category-cards')

function confirmAddition(ev) {
    let newName = addInput.value
    ev.preventDefault()

    fetch('../api/categories', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'name=' + encodeURIComponent(newName)
    }).then(response => {
        console.log(response)
        
        response.json().then(data => {
            if (response['status'] != 200) {
                console.log(data['name'])
                
                addErrorSpan.textContent = ''
                data['name'].forEach(error => addErrorSpan.textContent += error + '\n')
            } else {
                console.log(data['success'])
                //Manually hiding the modal
                $('#new-category-modal').modal('hide')
                addCard(data['category'])                
            }
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

addButton.addEventListener('click', () => {
    addInput.value = ''
    addErrorSpan.textContent = ''
})
addConfirmButton.addEventListener('click', confirmAddition)
