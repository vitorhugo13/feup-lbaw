'use strict'

// IMPORTANT: this makes use of public/js/edit_post.js variables
// some of them: categoriesList, categoriesInpt

let moveButton = document.querySelector('#move-modal .modal-footer > button.btn-primary')
let postCategories = document.querySelector('div.post-categories')

function confirmMove() {
    let postID = moveButton.getAttribute('data-post-id')

    fetch('../api/posts/' + postID + '/categories', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'categories=' + encodeURIComponent(categoriesInput.value)
    }).then(response => {
        if (response['status'] != 200) {
            return
        }

        response.json().then(data => {
            //Manually hiding the modal
            $('#move-modal').modal('hide')
            updatePostCategories(categoriesList)
        })
    })
}

function updatePostCategories(list) {
    postCategories.innerHTML = ''

    list.forEach(category => {
        let a = document.createElement('a')
        a.setAttribute('href', '#')
        a.classList.add('badge', 'badge-pill', 'category-badge')
        a.textContent = '! ' + category

        postCategories.appendChild(a)
    })
}

moveButton.addEventListener('click', confirmMove)