<?php

include "assets/connection.php";

session_start();
if(!isset($_SESSION['id_users'])) {
    header('location:sign-in.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile PLANIFY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="dashboard">
    <!-- Start Sidebar DONE -->
        <div class="sidebar">
        <!-- Start Menu Button -->
            <div class="menu">
                <div id="menu-button">
                    <input type="checkbox" id="menu-checkbox">
                    <label for="menu-checkbox" id="menu-label">
                        <div id="hamburger"></div>
                    </label>
                </div>
            </div>
        <!-- End Menu Button -->

        <!-- Start Content -->
        <div class="header1">
            <div class="header">TASK</div>
        </div>

        <div class="main">
            <div class="list-item">
                <a href="upcoming.php">
                    <img src="assets/img/double_arrow.svg" alt="" class="icon">
                    <span class="description">Upcoming</span>
                </a>
            </div>
            <div class="list-item">
                <a href="today.php">
                    <img src="assets/img/tv_options_edit_channels.svg" alt="" class="icon">
                    <span class="description">Today</span>
                </a>
            </div>
            <div class="list-item">
                <a href="calendar.php">
                    <img src="assets/img/calendar_month.svg" alt="" class="icon">
                    <span class="description">Calendar</span>
                </a>
            </div>
            <div class="list-item">
                <a href="stickywall.php">
                    <img src="assets/img/note_stack.svg" alt="" class="icon">
                    <span class="description">Sticky Wall</span>
                </a>
            </div>

            <div class="header2">
                <div class="header">LIST</div>
            </div>

            <div class="main">
                <?php 
                    //ambil data
                    $user_id = $_SESSION['id_users'];

                    $listtask = "SELECT * FROM list_task WHERE user_id = $user_id";
                    $hasillist = mysqli_query($connection, $listtask);

                    //menampilkan dalam loop
                    while ($row = mysqli_fetch_array($hasillist)) {
                        echo "<div class='list-item'>";
                        echo "<a href='list.php'>";
                        echo "<div class='icon' style='background-color: " . $row['color_code'] . "; width: 22px; height: 22px; border-radius: 4px;'></div>";
                        echo "<span class='description'>" . $row['name_list'] . "</span>";
                        echo "</a>";
                        echo "</div>";
                    }
                ?>
                <div class="list-item">
                    <a href="#" id="openModalBtn">
                        <img src="assets/img/add.svg" alt="" class="icon">
                        <span class="description">Add List</span>
                    </a>
                </div>
            </div>

            <div class="footer">
                <div class="list-item">
                    <a href="proses_logout.php">
                        <img src="assets/img/logout.svg" alt="" class="icon">
                        <span class="description">Logout</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Content -->
        </div>
    <!-- End Sidebar -->

    <!-- Start Main Content -->
        <div class="main-content">
        <!-- Start Modal List DONE -->
            <div id="modal" class="modal-list">
                <div class="modal-content">
                    <form class="addlistform" action="proses_list.php" METHOD="POST">
                        <h3>Create new list</h3>
                        <div class="input-field">
                            <div class="square"></div>
                            <input type="text" name="listname" id="listname" placeholder="List Name">
                        </div>
                        <div class="color-palette">
                            <div class="color" style="background-color: #6750A4;"></div>
                            <div class="color" style="background-color: #BBDEFB;"></div>
                            <div class="color" style="background-color: #5B18D2;"></div>
                            <div class="color" style="background-color: #FF9167;"></div>
                            <div class="color" style="background-color: #80ED5B;"></div>
                            <div class="color" style="background-color: #663522;"></div>
                            <div class="color" style="background-color: #FF8888;"></div>
                            <div class="color" style="background-color: #E086FF;"></div>
                            <div class="color" style="background-color: #FF05F5;"></div>
                        </div>
                        <input type="hidden" name="selectedColor" id="selectedColorInput">
                        <div class="modal-footer">
                            <span id="closeModalBtn" class="close">Cancel</span>
                            <button id="saveModalBtn" class="save" type="submit" name="bsv_list">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <!-- End Modal -->

         <!-- Start Modal Edit Photo Profile -->
         <div id="photoprofilemodal" class="modal-photo">
                <div class="modal-content2">
                    <div class="card-tittle">
                        Change Profile Picture
                        <button class="close-button" onclick="closeFormPhoto()">
                            <img src="assets/img/close.svg" alt="" class="icon">
                        </button>
                    </div>
                    <div class="card-body">
                        <label for="profileImage">Profile Picture</label>
                        <input type="file" id="profileImage" name="profileImage" accept="image/*">
                    </div> 
                    <button class="save-button2" onclick="">Save</button>
                </div>
            </div>
        <!-- End Modal Edit Photo Profile -->

        <!-- Start Modal Edit Personal -->
            <div id="personalModal" class="modal-personal">
                <div class="modal-content2">
                    <div class="card-tittle">
                        Edit Personal Information 
                            <button class="close-button" onclick="closeForm()">
                                <img src="assets/img/close.svg" alt="" class="icon">
                            </button>
                    </div>
                    <div class="card-body">
                        <label class="label-form" for="editusn">User name</label>
                        <input type="text" id="editusn" name="editusn" class="form-control">
                        <label class="label-form" for="editemail">Email address</label>
                        <input type="text" id="editemail" name="editemail" class="form-control">
                        <label class="label-form" for="editpass">Password</label>
                        <input type="password" id="editpass" name="editpass" class="form-control">
                        <label class="label-form" for="editpass">Password Repeat</label>
                        <input type="password" id="editpassrp" name="editpassrp" class="form-control">
                        <label class="label-form" for="editbio">Bio</label>
                        <input type="text" id="editbio" name="editbio" class="form-control">
                    </div> 
                    <button class="save-button" onclick="">Save</button>
                </div>
            </div>
        <!-- End Modal Edit Personal -->
            
        <!-- Start Modal Edit Address -->
            <div id="addressModal" class="modal-address">
                <div class="modal-content2">
                    <div class="card-tittle">
                        Edit Address 
                        <button class="close-button" onclick="closeFormAddress()">
                            <img src="assets/img/close.svg" alt="" class="icon">
                        </button>
                    </div>
                    <div class="card-body">
                        <label class="label-form" for="editcoun">Country</label>
                        <input type="text" id="editcoun" name="editcoun" class="form-control">
                        <label class="label-form" for="editcity">City/States</label>
                        <input type="text" id="editcity" name="editcity" class="form-control">
                        <label class="label-form" for="editpos">Postal Code</label>
                        <input type="text" id="editpos" name="editpos" class="form-control">
                    </div> 
                    <button class="save-button2" onclick="">Save</button>
                </div>
            </div>
        <!-- End Modal Edit Address -->

        <!-- Start Navbar -->
            <nav class="navbartwo navbar-expand-lg-row">
                    <div class="navbartwo-brand">
                            <span class="tittle">
                                MY PROFILE
                            </span>
                            <span class="items">
                                <img id="notifications" src="assets/img/notifications.svg" alt="">
                                <span><img id="profile" src="assets/img/3d_avatar_12.png" alt=""></span>
                                <span class="name">Rizkillah Yuni Rahmawati</span>
                                <span id="dropdown-container">
                                    <img id="arrow-dropdown" src="assets/img/arrow_drop_down.svg" alt="">
                                    <div id="dropdown-content">
                                        <!-- Dropdown content goes here -->
                                        <a href="#" class="dd-1">
                                            <span><img id="profile" src="assets/img/3d_avatar_12.png" alt=""></span>
                                            <span class="dd-desc">
                                                <h7>Hello,</h7><br>
                                                <h5>Rizkillah Yuni Rahmawati</h5>
                                                <h7>rizzkillahrahmawati@gmail.com</h7>
                                            </span>
                                        </a>
                                        <a href="profile.php" class="dd-2">Change Profile</a>
                                        <a href="proses_logout.php" class="dd-3">Logout</a>
                                    </div>
                                </span>
                    </div>
            </nav>
        <!-- End Navbar -->

        <!-- Start Content -->
            <div class="content">
                <div class="subcontent" id="subcontent">
                <!-- Start Card Profile -->
                    <div class="card-prof">
                        <div class="prof-pict">
                            <img id="profile" src="assets/img/3d_avatar_12.png" alt="">
                        </div>
                        <div class="prof-desc">
                            <span>
                                <table class="table-pr">
                                    <tr>
                                        <td class="td1">Rizzkillah Yuni Rahmawati</td>
                                        <td>UI/UX Designer</td>
                                        <td>rizzkillahrahmawati@gmail.com</td>
                                    </tr>
                                </table>
                            </span>
                            <span>
                                <button class="btn-eprof"><img src="assets/img/border_color.svg" alt="" class="icon"><span>Edit Photo</span></button>
                            </span>
                        </div>
                    </div>
                <!-- End Card Profile -->
                <div class="row-up">
                <!-- Start Card Personal -->
                    <div class="card-prof2">
                        <div class="card-prof-tittle">Personal Information
                            <span><button class="btnperprof"><img src="assets/img/border_color.svg" alt="" class="icon"><span>Edit</span></button></span>
                        </div>
                        <table class="table-pr2">
                            <tbody>
                                <tr>
                                    <th>User name</th>
                                    <td>Rizzkillah Yuni Rahmawati</td>
                                </tr>
                                <tr>
                                    <th>Email addresses</th>
                                    <td>rizzkillahrahmawati@gmail.com</td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td>**********</td>
                                </tr>
                                <tr>
                                    <th>Bio</th>
                                    <td>UI/UX Designer</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- End Card Personal -->
                <!-- Start Card Address -->
                <div class="card-prof3">
                    <div class="card-prof-tittle">Address
                        <span><button class="btn-adprof"><img src="assets/img/border_color.svg" alt="" class="icon"><span>Edit</span></button></span>
                    </div>
                    <table class="table-pr3">
                        <tbody>
                            <tr>
                                <th>Country</th>
                                <td>Indonesian</td>
                            </tr>
                            <tr>
                                <th>City/States</th>
                                <td>Semarang</td>
                            </tr>
                            <tr>
                                <th>Postal Code</th>
                                <td>59567</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- End Card Address -->
                </div>
                </div>             
            </div>

        <!-- End Content -->
        </div>
    <!-- End Main Content -->
    </div>
    <script src="assets/script.js"></script>
    <script src="assets/profile.js"></script>
    <script src="assets/addlist.js"></script>
    
</body>
</html>