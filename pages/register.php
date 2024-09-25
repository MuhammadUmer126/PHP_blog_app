<?php
include './components/connection.php';
?>

<?php
if (isset($_POST["user_name"])) {
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $user_date_of_birth = $_POST["user_date_of_birth"];
    $user_gender = $_POST["user_gender"];
    $user_password = md5($_POST["user_password"]);
    $user_picture_name = $_FILES["user_picture"]["name"];
    $user_picture_tmp_name = $_FILES["user_picture"]["tmp_name"];



    $queryFindEmail = "SELECT * FROM tbl_users WHERE user_email = '$user_email'";
    $data = mysqli_query($connection, $queryFindEmail);
    if (mysqli_num_rows($data) > 0) {
        header("Location: register.php?err=userAlreadyExists");
    } else {



        move_uploaded_file($user_picture_tmp_name, "../images/user_images/" . $user_picture_name);

        $query = "INSERT INTO tbl_users (user_name , user_email , user_date_of_birth , user_gender ,user_password , user_profile_picture) VALUES ('$user_name' , '$user_email' , '$user_date_of_birth' , '$user_gender' , '$user_password' , '$user_picture_name');";

        if (mysqli_query($connection, $query)) {
            mysqli_close($connection);
            header("Location: ./login.php");
        } else {
            mysqli_close($connection);
?>
            <h1>Error While Creating A Post</h1>
<?php
        }
    }
}

include './components/header.php';
?>


<?php
if (isset($_GET["err"]) && $_GET["err"] == "userAlreadyExists") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Register Failed </span>User With This Email Already Exists .
    </div>
<?php
}

?>

<h1 class="text-center text-2xl font-bold">
    Create Account
</h1>

<form class="max-w-sm mx-auto" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">User Name</label>
        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_name" placeholder="User Name" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">User Email</label>
        <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_email" placeholder="User Email" required>
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">User Date Of Birth</label>
        <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_date_of_birth" placeholder="User Date Of Birth" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">User Date Of Birth</label>
        <select multiple name="user_gender" id="countries_multiple" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose Gender</option>
            <option value="Male">Male</option>
            <option value="FeMale">FeMale</option>
        </select>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">User Password</label>
        <input type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_password" placeholder="User Password" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">Picture</label>
        <input type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user_picture" required>
    </div>
    <div>
        <input type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Create Account">
    </div>
    <span>Already Have An Account <a class="text-blue-600 underline" href="./login.php">Login</a></span>
</form>

<?php include './components/footer.php' ?>