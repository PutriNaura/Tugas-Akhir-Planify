<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "db_planify1";

$connection = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($connection));

?>