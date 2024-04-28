<?php
include "assets/connection.php";

// Mulai sesi PHP
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_users'])) {
    echo "Anda belum login.";
    exit;
}

//tambah data
if(isset($_POST['bsv_sticky'])) {
    $judul = $_POST['titlesticky'];
    $catatan = $_POST['konten'];
    $user_id = $_SESSION['id_users']; //id pengguna diambil dari session

    //persiapan simpan data
    $svsticky = mysqli_query($connection, "INSERT INTO sticky (user_id, judul, konten)
                                            VALUES('$user_id','$judul','$catatan')");

    if($svsticky) {
        echo json_encode(array("message" => "Stickywall berhasil ditambahkan"));
    } else {
        echo json_encode(array("message" => "Gagal menambahkan stickywall"));
    }
}

// Persiapan query untuk mengambil data sticky berdasarkan user_id
$user_id = $_SESSION['id_users']; // Ambil id_users dari session pengguna yang sudah login
$query = "SELECT * FROM sticky WHERE user_id = '$user_id'";
$result = mysqli_query($connection, $query);

// Ubah data menjadi format JSON
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);

?>
