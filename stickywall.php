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
    <title>Sticky Wall PLANIFY</title>

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
        <!-- Start Modal Add List DONE -->
            <div id="modal-list" class="modal-list">
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
        <!-- End Modal Add List -->
        
        <!-- Start Modal Add Sticky DONE -->
        <div id="modal-sticky" class="modal-sticky" style="display: none;">
            <div class="modal-content2">
                <div class="addst-header">
                    <h3>Add new note</h3>
                    <span id="closeBtnSt" class="close"><img src="assets/img/close.svg" alt="" class="icon"></span>
                </div>
                <form class="form-sticky"  action="proses_sticky.php" method="POST">
                    <label for="titlesticky">Title</label>
                    <input type="text" name="titlesticky" id="titlesticky">
                    <textarea class="editor" contenteditable="true" id="editor" name="konten"></textarea>
                    
                    <div class="modal-footer">
                        <button id="delBtn" class="delete" type="button">Delete</button>
                        <button id="saveBtn" class="save" type="submit" name="bsv_sticky">Save</button>
                    </div>
                </form>
                
            </div>
        </div>
        <!-- End Modal Add Sticky -->

        <!-- Start Modal Edit Sticky -->
        <div id="modal-edit-sticky" class="modal-sticky" style="display: none;">
            <div class="modal-content2">
                <div class="addst-header">
                    <h3>Edit note</h3>
                    <span id="closeBtnEditSt" class="close"><img src="assets/img/close.svg" alt="" class="icon"></span>
                </div>
                <form class="form-sticky"  action="proses_stickyedit.php" method="POST">
                    <input type="hidden" name="sticky_id" id="edit_sticky_id">
                    <label for="titlesticky">Title</label>
                    <input type="text" name="titlesticky" id="edit_titlesticky">
                    <textarea class="editor" contenteditable="true" id="edit_editor" name="konten"></textarea>
                    <div class="modal-footer">
                        <button id="delBtnEdit" class="delete" type="button">Delete</button>
                        <button id="saveBtnEdit" class="save" type="submit" name="bsv_sticky">Save</button>
                        <input type="hidden" name="delete_sticky" id="delete_sticky" value="0"> <!-- Hidden input for delete action -->
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal Edit Sticky -->



        <!-- Start Navbar -->
            <nav class="navbartwo navbar-expand-lg-row">
                    <div class="navbartwo-brand">
                            <span class="tittle">
                                STICKY WALL
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
                                        <a href="#" class="dd-3">Logout</a>
                                    </div>
                                </span>
                    </div>
            </nav>
        <!-- End Navbar -->

        <!-- Start Content -->
        <div class="content">
            <div class="subcontent" id="subcontent">
                <button class="btn-addst" id="btn-addst"><img src="assets/img/icon.svg" alt="" class="icon"><span>Add New Notes</span></button>
                <div class="card-sticky">
                    
                </div>
            </div>
        </div>
        <!-- End Content -->
            </div>
    <!-- End Main Content -->
    </div>
    <script src="assets/stickywall.js"></script>
    <script src="assets/addlist.js"></script>
    <script src="assets/dropdown.js"></script>
    
</body>
</html>