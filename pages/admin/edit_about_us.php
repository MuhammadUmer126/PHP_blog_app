<?php
session_start();


if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
}


if ($_SESSION["user_type"] != 1) {
    header("Location: ../home.php");
}

?>


<h1>Update About Us Page</h1>


<form action="">
    
</form>