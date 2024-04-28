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
    <title>Today PLANIFY</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="dashboard">
    <!-- Start Sidebar DONE-->
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

    <!-- Start Main Content-->
        <div class="main-content">
        <!-- Start Modal List DONE-->
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

        <!-- Start Navbar -->
        <nav class="navbartwo navbar-expand-lg-row">
            <div class="navbartwo-brand">
                    <span class="tittle">
                        WORK
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
                    <button class="buttonnew"><img src="assets/img/icon.svg" alt="" class="icon"><span>Add New Task</span></button>
                <!-- Start Card -->
                    <div class="card">
                        <table class="custom-table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="check-title">
                                            <input type="checkbox" name="" id="" class="checkbox">Research content ideas
                                            <span class="arrow" onclick="toggleForm()">
                                                <img src="assets/img/chevron_right.svg" alt="" class="icon">
                                            </span>
                                        </div>
                                        <div class="desc">
                                            <span class="date2">
                                                <img src="assets/img/calendar_today.svg" alt="" class="icon"> 02-01-2024
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="check-title">
                                            <input type="checkbox" name="" id="" class="checkbox">Create a database of guest authors
                                            <span class="arrow" onclick="toggleForm()">
                                                <img src="assets/img/chevron_right.svg" alt="" class="icon">
                                            </span>
                                        </div>
                                        <div class="desc">
                                            <span class="date2">
                                                <img src="assets/img/calendar_today.svg" alt="" class="icon"> 02-01-2024
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="check-title">
                                            <input type="checkbox" name="" id="" class="checkbox">Create job posting for SEO specialist
                                            <span class="arrow" onclick="toggleForm()">
                                                <img src="assets/img/chevron_right.svg" alt="" class="icon">
                                            </span>
                                        </div>
                                        <div class="desc">
                                            <span class="date2">
                                                <img src="assets/img/calendar_today.svg" alt="" class="icon"> 03-01-2024
                                            </span>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="check-title">
                                            <input type="checkbox" name="" id="" class="checkbox">Request design assets for landing page
                                            <span class="arrow" onclick="toggleForm()">
                                                <img src="assets/img/chevron_right.svg" alt="" class="icon">
                                            </span>
                                        </div>
                                        <div class="desc">
                                            <span class="date2">
                                                <img src="assets/img/calendar_today.svg" alt="" class="icon"> 03-01-2024
                                            </span>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="check-title">
                                            <input type="checkbox" name="" id="" class="checkbox">Prepare collaboration proposals for Sales catchup
                                            <span class="arrow" onclick="toggleForm()">
                                                <img src="assets/img/chevron_right.svg" alt="" class="icon">
                                            </span>
                                        </div>
                                        <div class="desc">
                                            <span class="date2">
                                                <img src="assets/img/calendar_today.svg" alt="" class="icon"> 24-01-2024
                                            </span>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="check-title">
                                            <input type="checkbox" name="" id="" class="checkbox">Adopt a link tracker tool
                                            <span class="arrow" onclick="toggleForm()">
                                                <img src="assets/img/chevron_right.svg" alt="" class="icon">
                                            </span>
                                        </div>
                                        <div class="desc">
                                            <span class="date2">
                                                <img src="assets/img/calendar_today.svg" alt="" class="icon"> 27-01-2024
                                            </span>
                                            <span class="subtask2">
                                                <img src="assets/img/Frame 2.svg" alt="" class="icon"> Subtasks
                                            </span>
                                        </div>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- End Card -->
                </div>

                <!-- Start Form Add -->
                <div class="cardup-add" id="addNewTask">
                    <div class="card-tittle">
                        Add New Task 
                            <button class="close-button" onclick="closeForm()">
                                <img src="assets/img/close.svg" alt="" class="icon">
                            </button>
                    </div>
                    <div class="card-body">
                        <label class="label-form" for="inputnew">Input Task</label>
                        <input type="text" id="inputnew" name="inputnew" class="form-control">
                        <label class="label-form" for="descnew">Description</label>
                        <input type="text" id="descnew" name="descnew" class="form-control">
                    </div>

                    <div class="row">
                        <label for="listnew">List</label>
                        <select class="form-select" id="listnew" name="listnew">
                            <option value="Work">Work</option>
                            <option value="School">School</option>
                            <option value="Personal">Personal</option>
                        </select>
                    </div>
                    <div class="row">
                        <label for="datenew">Due Date</label>
                        <input type="date" id="datenew" name="datenew" class="form-control">
                    </div>
                    <div class="row">
                        <label for="repnew">Repeat</label>
                        <select class="form-select" id="repnew" name="repnew">
                            <option value="Work">Every Day</option>
                            <option value="School">Every Monday</option>
                            <option value="Personal">Every Tuesday</option>
                        </select>
                    </div>

                    <div class="card-subtittle">Subtask</div>
                    <div class="add-card">
                        <img src="assets/img/add.svg" alt="" class="icon">Add new subtask
                    </div>
                    <div class="sub-card">
                        <input type="checkbox" name="subcheck" id="subcheck">Subtask
                    </div>    
                    <button class="del-button" onclick="">Delete</button>
                    <button class="submit-button" onclick="submitForm()">Save Change</button>
                 </div>
                <!-- End Form Add -->

                <!-- Start Form Edit -->
                    <div class="card-edit" id="cardEdit">
                        <div class="card-tittle">
                            Edit Task 
                            <button class="close-button" onclick="closeEditForm()">
                                <img src="assets/img/close.svg" alt="" class="icon">
                            </button>
                        </div>
                        <div class="card-body">
                            <label class="label-form" for="inputtask">Input Task</label>
                            <input type="text" id="inputtask" name="inputtask" class="form-control">
                            <label class="label-form" for="desctask">Description</label>
                            <input type="text" id="desctask" name="desctask" class="form-control">
                        </div>

                        <div class="row">
                            <label for="listtask">List</label>
                            <select class="form-select" id="listtask" name="listtask">
                                <option value="Work">Work</option>
                                <option value="School">School</option>
                                <option value="Personal">Personal</option>
                            </select>
                        </div>
                        <div class="row">
                            <label for="datetask">Due Date</label>
                            <input type="date" id="datetask" name="datetask" class="form-control">
                        </div>
                        <div class="row">
                            <label for="reptask">Repeat</label>
                            <select class="form-select" id="reptask" name="reptask">
                                <option value="Work">Every Day</option>
                                <option value="School">Every Monday</option>
                                <option value="Personal">Every Tuesday</option>
                            </select>
                        </div>

                        <div class="card-subtittle">Subtask</div>
                        <div class="add-card">
                            <img src="assets/img/add.svg" alt="" class="icon">Add new subtask
                        </div>
                        <div class="sub-card">
                            <input type="checkbox" name="subcheck" id="subcheck">Subtask
                        </div>    
                        <button class="del-button" onclick="">Delete</button>
                        <button class="submit-button" onclick="submitForm()">Save Change</button>
                    </div>
                <!-- End Form Edit -->
            </div>

        <!-- End Content -->
        </div>
    <!-- End Main Content -->
    </div>
    <script src="assets/script.js"></script>
    <script src="assets/addlist.js"></script>
</body>
</html>