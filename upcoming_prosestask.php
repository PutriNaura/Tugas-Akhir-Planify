<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "assets/connection.php";

//memulai sesi
session_start();

if(!isset($_SESSION['id_users'])) {
    echo "Anda belum login";
    exit;
}

if(isset($_POST['bsv_addtask'])) {
    $user_id = $_SESSION['id_users']; //id pengguna diambil dari session
    $input = mysqli_real_escape_string($connection, $_POST['inputtask']);
    $desc = mysqli_real_escape_string($connection, $_POST['destask']);
    $list = mysqli_real_escape_string($connection, $_POST['listtask']);
    $tgl = mysqli_real_escape_string($connection, $_POST['datetask']);
    $repeat = mysqli_real_escape_string($connection, $_POST['reptask']);
    $subtask = array(
        mysqli_real_escape_string($connection, $_POST['subtask1']),
        mysqli_real_escape_string($connection, $_POST['subtask2']),
        mysqli_real_escape_string($connection, $_POST['subtask3'])
    );

    // Inisialisasi array untuk menyimpan subtask
    $subtask = array();

    // Memeriksa setiap subtask, dan jika diisi, menambahkannya ke array
    $subtask = array(); // Inisialisasi array untuk menyimpan subtask
    for ($i = 1; $i <= 3; $i++) {
        if (isset($_POST['subtask' . $i])) { // Periksa apakah input subtask ada dalam $_POST
            $subtask_input = trim($_POST['subtask' . $i]); // Mengambil nilai subtask dari form

            // Memeriksa apakah subtask tidak kosong
            if (!empty($subtask_input)) {
                $subtask[] = mysqli_real_escape_string($connection, $subtask_input);
            }
        }
    }

    $svtask = mysqli_query($connection, "INSERT INTO dt_task (user_id, input_task, des_task, list_id, tgl, rep_option, sub_1, sub_2, sub_3)
                                        VALUES ('$user_id', '$input', '$desc', '$list', '$tgl', '$repeat', '$subtask[0]', '$subtask[1]', '$subtask[2]')");

    
    if($svtask) {
        echo "<script>
                alert('Task berhasil ditambahkan');
                document.location='upcoming.php';
              </script>";
    }else {
        echo "<script>
                alert('Maaf gagal menambahkan task');
                document.location='upcoming.php';
        </script>";
    }
}


?>