<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

include_once './components/connection.php';

$blog_id = $_GET["blog_id"];

$query = "DELETE FROM tbl_blogs WHERE blog_id = $blog_id";

if (mysqli_query($connection, $query)) {
    header("Location: home.php");
    mysqli_close($connection);
} else {
    mysqli_close($connection);
?>
    <h1>Error While Deleting A Post</h1>
<?php
}

?>