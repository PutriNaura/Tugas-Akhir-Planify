<?php 

include "assets/connection.php";

// Mulai sesi
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_users'])) {
    echo "Anda belum login";
    exit;
}

// ID pengguna yang saat ini masuk
$user_id = $_SESSION['id_users'];

$datalist = mysqli_query($connection, "SELECT * FROM list_task WHERE user_id = $user_id");
// Tampilkan opsi dalam elemen <select>
while ($row = mysqli_fetch_array($datalist)) {
    echo "<option value='" . $row['id_list'] . "'>" . $row['name_list'] . "</option>";
}

?>