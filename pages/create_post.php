<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

if (isset($_POST["blog_title"])) {
    include './components/connection.php';
    $blog_title = $_POST["blog_title"];
    $blog_content = $_POST["blog_content"];
    $blog_picture_name = $_FILES["blog_picture"]["name"];
    $blog_picture_tmp_name = $_FILES["blog_picture"]["tmp_name"];
    $user_id = $_SESSION['user_id'];

    // Move the uploaded file
    move_uploaded_file($blog_picture_tmp_name, "../images/blog_images/" . $blog_picture_name);

    $query = "INSERT INTO tbl_blogs (blog_title, blog_content, blog_picture, user_id) VALUES ('$blog_title', '$blog_content', '$blog_picture_name', $user_id);";

    if (mysqli_query($connection, $query)) {
        mysqli_close($connection);
        header("Location: ./home.php");
    } else {
        mysqli_close($connection);
        echo "<h1 class='text-red-600 text-center'>Error While Creating A Post</h1>";
    }
}

include './components/header.php';
?>

<h1 class="text-center text-3xl font-bold mt-8">Create Post</h1>

<form class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md mt-4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="blog_title">Title</label>
        <input type="text" id="blog_title" name="blog_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter title" required>
    </div>
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="blog_content">Description</label>
        <textarea id="blog_content" name="blog_content" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter description" required></textarea>
    </div>
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="blog_picture">Picture</label>
        <input type="file" id="blog_picture" name="blog_picture" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    <div>
        <input type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5" value="Create Post">
    </div>
</form>

<?php include './components/footer.php'; ?>
