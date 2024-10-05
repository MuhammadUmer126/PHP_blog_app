<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
}

if ($_SESSION["user_type"] != 1) {
    header("Location: ../home.php");
}

$contact_us_id = $_GET["contact_us_id"];

include '../components/connection.php';

$query = "DELETE FROM tbl_contactus WHERE contact_us_id = $contact_us_id";
if (mysqli_query($connection, $query)) {
    header("Location: show_contact_us.php?msg=deletedSuccess");
    mysqli_close($connection);
} else {
    mysqli_close($connection);
    header("Location: show_contact_us.php?err=unableToDeleteContactUs");
}
