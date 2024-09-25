<?php
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
}

include_once './components/connection.php';
$query = "SELECT A.* , B.user_name  FROM tbl_blogs AS A LEFT JOIN tbl_users AS B  ON A.user_id = B.user_id ORDER BY blog_id DESC;";

$data = mysqli_query($connection, $query);

mysqli_close($connection);

include_once './components/header.php';
?>

<h1 class="text-center text-2xl font-bold">Posts</h1>



<div class="flex justify-between mt-6 flex-wrap">
  <?php

  while ($row = mysqli_fetch_assoc($data)) {
  ?>
    <div class=" mt-4 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <a href="#">
        <img class="rounded-t-lg h-40 w-60" src="../images/blog_images/<?php echo $row["blog_picture"] ?>" alt="" />
      </a>
      <div class="p-5">
        <a href="#">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $row["blog_title"] ?></h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo $row["blog_content"] ?></p>
        <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">By : <?php echo $row["user_name"] ?></p>
        <a href="./read_more.php?blog_id=<?php echo $row['blog_id'] ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Read more
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
    </div>
  <?php
  }

  ?>
</div>






<?php include_once './components/footer.php' ?>