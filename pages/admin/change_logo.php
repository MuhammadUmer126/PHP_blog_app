<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
}

if ($_SESSION["user_type"] != 1) {
    header("Location: ../home.php");
}

?>

<?php

if (isset($_FILES["logo"])) {
    $tmp_name = $_FILES["logo"]["tmp_name"];
    $name = $_FILES["logo"]["name"];

    move_uploaded_file($tmp_name, "../../images/logos/" . $name);
    $user_id =  $_SESSION["user_id"];

    $query = "INSERT INTO tbl_website_logo (logo_name , user_id) VALUES ('$name' , $user_id) ";

    include '../components/connection.php';

    if (mysqli_query($connection, $query)) {
        header("Location: change_logo.php?msg=logoChanged");
        mysqli_close($connection);
    } else {
        header("Location: change_logo.php?err=logoChangedErr");
        mysqli_close($connection);
    }
}
?>



<?php
include '../components/header.php';
?>

<?php
if (isset($_GET["msg"]) && $_GET["msg"] == "logoChanged") {
?>
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Succes </span>Logo Changed SuccessFully .
    </div>
<?php
} else if (isset($_GET["err"]) && $_GET["err"] == "logoChangedErr") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Error </span>Some Error Occured In Changing Logo .
    </div>
<?php
}
?>

<h1 class="text-center text-3xl font-bold mt-8">Change Logo</h1>

<form class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md mt-4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="logo">Logo</label>
        <input type="file" id="logo" name="logo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    <div>
        <input type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5" value="Change Logo">
    </div>
</form>