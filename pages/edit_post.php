<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
?>


<?php
if (isset($_POST["blog_title"])) {
    include './components/connection.php';
    $blog_id = $_POST["blog_id"];
    $blog_title = $_POST["blog_title"];
    $blog_content = $_POST["blog_content"];
    $blog_picture_name = $_FILES["blog_picture"]["name"];
    $blog_picture_tmp_name = $_FILES["blog_picture"]["tmp_name"];

    move_uploaded_file($blog_picture_tmp_name, "../images/blog_images/" . $blog_picture_name);

    $query = "UPDATE tbl_blogs SET blog_title='$blog_title' , blog_content='$blog_content' , blog_picture='$blog_picture_name' WHERE blog_id = $blog_id;";

    if (mysqli_query($connection, $query)) {
        mysqli_close($connection);
        header("Location: ./home.php");
    } else {
        mysqli_close($connection);
?>
        <h1>Error While Creating A Post</h1>
<?php
    }
} else {
    $blog_id = $_GET["blog_id"];

    $query = "SELECT * FROM tbl_blogs WHERE blog_id =  $blog_id";
    include './components/connection.php';
    $data = mysqli_query($connection, $query);

    $fetchedData = mysqli_fetch_assoc($data);

    mysqli_close($connection);
}

include './components/header.php';
?>

<h1 class="text-center text-2xl font-bold">
    Update Post
</h1>

<form class="max-w-sm mx-auto" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
    <input value="<?php echo $fetchedData['blog_id'] ?>" hidden type="text" class="" name="blog_id" required>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">Title</label>
        <input value="<?php echo $fetchedData['blog_title'] ?>" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="blog_title" placeholder="Title" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">Description</label>
        <input value="<?php echo $fetchedData['blog_content'] ?>" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="blog_content" placeholder="Description" required>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="">Picture</label>
        <input type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="blog_picture" required>
    </div>
    <div>
        <input type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Update Post">
    </div>
</form>

<?php include './components/footer.php' ?>