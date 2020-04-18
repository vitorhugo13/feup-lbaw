'use strict'

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        // replace instances of certain characters by escape sequences 
        // representing the utf-8 encoding of the character
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        // the join method creates and returns a new string by concatenating
        // all of the elements in an array separated bt commas or the specified 
        // separator string, in this case '&'
    }).join('&')
}

// TODO: check if the post is starred by the user
// TODO: change the icon accordingly
let star = document.querySelector('.fa-star')

star.addEventListener('click', function (event) {
    let id = star.getAttribute('data-id')

    fetch('../api/posts/' + id + '/stars', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        if (response['status'] != 200) {
            console.log(response);
            return;
        }
        response.json().then(data => {
            console.log(data['success'])
            if (star.classList.contains('far')) {
                star.classList.remove('far')
                star.classList.add('fas')
            }
            else {
                star.classList.remove('fas')
                star.classList.add('far')
            }
        })
    })
});
