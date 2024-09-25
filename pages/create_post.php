<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
?>


<?php
if (isset($_POST["blog_title"])) {
    include './components/connection.php';
    $blog_title = $_POST["blog_title"];
    $blog_content = $_POST["blog_content"];
    $blog_picture_name = $_FILES["blog_picture"]["name"];
    $blog_picture_tmp_name = $_FILES["blog_picture"]["tmp_name"];
    $user_id = $_SESSION['user_id'];


    move_uploaded_file($blog_picture_tmp_name, "../images/blog_images/" . $blog_picture_name);

    $query = "INSERT INTO tbl_blogs (blog_title , blog_content , blog_picture, user_id) VALUES ('$blog_title' , '$blog_content' , '$blog_picture_name' ,$user_id );";

    if (mysqli_query($connection, $query)) {
        mysqli_close($connection);
        header("Location: ./home.php");
    } else {
        mysqli_close($connection);
?>
        <h1>Error While Creating A Post</h1>
<?php
    }
}

include './components/header.php';
?>

<h1 class="text-center text-2xl font-bold">
    Create Post
</h1>

<form class="max-w-sm mx-auto" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">Title</label>
        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="blog_title" placeholder="Title" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">Description</label>
        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="blog_content" placeholder="Description" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">Picture</label>
        <input type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="blog_picture" required>
    </div>
    <div>
        <input type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Create Post">
    </div>
</form>

<?php include './components/footer.php' ?>