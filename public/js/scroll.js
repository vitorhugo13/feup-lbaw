// Using this function requires the existence of a pageBottom() function that performs the intended operation
// when a user scrolls to the bottom.

window.onscroll = function(ev) {
    if ((window.innerHeight + window.pageYOffset) >= document.body.scrollHeight) {
        page++

        this.pageBottom()
    }
};

function resetPage(){
    
}