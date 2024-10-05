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

$query = "DELETE FROM tbl_blogs WHERE user_id = $user_id";
if (mysqli_query($connection, $query)) {
    header("Location: users.php?msg=deletedAllSuccess");
    mysqli_close($connection);
} else {
    mysqli_close($connection);
    header("Location: users.php?err=unableToDeletePost");
}
