<?php
include "assets/connection.php";

// Mulai sesi PHP
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_users'])) {
    echo "Anda belum login.";
    exit;
}

//update data dan hapus data
// Mengambil data yang dikirimkan melalui metode POST
$sticky_id = $_POST['sticky_id'];
$title = $_POST['titlesticky'];
$content = $_POST['konten'];

// Check if delete action is requested
if(isset($_POST['delete_sticky']) && $_POST['delete_sticky'] == 1) {
    // Perform delete operation
    $sticky_delete = "DELETE FROM sticky WHERE id_sticky='$sticky_id'";
    if ($connection->query($sticky_delete) === TRUE) {
        echo "<script>alert('Deleted successfully'); document.location.href = 'stickywall.php';</script>";
    } else {
        echo "<script>alert('Error deleting: ".$connection->error."'); document.location.href = 'stickywall.php';</script>";
    }
} else {
    // Perform update operation
    $sticky_update = "UPDATE sticky SET judul='$title', konten='$content' WHERE id_sticky='$sticky_id'";
    if ($connection->query($sticky_update) === TRUE) {
        echo "<script>alert('Updated successfully'); document.location.href = 'stickywall.php';</script>";
    } else {
        echo "<script>alert('Error updating: ".$connection->error."'); document.location.href = 'stickywall.php';</script>";
    }
}

?>
