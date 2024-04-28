<?php

include "assets/connection.php";

//mulai sesi 
session_start();

//cek sudah login atau belum
if(!isset($_SESSION['id_users'])) {
    echo "Anda belum login";
    exit;
}

if(isset($_POST['bsv_list'])) {
    $warna = $_POST['selectedColor'];
    $nama_list = $_POST['listname'];
    $user_id = $_SESSION['id_users']; //id pengguna diambil dari session

    //persiapan simpan data
    $svlist = mysqli_query($connection, "INSERT INTO list_task (user_id, color_code, name_list)
                                            VALUES('$user_id', '$warna', '$nama_list')");
    

    if($svlist) {
        echo "<script>
                alert('List berhasil ditambahkan');
                document.location='upcoming.php';
              </script>";
    }else {
        echo "<script>
                alert('Maaf gagal menambahkan list');
                document.location='upcoming.php';
        </script>";
    }
}


?>