let addButton = document.querySelector('#categories-tab button')
let dropdownCategories = document.querySelector('#categories-tab .custom-select')
let selectedCategories = document.getElementById('selected-categories')
let categoriesInput = document.querySelector('#categories-tab input')
let categoriesList = []

function updateCategories() {
    categoriesInput.value = categoriesList.toString()
}

function addSelectedCategory(){
    let selectedCategory = dropdownCategories.options[dropdownCategories.selectedIndex].innerHTML;

    if(categoriesList.includes(selectedCategory))
        return;

    let badge = document.createElement('span')
    let remove = document.createElement('i')
        
    selectedCategories.append(badge)
        
    categoriesList.push(selectedCategory)
        
    remove.classList.add('fas', 'fa-times')

    badge.classList.add('badge', 'badge-pill', 'category-move-badge')

    badge.innerText = '! ' + selectedCategory
    badge.append(remove)
    
    remove.addEventListener('click', removeSelectedCategory)   
    
    dropdownCategories.options[dropdownCategories.selectedIndex].style['display']='none'
    dropdownCategories.selectedIndex = 0

    updateCategories()
}

function removeSelectedCategory(event){

    let badge = event.currentTarget.parentElement

    let listIndex = categoriesList.indexOf(badge.textContent.replace("! ", ""))

    if(listIndex < -1)
        return

    categoriesList.splice(listIndex, 1)

    selectedCategories.removeChild(badge)

    Array.from(dropdownCategories.options).forEach(category => {
        if(category.innerHTML == badge.textContent.replace("! ", ""))
            category.style['display']='block'
    });

    updateCategories()
}

function getAllSelectedCategories() {
    Array.from(selectedCategories.children).forEach(badge => {
        categoriesList.push(badge.textContent.replace("! ", ""))
    });

    Array.from(dropdownCategories.options).forEach(category => {
        if(categoriesList.includes(category.innerHTML))
            category.style['display']='none'
    });
}

getAllSelectedCategories();

updateCategories()

addButton.addEventListener('click', addSelectedCategory);

Array.from(selectedCategories.children).forEach(badge => {
    badge.querySelector('i.fa-times').addEventListener('click', removeSelectedCategory)
});
