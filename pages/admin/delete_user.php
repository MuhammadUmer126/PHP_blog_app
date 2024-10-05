<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
}

if ($_SESSION["user_type"] != 1) {
    header("Location: ../home.php");
}


$user_id = $_GET["user_id"];

include '../components/connection.php';
$getPostQuery = "SELECT * FROM tbl_blogs WHERE user_id = $user_id";
$data = mysqli_query($connection, $getPostQuery);

if (mysqli_num_rows($data) > 0) {
    header("Location: users.php?err=userHasPosts");
} else {
    $query = "DELETE FROM tbl_users WHERE user_id = $user_id";
    if (mysqli_query($connection, $query)) {
        header("Location: users.php?msg=deletedSuccess");
        mysqli_close($connection);
    } else {
        mysqli_close($connection);
        header("Location: users.php?err=unableToDeleteUser");
    }
}
