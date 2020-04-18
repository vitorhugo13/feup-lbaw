'use strict'

let upvote = document.getElementsByClassName('upvotes')[0]
let downvote = document.getElementsByClassName('downvotes')[0]

upvote.addEventListener('click', function (event) {
    fetch('../api/posts/' + id + '/stars', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    }).then(response => {
        
    })
});
