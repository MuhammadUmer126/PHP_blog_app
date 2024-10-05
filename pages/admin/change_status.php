<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
}

if ($_SESSION["user_type"] != 1) {
    header("Location: ../home.php");
}

$user_id = $_GET["user_id"];
$query = "SELECT is_deactivated FROM tbl_users WHERE user_id = $user_id";

include '../components/connection.php';
$data = mysqli_query($connection, $query);

$data = mysqli_fetch_assoc($data);



if ($data["is_deactivated"] == 0) {
    $updateQuery = "UPDATE tbl_users SET is_deactivated = 1 WHERE user_id = $user_id";

    if (mysqli_query($connection, $updateQuery)) {
        header("Location: users.php?msg=accountDeactivated");
    }
} else {
    $updateQuery = "UPDATE tbl_users SET is_deactivated = 0 WHERE user_id = $user_id";


    if (mysqli_query($connection, $updateQuery)) {
        header("Location: users.php?msg=accountActivated");
    }
}
