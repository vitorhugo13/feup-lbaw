'use strict'

let star = document.querySelector('.fa-star')

if(star != null) {
    star.addEventListener('click', function () {
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
    });
}
    