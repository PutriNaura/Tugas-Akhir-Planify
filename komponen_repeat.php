<?php

//option repeat
    //ambil data option repeat
    $datarep = mysqli_query($connection, "SELECT * FROM repeat_option ORDER BY name_rep");
    while ($row = mysqli_fetch_array($datarep)) {
        echo "<option value='" . $row['name_rep'] . "'>" . $row['name_rep'] . "</option>";
    }

?>
