// Tambahkan event listener untuk tombol "Add New Task"
document.addEventListener('DOMContentLoaded', function () {
    var buttonNew = document.querySelector('.buttonnew');
    var addNewModal = document.getElementById('addNewModal');
    var closeModalButton = document.querySelector('.close-button');

    buttonNew.addEventListener('click', toggleForm);
    closeModalButton.addEventListener('click', closeForm);

    function toggleForm() {
        addNewModal.style.display = 'block';
    }

    function closeForm() {
        addNewModal.style.display = 'none';
    }
});