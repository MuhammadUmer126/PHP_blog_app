<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

if (isset($_POST["blog_title"])) {
    include './components/connection.php';
    $blog_id = $_POST["blog_id"];
    $blog_title = $_POST["blog_title"];
    $blog_content = $_POST["blog_content"];
    $blog_picture_name = $_FILES["blog_picture"]["name"];
    $blog_picture_tmp_name = $_FILES["blog_picture"]["tmp_name"];

    move_uploaded_file($blog_picture_tmp_name, "../images/blog_images/" . $blog_picture_name);

    $query = "UPDATE tbl_blogs SET blog_title='$blog_title', blog_content='$blog_content', blog_picture='$blog_picture_name' WHERE blog_id = $blog_id;";

    if (mysqli_query($connection, $query)) {
        mysqli_close($connection);
        header("Location: ./home.php");
    } else {
        mysqli_close($connection);
        echo "<h1 class='text-red-600 text-center'>Error While Updating the Post</h1>";
    }
} else {
    $blog_id = $_GET["blog_id"];
    include './components/connection.php';
    $query = "SELECT * FROM tbl_blogs WHERE blog_id = $blog_id";
    $data = mysqli_query($connection, $query);
    $fetchedData = mysqli_fetch_assoc($data);
    mysqli_close($connection);
}

include './components/header.php';
?>

<h1 class="text-center text-3xl font-bold mt-8">Update Post</h1>

<form class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-md mt-4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="blog_id" value="<?php echo $fetchedData['blog_id']; ?>" required>
    
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="blog_title">Title</label>
        <input id="blog_title" type="text" name="blog_title" value="<?php echo htmlspecialchars($fetchedData['blog_title']); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter title" required>
    </div>
    
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="blog_content">Description</label>
        <textarea id="blog_content" name="blog_content" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter description" required><?php echo htmlspecialchars($fetchedData['blog_content']); ?></textarea>
    </div>
    
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="blog_picture">Picture</label>
        <input id="blog_picture" type="file" name="blog_picture" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    
    <div>
        <input type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5" value="Update Post">
    </div>
</form>

<?php include './components/footer.php'; ?>
