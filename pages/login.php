<?php

session_start();
include './components/connection.php';
?>


<?php
if (isset($_POST["user_email"])) {
    $user_email = $_POST["user_email"];
    $user_password = md5($_POST["user_password"]);

    $query = "SELECT * FROM tbl_users WHERE user_email = '$user_email' AND user_password = '$user_password'";

    $data = mysqli_query($connection, $query);
    mysqli_close($connection);
    if (mysqli_num_rows($data) == 1) {
        $fetchedData = mysqli_fetch_assoc($data);
        $_SESSION["user_id"] = $fetchedData["user_id"];
        $_SESSION["user_name"] = $fetchedData["user_name"];
        $_SESSION["user_picture"] = $fetchedData["user_profile_picture"];
        $_SESSION["user_email"] = $fetchedData["user_email"];
        header("Location: home.php");
    } else {
        header("Location: login.php?err=invalidCred");
    }
}

include './components/header.php';
?>



<?php
if (isset($_GET["err"]) && $_GET["err"] == "invalidCred") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Login Failed </span>Invalid User Name Or Password .
    </div>
<?php
}

?>

<h1 class="text-center text-2xl font-bold">
    Login
</h1>

<form class="max-w-sm mx-auto" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">User Email</label>
        <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_email" placeholder="User Email" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">User Password</label>
        <input type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_password" placeholder="User Password" required>
    </div>
    <div>
        <input type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Login">
    </div>
    <span>Dont Have An Account <a class="text-blue-600 underline" href="./register.php">Register</a></span>
</form>

<?php include './components/footer.php' ?>