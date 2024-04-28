<?php

include "assets/connection.php";

// Ambil data dari permintaan AJAX
$taskId = $_POST['task_id'];
$status = $_POST['status'];

// Persiapkan untuk memperbarui status_task di database
$updatestatustask = "UPDATE dt_task SET status_task = '$status' WHERE id_task = $taskId";

if ($connection->query($updatestatustask) === TRUE) {
    // Respon jika kueri berhasil dieksekusi
    echo "Task Complated.";

    // Ambil status tugas dari database setelah diperbarui
    $getstatustask = "SELECT status_task FROM dt_task WHERE id_task = $taskId";
    $result = $connection->query($getstatustask);
    $row = $result->fetch_assoc();
    $status_task = $row['status_task'];

    // Kirim status tugas sebagai respons AJAX
    echo $status_task;
} else {
    // Respon jika terjadi kesalahan saat mengeksekusi kueri
    echo "Error: " . $sql . "<br>" . $connection->error;
}

// Tutup koneksi
$connection->close();
?>
