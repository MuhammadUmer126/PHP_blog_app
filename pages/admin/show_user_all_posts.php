<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
}


if ($_SESSION["user_type"] != 1) {
    header("Location: ../home.php");
}


include_once '../components/connection.php';

$user_id =  $_GET["user_id"];
$query = "SELECT A.*, B.user_name FROM tbl_blogs AS A LEFT JOIN tbl_users AS B ON A.user_id = B.user_id WHERE A.user_id = $user_id ORDER BY blog_id DESC;";
$data = mysqli_query($connection, $query);

mysqli_close($connection);
include_once '../components/header.php';
?>

<h1 class="text-center text-4xl font-extrabold my-10 text-gray-900">Posts</h1>

<div class="flex justify-center mt-6 flex-wrap">
    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        <div class="mx-2 my-4 max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
            <a href="#">
                <img class="rounded-t-lg h-40 w-full object-cover" src="../../images/blog_images/<?php echo $row["blog_picture"] ?>" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-200"><?php echo $row["blog_title"] ?></h5>
                </a>
                <p class="mb-3 text-gray-600 line-clamp-3"><?php echo $row["blog_content"] ?></p>
                <p class="mb-3 font-semibold text-gray-700">By: <span class="text-blue-500"><?php echo $row["user_name"] ?></span></p>
                <a href="../read_more.php?blog_id=<?php echo $row['blog_id'] ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors duration-200">
                    Read more
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    <?php } ?>
</div>

<?php include_once '../components/footer.php' ?>