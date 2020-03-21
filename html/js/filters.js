'use strict'

let midHot = document.querySelector('#mid-pills-tab .hot-tab')
let midTop = document.querySelector('#mid-pills-tab .top-tab')
let midFresh = document.querySelector('#mid-pills-tab .fresh-tab')
let sidebarHot = document.querySelector('#pills-tab .hot-tab')
let sidebarTop = document.querySelector('#pills-tab .top-tab')
let sidebarFresh = document.querySelector('#pills-tab .fresh-tab')

console.log(midHot)

function toggleActive(tab1, tab2, tab3) {
    if(!this.classList.contains('active')){
        tab1.classList.toggle('active')
        tab2.classList.remove('active')
        tab3.classList.remove('active')
    }
}

midHot.addEventListener('click', toggleActive.bind(midHot, sidebarHot, sidebarTop, sidebarFresh))
sidebarHot.addEventListener('click', toggleActive.bind(sidebarHot, midHot, midTop, midFresh))

midTop.addEventListener('click', toggleActive.bind(midTop, sidebarTop, sidebarHot, sidebarFresh))
sidebarTop.addEventListener('click', toggleActive.bind(sidebarTop, midTop, midHot, midFresh))

midFresh.addEventListener('click', toggleActive.bind(midFresh, sidebarFresh, sidebarHot, sidebarTop))
sidebarFresh.addEventListener('click', toggleActive.bind(sidebarFresh, midFresh, midHot, midTop))