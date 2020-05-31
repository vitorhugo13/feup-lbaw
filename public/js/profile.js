let form = document.getElementById('delete-confirmation')
let confirmDeleteBtn = document.getElementById('confirm-delete')

function confirmDeletion() {
    console.log("OKKKKKK")
    form.submit();
}

confirmDeleteBtn.addEventListener('click', confirmDeletion)