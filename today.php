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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
        <!-- Start Modal List DONE-->
            <div id="modal" class="modal-list">
                <div class="modal-content">
                    <form class="addlistform" action="today_proseslist.php" METHOD="POST">
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

        <!-- Start Modal Add Today DONE -->
            <div id="addModal" class="modal-today">
                <div class="modal-content2">
                    <div class="card-tittle">
                        Add Task Today 
                            <button class="close-button" onclick="closeForm()">
                                <img src="assets/img/close.svg" alt="" class="icon">
                            </button>
                    </div>
                    <form class="formaddtask" action="today_prosestask.php" METHOD="POST">
                        <div class="card-body">
                            <label class="label-form" for="inputtoday">Input Task</label>
                            <input type="text" id="inputtoday" name="inputtask" class="form-control">
                            <label class="label-form" for="desctoday">Description</label>
                            <input type="text" id="desctoday" name="destask" class="form-control">
                        </div>

                        <div class="row">
                            <label for="listtoday">List</label>
                            <select class="form-select" id="listtoday" name="listtask">
                                <option selected disabled value="">Select option</option>
                                <?php include "komponen_list.php"; ?>
                            </select>
                        </div>
                        <div class="row">
                            <label for="datetoday">Due Date</label>
                            <input type="date" id="datetoday" name="datetask" class="form-control" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <div class="row">
                            <label for="reptoday">Repeat</label>
                            <select class="form-select" id="reptoday" name="reptask">
                                <option selected disabled value="">Select option</option>
                                <?php include "komponen_repeat.php"; ?>
                            </select>
                        </div>

                        <div class="card-subtittle">Subtask</div>
                        <div class="add-card">
                            <button type="button" id="btn-addsubtask2"><img src="assets/img/add.svg" alt="" class="icon"></button>Add new subtask
                        </div>
                        <div class="add-sub" id="subtask-container">
                            <!-- Initial subtask input field -->
                            <div class="sub-card2">
                                <input type="checkbox" name="subcheck" id="subcheck1">
                                <span><input type="text" class="subtask-input" name="subtask1" placeholder="Subtask 1"></span>
                            </div>
                        </div>
                        <button class="submit-button" onclick="submitForm()" name="bsv_addtask">Save Change</button>
                    </form>
                </div>
            </div>
        <!-- End Modal Add Today -->

        <!-- Start Modal Edit -->
            <div id="editModal" class="modal-edit">
                <div class="modal-content2">
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
                        <button id="btn-addsubtask"><img src="assets/img/add.svg" alt="" class="icon"></button>Add new subtask
                    </div>
                    <div class="add-sub">
                        <!-- Initial subtask input field -->
                        <div class="sub-card">
                            <input type="checkbox" name="subcheck" id="subcheck">
                            <span><input type="text" class="subtask-input" placeholder="Subtask"></span>
                        </div>    
                    </div>
                    <button class="del-button" onclick="">Delete</button>
                    <button class="submit-buttonedit" onclick="submitForm()">Save Change</button>
                </div>
            </div>
        <!-- End Modal Edit -->   
        
        <!--Start Modal Hapus-->
        <!--End Modal Hapus-->

        <!-- Start Navbar -->
            <nav class="navbar navbar-expand-lg-row">
                    <div class="navbar-brand">
                            <span class="tittle">
                                <img id="logo" src="assets/img/logo planifyy.svg" alt="" class="d-inline-block align-text-top">
                                TODAY
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

        <!-- Start Content DONE-->
            <div class="content">
                <div class="subcontent" id="subcontent">
                    <button class="buttonadd"><img src="assets/img/icon.svg" alt="" class="icon"><span>Add Task Today</span></button>
                <!-- Start Card -->
                    <div class="card">
                        <table class="custom-table">
                            <tbody>
                                <!-- Start Card -->
                                <div class="card">
                                    <table class="custom-table">
                                        <tbody>
                                        <?php 
                                            //ambil data
                                            $user_id = $_SESSION['id_users'];

                                            $today_task = "SELECT t.id_task, t.user_id, t.input_task, t.des_task, l.color_code, l.name_list, t.tgl, t.rep_option, t.sub_1, t.sub_2, t.sub_3, t.status_task
                                            FROM dt_task t
                                            INNER JOIN list_task l ON t.list_id = l.id_list
                                            WHERE t.user_id = $user_id AND DATE(t.tgl) = CURDATE()";
                                            $result =mysqli_query($connection, $today_task);

                                            // Cek apakah ada data
                                            if (mysqli_num_rows($result) > 0) {
                                            // Loop melalui setiap baris data
                                            while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="check-title">
                                                <input type="checkbox" id="checkbox-task<?php echo $row['id_task']; ?>" class="checkbox-task" data-task_id="<?php echo $row['id_task']; ?>" data-status_task="<?php echo $row['status_task']; ?>" <?php echo ($row['status_task'] === 'completed') ? 'checked' : ''; ?>>
                                                <?php echo $row['input_task']; ?>
                                                    <span class="arrow" onclick="toggleForm()">
                                                        <img src="assets/img/chevron_right.svg" alt="" class="icon">
                                                    </span>
                                                </div>
                                                <div class="desc">
                                                    <span class="date">
                                                        <img src="assets/img/calendar_today.svg" alt="" class="icon"><?php echo $row['tgl']; ?>
                                                    </span>
                                                    <?php
                                                        // Memeriksa keberadaan subtask dan menentukan kelas CSS
                                                        $numSubtasks = 0;
                                                        $subtaskClass = 'subtask hidden'; // Default hidden

                                                        if (!empty($row['sub_1']) || !empty($row['sub_2']) || !empty($row['sub_3'])) {
                                                            // Ada subtask yang terisi
                                                            $numSubtasks = count(array_filter([$row['sub_1'], $row['sub_2'], $row['sub_3']]));
                                                            $subtaskClass = 'subtask';
                                                        }
                                                    ?>
                                                    <span class="<?php echo $subtaskClass; ?>">
                                                        <div class="icon" style="background-color: #BDA3ED; width: 22px; height: 22px; border-radius: 4px;"></div>
                                                        <div><?php echo $numSubtasks; ?> Subtask</div>
                                                    </span>

                                                    <span class="category">
                                                        <div class="icon" style="background-color: <?php echo $row['color_code']; ?>; width: 22px; height: 22px; border-radius: 4px;"></div><?php echo $row['name_list']; ?>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td>No tasks for today.</td></tr>";
                                        }
                                        ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </tbody>
                        </table>
                    </div>
                <!-- End Card -->
                </div>
            </div>

        <!-- End Content -->
        </div>
    <!-- End Main Content -->
    </div>
    <script src="assets/script.js"></script>
    <script src="assets/addlist.js"></script>
    <script src="assets/profile.js"></script>
</body>
</html>