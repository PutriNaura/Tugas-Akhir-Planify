<?
include "assets/connection.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Planify</title>

    <!--Fonts Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    -->

    <!--Css-->
    <link rel="stylesheet" href="assets/stylelogin.css">
</head>
<body>
    <div class="split-screen">
        <div class="left">
            <section class="login-icon">
                <img src="assets/img/logo planifyy.svg" class="image" alt="ilustrasi" />
            </section>
        </div>
        <div class="right">
            <section class="forms-signup">
                <form method="POST" action="proses_masuk.php">
                    <h2 class="title">SIGN UP</h2>
                    <div class="login-field">
                        <input type="text" name="username" placeholder="Masukan username" id="username" required> 
                    </div>
                    <div class="login-field">
                        <input type="email" name="email" placeholder="Masukan email" id="email" required> 
                    </div>
                    <div class="login-field">
                        <input type="password" name="pass" placeholder="Masukan password" id="pass" required>
                    </div>
                    <div class="login-field">
                        <input type="password" name="repeat-pass" id="repeat-pass" placeholder="Repeat password" required>
                    </div>
                    <div>
                        <button type="submit" class="btn" name="bsign-up" id="sign-up" value="sign-up">
                            <a class="card-link">
                                Sign Up
                            </a>
                        </button>
                    </div>
                </form>
                <h3 class="sign-in">Already have an account? <a href="sign-in.php">Sign in</a></h3>
            </section>
        </div>
    </div>
</body>

<script>
    var password = document.getElementById("password");
    var repeatPassword = document.getElementById("repeat-password");

    //memeriksa kesamaan password
    repeatPassword.addEventListener("input", function() {
        if(password.value !== repeatPassword.value) {
            repeatPassword.setCustomValidity("Maaf password tidak sesuai");
        } else {
            repeatPassword.setCustomValidity("");
        }
    });
</script>

</html>