let addButton = document.querySelector('#categories-tab button')
let options = document.querySelector('#categories-tab .custom-select')
let selectedCategories = document.getElementById('selected-categories');

function addSelectedCategory(){
    let selectedCategory = options.options[options.selectedIndex].innerHTML;

    let badge = document.createElement('span')

    console.log(selectedCategory);

    selectedCategories.append(badge);
    
    badge.outerHTML = '<span class="badge badge-pill category-move-badge">! ' + selectedCategory + '<i class="fas fa-times"></i></span>'
}

addButton.addEventListener('click', addSelectedCategory);
