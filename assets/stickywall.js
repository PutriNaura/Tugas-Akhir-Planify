// Function to open edit modal for sticky wall
function openEditModalStickyWall(stickyId, title, content) {
    document.getElementById("edit_sticky_id").value = stickyId;
    document.getElementById("edit_titlesticky").value = title;
    document.getElementById("edit_editor").innerHTML = content;
    document.getElementById("modal-edit-sticky").style.display = "block";
}

document.addEventListener('DOMContentLoaded', function () {
    // Dropdown profil
    var arrowIcon = document.getElementById('arrow-dropdown');
    var dropdownContent = document.getElementById('dropdown-content');

    arrowIcon.addEventListener('click', function () {
        // Toggle the visibility of the dropdown content
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
    });

    // Sidebar Toggle
    const menu = document.getElementById('menu-label');
    const sidebar = document.querySelector('.sidebar');

    menu.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
        console.log('Sidebar toggle clicked');
    });

    // Modal Add Sticky
    document.getElementById('btn-addst').addEventListener('click', function () {
        document.getElementById('modal-sticky').style.display = 'block';
    });

    document.getElementById('closeBtnSt').addEventListener('click', function () {
        console.log("Close button clicked");
        document.getElementById('modal-sticky').style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == document.getElementById('modal-sticky')) {
            document.getElementById('modal-sticky').style.display = 'none';
        }
    });

    // Function to open edit modal on sticky note click
    var stickyNotes = document.querySelectorAll(".card-st");
    stickyNotes.forEach(function (note) {
        note.addEventListener("click", function () {
            var stickyId = this.getAttribute('data-sticky-id');
            var title = this.getAttribute('data-title');
            var content = this.getAttribute('data-content');
            openEditModalStickyWall(stickyId, title, content);
        });
    });

    // Panggil fungsi getStickyData setelah konten dimuat
    getStickyData();
});

// Tombol Save pada Modal Sticky Wall
document.getElementById('saveBtn').addEventListener('click', function () {
    // Mengambil nilai dari input dan elemen form
    var title = document.getElementById('titlesticky').value;
    var content = document.getElementById('editor').innerHTML;

    // Membuat elemen card baru
    var newCard = createStickyCard(title, content);

    // Menambahkan card baru ke dalam card-sticky
    var cardSticky = document.querySelector('.card-sticky');
    cardSticky.appendChild(newCard);

    // Menutup modal Sticky Wall
    closeStickyModal();
});


// Fungsi untuk menutup modal Sticky Wall
function closeStickyModal() {
    document.getElementById('modal-sticky').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {

    // Close edit modal when close button is clicked
    document.getElementById("closeBtnEditSt").addEventListener("click", function () {
        document.getElementById("modal-edit-sticky").style.display = "none";
    });

    // Close edit modal when clicked outside modal content
    window.onclick = function (event) {
        var modal = document.getElementById("modal-edit-sticky");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});

// Fungsi untuk membuat elemen card Sticky Wall
function createStickyCard(stickyId, title, content) {
    console.log("Creating sticky card...");
    // Membuat elemen card baru
    var newCard = document.createElement('div');
    newCard.classList.add('card-st');
    newCard.setAttribute('data-sticky-id', stickyId); // Atur atribut data-sticky-id dengan nilai id
    newCard.setAttribute('data-title', title); // Tambahkan atribut data-title
    newCard.setAttribute('data-content', content); // Tambahkan atribut data-content

    // Menambahkan card-header ke dalam card-st
    var cardHeader = document.createElement('div');
    cardHeader.classList.add('card-header');
    cardHeader.innerHTML = `
        <h3>${title}</h3>
    `;
    newCard.appendChild(cardHeader);

    // Menambahkan card-content ke dalam card-st
    var cardContent = document.createElement('div');
    cardContent.classList.add('card-content');
    cardContent.innerHTML = content;
    newCard.appendChild(cardContent);

    // Menetapkan warna latar belakang dari palet warna secara acak
    setRandomBackgroundColor(newCard);
    // Menambahkan event listener untuk menampilkan modal edit saat card sticky diklik
    newCard.addEventListener('click', function() {
        console.log("Sticky card clicked...");
        // Ambil data dari card sticky yang diklik
        var stickyId = this.getAttribute('data-sticky-id');
        var title = cardHeader.querySelector('h3').textContent; // Menggunakan querySelector pada cardHeader
        var content = cardContent.innerHTML;
        // Panggil fungsi untuk membuka modal edit sticky dengan data yang sesuai
        openEditModalStickyWall(stickyId, title, content);
    });
    // Menambahkan card baru ke dalam container card-sticky
    document.querySelector('.card-sticky').appendChild(newCard);
}



// Fungsi untuk mengambil data sticky dari server
function getStickyData() {
    console.log("Fetching sticky data...");
    fetch('proses_sticky.php')
    .then(response => response.json())
    .then(data => {
        console.log("Sticky data fetched successfully:", data); // Tampilkan data dalam konsol
        // Loop through data and create card for each sticky note
        data.forEach(sticky => {
            var stickyId = sticky.id_sticky;
            var title = sticky.judul;
            var content = sticky.konten;
            createStickyCard(stickyId, title, content);
        });
    })
    .catch(error => {
        console.error('Error fetching sticky data:', error);
    });
}

function setRandomBackgroundColor(element) {
    // Daftar warna yang belum digunakan
    let remainingColors = ['#BDA3ED', '#EADDFF', '#E4F2FD', '#F3EDF7', '#E086FF'];

    // Jika tidak ada warna yang tersisa, reset daftar warna
    if (remainingColors.length === 0) {
        remainingColors = ['#BDA3ED', '#EADDFF', '#E4F2FD', '#F3EDF7', '#E086FF'];
    }

    // Pilih warna secara acak dari daftar warna yang belum digunakan
    const randomIndex = Math.floor(Math.random() * remainingColors.length);
    const randomColor = remainingColors[randomIndex];

    // Terapkan warna ke elemen
    element.style.backgroundColor = randomColor;

    // Hapus warna yang telah digunakan dari daftar
    remainingColors.splice(randomIndex, 1);
}

//button delete pada edit sticky
document.getElementById('delBtnEdit').addEventListener('click', function() {
    var confirmDelete = confirm("Are you sure you want to delete this sticky note?");
    if (confirmDelete) {
        document.getElementById('delete_sticky').value = 1; // Set the value of hidden input to indicate delete action
        document.getElementById('modal-edit-sticky').querySelector('form').submit(); // Submit the form
    }
});

