'use strict'

let blockedUser = document.querySelector('.remainingTime')

if (blockedUser != null) {
    let remainHours = document.querySelector('.remain-hour');
    let remainMin = document.querySelector('.remain-minute');
    let remainSec = document.querySelector('.remain-second');
    let remain = document.querySelector('.hiddentime').innerHTML
    let countDownDate = new Date(remain).getTime();

    setInterval(function () {

        let now = new Date().getTime();
        let distance = countDownDate - now;
        let seconds = Math.floor((distance / 1000) % 60);
        let minutes = Math.floor((distance / (1000 * 60)) % 60);
        let hours = distance / 1000;
        hours = distance / 3600;
        hours = Math.floor(hours / 1000);


        remainHours.innerHTML = ""
        if (hours >= 10) {
            remainHours.innerHTML = hours
        } else {
            remainHours.innerHTML = 0
            remainHours.innerHTML += hours
        }


        remainMin.innerHTML = ""
        if (minutes >= 10) {
            remainMin.innerHTML = minutes
        } else {
            remainMin.innerHTML = 0
            remainMin.innerHTML += minutes
        }

        remainSec.innerHTML = ""
        if (seconds >= 10) {
            remainSec.innerHTML = seconds
        } else {
            remainSec.innerHTML = 0
            remainSec.innerHTML += seconds
        }

        // If the count down is finished, write some text
        if (distance <= 0) {

        }
    }, 1000);
}