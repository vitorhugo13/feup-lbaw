let form = document.getElementById('delete-confirmation')
let confirmDeleteBtn = document.getElementById('confirm-delete')

function confirmDeletion() {
    form.submit();
}

confirmDeleteBtn.addEventListener('click', confirmDeletion)