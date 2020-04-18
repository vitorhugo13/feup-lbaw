'use strict'

let stars = document.getElementsByClassName('fa-star')
Array.from(stars).forEach(element => { element.addEventListener('click', star) })

function star(event) {
    let star = event.currentTarget
    let id = star.getAttribute('data-id')
    let starred = star.classList.contains('fas')
    
    fetch('../api/posts/' + id + '/stars', {
        method: starred ? 'DELETE' : 'POST',
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
}