<?php
include "assets/connection.php";

//sign-up
if(isset($_POST['bsign-up'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $repeatPassword = $_POST['repeat-pass'];

    // Validasi password
    if ($password !== $repeatPassword) {
        echo "<script>
                alert('Password tidak cocok.');
                document.location='sign-up.php';
              </script>";
        exit(); // Hentikan eksekusi lebih lanjut jika password tidak cocok
    }

    // Hash password
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);


    //cek email
    $cek_email = "SELECT COUNT(*) as jumlah FROM users WHERE email = '$email'";
    $result_email = mysqli_query($connection, $cek_email);
    $cek_dataemail = mysqli_fetch_assoc($result_email);

    if($cek_dataemail['jumlah'] > 0 ) {
        echo "<script>
                alert('Email sudah terdaftar. Silakan gunakan email lain.');
                document.location='sign-up.php';
              </script>";
    } else {
        $daftar = mysqli_query($connection, "INSERT INTO users SET
                                    username = '$username',
                                    email = '$email',
                                    pass = '$hashedPass'");

        if ($daftar) {
            echo "<script>
                    alert('Sign-up berhasil');
                    document.location='sign-in.php';
                  </script>";
        } else {
            echo "<script>
            alert('Sign-up gagal');
            document.location='sign-up.php';
          </script>";
        }
    
    }
}

//sign-in
if(isset($_POST['bsign-in'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  //cari user berdasarkan email
  $cariuser = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($connection, $cariuser);

  //cek apakah users ditemukan 
  if(mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $hashedPass = $user['pass'];

    //verifikasi pass
    if(password_verify($password, $hashedPass)) {
      //jika pass benar, maka buat sesi dan akan dialihkan ke halaman today
      session_start();
      $_SESSION['id_users'] = $user['id_users'];
      header("Location: today.php");
      exit();
    } else {
      //jika pass salah
      echo "<script>
              alert('Maaf kombinasai email dan kata sandi salah.');
              document.location='sign-in.php';      
            </script>";
    }
  } else {
    //jika email tidak ditemukan
    echo "<script>
            alert('Maaf email tidak ditemukan.');
            document.location='sign-in.php';
          </script>";
  }
}
?>
