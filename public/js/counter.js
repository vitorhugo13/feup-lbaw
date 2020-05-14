'use strict'


let blocked = document.querySelector('.remaining-time')

if (blocked != null) {
    let remainHours = document.querySelector('.remain-hours');
    let remainMin = document.querySelector('.remain-min');
    let remainSec= document.querySelector('.remain-sec');
    let remain = document.querySelector('.hidden-time').innerHTML
    let countDownDate = new Date(remain).getTime();

    setInterval(function (){

        let now = new Date().getTime();
        let distance = countDownDate - now;
        let seconds = Math.floor((distance / 1000) % 60);
        let minutes = Math.floor((distance / (1000 * 60)) % 60);
        let hours = distance / 1000;
        hours = distance / 3600;
        hours = Math.floor(hours/1000);
       

        remainHours.innerHTML = ""
        if (hours >= 10) {
            remainHours.innerHTML = hours
            remainHours.innerHTML += 'h'
        } else {
            remainHours.innerHTML = 0
            remainHours.innerHTML += hours
            remainHours.innerHTML += 'h'
        }


        remainMin.innerHTML = ""
        if (minutes >= 10) {
            remainMin.innerHTML = minutes
            remainMin.innerHTML += 'm'
        } else {
            remainMin.innerHTML = 0
            remainMin.innerHTML += minutes
            remainMin.innerHTML += 'm'
        }

        remainSec.innerHTML = ""
        if (seconds >= 10) {
            remainSec.innerHTML = seconds
            remainSec.innerHTML += 's'
        } else {
            remainSec.innerHTML = 0
            remainSec.innerHTML += seconds
            remainSec.innerHTML += 's'
        }

        // If the count down is finished, write some text
        if (distance <= 0) {
            
        }
    }, 1000);
}