<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$blog_id = $_GET['blog_id'];

include_once './components/connection.php';
$query = "SELECT A.*, B.user_name FROM tbl_blogs AS A LEFT JOIN tbl_users AS B ON A.user_id = B.user_id WHERE blog_id = $blog_id;";

$data = mysqli_query($connection, $query);
$fetchedData = mysqli_fetch_assoc($data);

mysqli_close($connection);

include_once './components/header.php';
?>

<h1 class="text-center text-3xl font-bold mb-6">Post Details</h1>

<div class="flex flex-col md:flex-row justify-center items-start space-y-4 md:space-y-0 md:space-x-6 p-4">
    <div class="flex-shrink-0">
        <img src="../images/blog_images/<?php echo htmlspecialchars($fetchedData['blog_picture']); ?>" class="w-full md:w-80 h-auto rounded-lg shadow-md" alt="Blog Image">
    </div>
    <div class="flex-1">
        <h2 class="text-4xl font-bold mb-4"><?php echo htmlspecialchars($fetchedData['blog_title']); ?></h2>
        <p class="text-lg mb-4"><?php echo nl2br(htmlspecialchars($fetchedData['blog_content'])); ?></p>
        <p class="italic text-gray-600">Posted By: <?php echo htmlspecialchars($fetchedData['user_name']); ?></p>
        <p class="italic text-gray-600">Posted At: <?php echo htmlspecialchars($fetchedData['blog_posted_at']); ?></p>

        <?php if ($_SESSION["user_id"] == $fetchedData["user_id"] || $_SESSION["user_type"] == 1) { ?>
            <div class="flex mt-4 space-x-2">
                <a class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300" href="edit_post.php?blog_id=<?php echo $fetchedData['blog_id']; ?>">Edit</a>
                <a class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300" href="delete_post.php?blog_id=<?php echo $fetchedData['blog_id']; ?>">Delete</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php include_once './components/footer.php'; ?>