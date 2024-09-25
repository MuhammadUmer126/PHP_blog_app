<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$blog_id = $_GET['blog_id'];

include_once './components/connection.php';
$query = "SELECT A.* , B.user_name  FROM tbl_blogs AS A LEFT JOIN tbl_users AS B  ON A.user_id = B.user_id WHERE blog_id = $blog_id ORDER BY blog_id DESC;";

$data = mysqli_query($connection, $query);
$fetchedData = mysqli_fetch_assoc($data);

mysqli_close($connection);

include_once './components/header.php';
?>


<h1 class="text-center text-2xl font-bold mb-2">Post Details</h1>

<div class="flex">
    <div><img src="../images/blog_images/<?php echo $fetchedData['blog_picture'] ?>" class="w-1/2" alt=""></div>
    <div>
        <h1 class="text-3xl font-bold"><?php echo $fetchedData['blog_title'] ?></h1>
        <p class="text-xl"><?php echo $fetchedData['blog_content'] ?></p>
        <p class="italic">Posted By <?php echo $fetchedData['user_name'] ?></p>
        <p class="italic">Posted At <?php echo $fetchedData['blog_posted_at'] ?></p>
        <?php

        if ($_SESSION["user_id"] == $fetchedData["user_id"]) {
        ?>

            <div class="flex mt-2">
                <a class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 duration-300" href="edit_post.php?blog_id=<?php echo $fetchedData['blog_id']?>">Edit</a>
                <a class="mx-2 bg-red-600 text-white py-2 px-6 rounded-lg hover:bg-red-700 duration-300" href="delete_post.php?blog_id=<?php echo $fetchedData['blog_id']?>">Delete</a>
            </div>
        <?php
        }
        ?>
    </div>
</div>