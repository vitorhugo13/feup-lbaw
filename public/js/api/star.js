'use strict';

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        // replace instances of certain characters by escape sequences 
        // representing the utf-8 encoding of the character
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
        // the join method creates and returns a new string by concatenating
        // all of the elements in an array separated bt commas or the specified 
        // separator string, in this case '&'
    }).join('&');
}

// export function request(method, url, data, async, listener) {
//     let request = new XMLHttpRequest();
//     request.onload = listener;

//     if (method === 'post') {
//         request.open(method, url, async);
//         request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//         request.send(encodeForAjax(data));
//     }
//     else if (method === 'get') {
//         request.open(method, url + '?' + encodeForAjax(data), async);
//         request.send();
//     }
// }

// TODO: check if the post is starred by the user
// TODO: change the icon accordingly
let star = document.querySelector('.fa-star');

star.addEventListener('click', function(event) {

    let request = new XMLHttpRequest();
    request.open('get', 'api/posts/1/stars', true);
    // request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send();
    
    request.onload = function() {
        console.log(this.response);
        let response = JSON.parse(this.response);
        if (response[0] == 'error')
            return;

        if (star.classList.contains('far')) {
            star.classList.remove('far');
            star.classList.add('fas');
        }
        else {
            star.classList.remove('fas');
            star.classList.add('far');
        }
    };


});
