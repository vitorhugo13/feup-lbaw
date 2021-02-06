'use strict';

// Using this function requires the existence of a pageBottom() function that performs the intended operation
// when a user scrolls to the bottom.

window.onscroll = function(ev) {
    if ((window.innerHeight + window.pageYOffset) >= document.body.scrollHeight) {
        page++

        this.pageBottom()
    }

    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }
};