// Sidebar Toggle
const menu = document.getElementById('menu-label');
const sidebar = document.querySelector('.sidebar');

menu.addEventListener('click', function () {
  sidebar.classList.toggle('hide');
  console.log('Sidebar toggle clicked');
});

// Modal Add Task Today
document.addEventListener("DOMContentLoaded", function () {
    var addButton = document.querySelector(".buttonadd");
    var addTaskForm = document.getElementById("addModal");

    // Add click event listener to the button
    addButton.addEventListener("click", function () {
        // Toggle the visibility of the modal
        addTaskForm.style.display = "block";
    });

    // Add click event listener to close button in the form
    var closeButton = document.querySelector("#addModal .close-button");
    closeButton.addEventListener("click", function () {
        // Close the modal when the close button is clicked
        addTaskForm.style.display = "none";
    });

    // Tambahan: Close the modal if the user clicks outside of it
    window.addEventListener('click', function(event) {
        if (event.target == addTaskForm) {
            addTaskForm.style.display = 'none';
        }
    });
});

// Function to open the edit modal when the arrow is clicked
function openEditModal() {
    var editModal = document.getElementById("editModal");
    editModal.style.display = "block";
}

// Function to close the edit modal
function closeEditModal() {
    var editModal = document.getElementById("editModal");
    editModal.style.display = "none";
}

// Find all elements with class "arrow"
var arrowElements = document.querySelectorAll(".arrow");

// Add click event listener to each arrow element
arrowElements.forEach(function (arrowElement) {
    arrowElement.addEventListener("click", function () {
        // Open the edit modal when the arrow is clicked
        openEditModal();
    });
});

// Add click event listener to close button in the edit modal
var editCloseButton = document.querySelector("#editModal .close-button");
editCloseButton.addEventListener("click", function () {
    // Close the edit modal when the close button is clicked
    closeEditModal();
});

// Tambahan: Close the edit modal if the user clicks outside of it
window.addEventListener('click', function(event) {
    var editModal = document.getElementById("editModal");
    if (event.target == editModal) {
        editModal.style.display = 'none';
    }
});

// Menambahkan Subtask Add
document.getElementById('btn-addsubtask2').addEventListener('click', function() {
    // Mencari jumlah subtask yang sudah ada
    var subtaskCount = document.querySelectorAll('.sub-card2').length;

    // Memeriksa apakah jumlah subtask kurang dari 3 sebelum menambahkan yang baru
    if (subtaskCount < 3) {
        // Membuat elemen input untuk subtask baru
        var newSubtask = document.createElement('div');
        newSubtask.className = 'sub-card2';
        newSubtask.innerHTML = `
            <input type="checkbox" name="subcheck" id="subcheck${subtaskCount + 1}">
            <span><input type="text" class="subtask-input" name="subtask${subtaskCount + 1}" placeholder="Subtask ${subtaskCount + 1}"></span>
        `;

        // Menambahkan input subtask baru ke dalam kontainer subtask
        document.getElementById('subtask-container').appendChild(newSubtask);
    } else {
        // Memberikan peringatan jika sudah mencapai batas maksimal subtask
        alert('Anda hanya dapat menambahkan maksimal 3 subtask.');
    }
});

// Menambahkan Subtask Edit



// Variabel global untuk melacak nomor subtask
var subtaskCounter = 1;

// Fungsi untuk menambahkan subtask baru
function addSubtask() {
    // Membuat elemen input untuk subtask
    var subtaskInput = document.createElement("input");
    subtaskInput.type = "text";
    subtaskInput.name = "subtask[]"; // Memberikan nama dengan array untuk mengirimkan nilai ke server
    subtaskInput.placeholder = "Subtask " + subtaskCounter; // Memberikan placeholder dengan nomor subtask
    subtaskInput.className = "subtask-input"; // Menambahkan kelas CSS jika diperlukan

    // Membuat div untuk mengelompokkan input subtask
    var subtaskDiv = document.createElement("div");
    subtaskDiv.className = "sub-card";
    
    // Menambahkan checkbox jika diperlukan
    var checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.name = "subcheck"; // Anda dapat memberikan nama yang sama untuk semua checkbox subtask jika diperlukan

    // Menambahkan input subtask ke dalam div
    subtaskDiv.appendChild(checkbox);
    subtaskDiv.appendChild(subtaskInput);

    // Menambahkan div subtask ke dalam elemen dengan kelas "add-sub"
    document.querySelector(".add-sub").appendChild(subtaskDiv);

    // Menambahkan 1 ke subtaskCounter untuk memperbarui nomor subtask berikutnya
    subtaskCounter++;
}





// Modal Add List
document.getElementById('openModalBtn').addEventListener('click', function() {
    document.getElementById('modal-list').style.display = 'block';
});

document.getElementById('closeModalBtn').addEventListener('click', function() {
    document.getElementById('modal-list').style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('modal-list')) {
        document.getElementById('modal-list').style.display = 'none';
    }
});


// Color Palete
document.addEventListener('DOMContentLoaded', function() {
    const colorPalette = document.querySelectorAll('.color');
    const square = document.querySelector('.square');

    colorPalette.forEach(color => {
        color.addEventListener('click', function() {
            const selectedColor = this.style.backgroundColor;
            square.style.backgroundColor = selectedColor;
        });
    });

    document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('modal').style.display = 'block';
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('modal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('modal')) {
            document.getElementById('modal').style.display = 'none';
        }
    });
});

//dropdown profil
document.addEventListener('DOMContentLoaded', function () {
    var arrowIcon = document.getElementById('arrow-dropdown');
    var dropdownContent = document.getElementById('dropdown-content');

    arrowIcon.addEventListener('click', function () {
        // Toggle the visibility of the dropdown content
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
    });
});


//update status task
// Ambil semua elemen checkbox yang memiliki class 'checkbox-task'
var checkboxes = document.querySelectorAll('.checkbox-task');

// Loop melalui setiap checkbox
checkboxes.forEach(function (checkbox) {
    // Ambil ID tugas dari atribut data-task_id
    var taskId = checkbox.getAttribute('data-task_id');

    // Ambil status tugas dari atribut data-status_task
    var status = checkbox.getAttribute('data-status_task');

    // Jika status adalah 'completed', centang checkbox
    if (status === 'completed') {
        checkbox.checked = true;
    }

    // Tambahkan event listener untuk setiap checkbox
    checkbox.addEventListener('change', function () {
        // Ambil nilai status_task dari atribut data-status_task
        var newStatus = this.checked ? 'completed' : 'pending';

        // Kirim permintaan AJAX ke server untuk memperbarui status_task di database
        updateTaskStatus(taskId, newStatus);
    });
});

// Fungsi untuk mengirim permintaan AJAX ke server untuk memperbarui status_task di database
function updateTaskStatus(taskId, status) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_status.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Tanggapi berhasil
                console.log('Status task berhasil diperbarui.');
            } else {
                // Tanggapi gagal
                console.error('Gagal memperbarui status task.');
            }
        }
    };
    // Kirim data task ID dan status ke server
    xhr.send('task_id=' + taskId + '&status=' + status);
}

