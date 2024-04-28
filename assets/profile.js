//dropdown profil
document.addEventListener('DOMContentLoaded', function () {
    var arrowIcon = document.getElementById('arrow-dropdown');
    var dropdownContent = document.getElementById('dropdown-content');

    arrowIcon.addEventListener('click', function () {
        // Toggle the visibility of the dropdown content
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
    });
});


/*// Form Edit Personal Information
document.addEventListener("DOMContentLoaded", function () {
    var editPersonalButton = document.querySelector(".btnperprof");
    var editPersonalForm = document.getElementById("editPersonal");

    editPersonalButton.addEventListener("click", function () {
        // Menyembunyikan/menampilkan formulir "Edit Personal Information"
        editPersonalForm.style.display = "block";

        // Menyesuaikan tampilan sesuai kebutuhan
        var rowUp = document.querySelector('.row-up');
        var cardProf2 = document.querySelector('.card-prof2');
        var cardProf3 = document.querySelector('.card-prof3');

        rowUp.style.flexDirection = 'column';
        cardProf2.style.width = '90%';
        cardProf3.style.width = '90%';
    });

    // Tombol Tutup Form
    document.getElementById('closeButton').addEventListener("click", closeForm);
});

// Tombol Tutup Form
function closeForm() {
    var editPersonalForm = document.getElementById('editPersonal');
    var rowUp = document.querySelector('.row-up');
    var cardProf2 = document.querySelector('.card-prof2');
    var cardProf3 = document.querySelector('.card-prof3');

    editPersonalForm.style.display = 'none';
    rowUp.style.flexDirection = 'row';
    cardProf2.style.width = '45%';
    cardProf3.style.width = '45%';
}*/

// Modal Edit Personal Information
document.addEventListener("DOMContentLoaded", function () {
    var editButton = document.querySelector(".btnperprof");
    var personalModal = document.getElementById("personalModal");

    // Add click event listener to the "Edit" button
    editButton.addEventListener("click", function () {
        // Display the personal modal
        personalModal.style.display = "block";
    });

    // Add click event listener to close button in the personal modal
    var closePersonalButton = document.querySelector("#personalModal .close-button");
    closePersonalButton.addEventListener("click", function () {
        // Close the personal modal when the close button is clicked
        personalModal.style.display = "none";
    });

    // Close the personal modal if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target == personalModal) {
            personalModal.style.display = 'none';
        }
    });
});


/*// Form Edit Address
document.addEventListener("DOMContentLoaded", function () {
    var editAddressButton = document.querySelector(".btn-adprof");
    var editAddressForm = document.getElementById("editAddress");

    editAddressButton.addEventListener("click", function () {
        // Menyembunyikan/menampilkan formulir "Edit Address"
        editAddressForm.style.display = "block";

        // Menyesuaikan tampilan sesuai kebutuhan
        var rowUp = document.querySelector('.row-up');
        var cardProf2 = document.querySelector('.card-prof2');
        var cardProf3 = document.querySelector('.card-prof3');

        rowUp.style.flexDirection = 'column';
        cardProf2.style.width = '90%';
        cardProf3.style.width = '90%';
    });

    // Tombol Tutup Form
    document.getElementById('closeButtonAddress').addEventListener("click", closeFormAddress);
});

// Tombol Tutup Form Edit Address
function closeFormAddress() {
    var editAddressForm = document.getElementById('editAddress');
    var rowUp = document.querySelector('.row-up');
    var cardProf2 = document.querySelector('.card-prof2');
    var cardProf3 = document.querySelector('.card-prof3');

    editAddressForm.style.display = 'none';
    rowUp.style.flexDirection = 'row';
    cardProf2.style.width = '45%';
    cardProf3.style.width = '45%';
}*/

document.addEventListener("DOMContentLoaded", function () {
    var editAddressButton = document.querySelector(".btn-adprof");
    var addressModal = document.getElementById("addressModal");

    // Add click event listener to the "Edit" button for address
    editAddressButton.addEventListener("click", function () {
        // Display the address modal
        addressModal.style.display = "block";
    });

    // Add click event listener to close button in the address modal
    var closeAddressButton = document.querySelector("#addressModal .close-button");
    closeAddressButton.addEventListener("click", function () {
        // Close the address modal when the close button is clicked
        addressModal.style.display = "none";
    });

    // Close the address modal if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target == addressModal) {
            addressModal.style.display = 'none';
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var editphotoButton = document.querySelector(".btn-eprof");
    var photoModal = document.getElementById("photoprofilemodal");

    // Add click event listener to the "Edit" button for profpic
    editphotoButton.addEventListener("click", function () {
        // Display the profpic modal
        photoModal.style.display = "block";
    });

    // Add click event listener to close button in the profpic modal
    var closeprofpicButton = document.querySelector("#photoprofilemodal .close-button");
    closeprofpicButton.addEventListener("click", function () {
        // Close the profpic modal when the close button is clicked
        photoModal.style.display = "none";
    });

    // Close the profpic modal if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target == photoModal) {
            photoModal.style.display = 'none';
        }
    });
});


