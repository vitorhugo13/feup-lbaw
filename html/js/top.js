'use strict';

let button = document.getElementById('toTop');

window.onscroll = function() {
    if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }
}

button.onclick = function() {
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    document.body.scrollTop = 0; // For Safari
}
