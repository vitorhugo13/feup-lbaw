// $(document).ready(function(){
//       $(window).scroll(function () {
//           if ($(this).scrollTop() != 0) {
//               $('#toTop').fadeIn();
//           } else {
//               $('#toTop').fadeOut();
//           }
//       }); 
//   $('#toTop').click(function(){
//       $("html, body").animate({ scrollTop: 0 }, 600);
//       return false;
//   });
// });

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


