'use strict'

let old_pass = document.querySelector('.credentials .old_pass')
let new_pass = document.querySelector('.credentials .password')
let rep_new_pass = document.querySelector('.credentials .password_confirmation')

let has_old = false
let has_new = false
let has_rep = false

old_pass.addEventListener('input', function () {

    if(old_pass && old_pass.value){
        has_old = true;
    }
    else{
        has_old = false;
    }

    update()
});

new_pass.addEventListener('input', function () {

    if (new_pass && new_pass.value) {
        has_new = true;
    } 
    else {
        has_new = false;
    }

    update()
  
});

rep_new_pass.addEventListener('input', function () {

    if (rep_new_pass && rep_new_pass.value) {
        has_rep = true;
    } 
    else {
        has_rep = false;
    }

    update()

});

function update(){
    
    if(has_old || has_new || has_rep){

        old_pass.required = true;
        new_pass.required = true;
        rep_new_pass.required = true;

    }
    else{
        old_pass.required = false;
        new_pass.required = false;
        rep_new_pass.required = false;
    }
}
