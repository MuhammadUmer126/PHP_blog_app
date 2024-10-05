<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
}

if ($_SESSION["user_type"] != 1) {
    header("Location: ../home.php");
}


include '../components/header.php';


include '../components/connection.php';


$limit = 4;


$paginationQuery = "SELECT user_id FROM tbl_users;";

$paginationData = mysqli_query($connection, $paginationQuery);

$noOfRows = mysqli_num_rows($paginationData);

$noOfPages = ceil($noOfRows / $limit);



$pageNo = 1;

if (isset($_GET["pageNo"])) {
    $pageNo = $_GET["pageNo"];
}

$offset = ($pageNo - 1) * $limit;

$query = "SELECT * FROM tbl_users ORDER BY user_id DESC LIMIT $offset ,  $limit";

$data = mysqli_query($connection, $query);
?>


<?php

if (isset($_GET["err"]) && $_GET["err"] == "userHasPosts") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Delete Failed </span>User Has Posts .
    </div>
<?php
} else if (isset($_GET["err"]) && $_GET["err"] == "unableToDeleteUser") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Delete Failed </span>Unable To Delete User .
    </div>
<?php
} else if (isset($_GET["msg"]) && $_GET["msg"] == "deletedSuccess") {
?>
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Success</span>User Successfully Deleted .
    </div>
<?php
} else if (isset($_GET["msg"]) && $_GET["msg"] == "deletedAllSuccess") {

?>
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Success</span>All Posts Successfully Deleted .
    </div>

<?php
} else if (isset($_GET["msg"]) && $_GET["msg"] == "accountActivated") {
?>
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Success</span>Account Activated .
    </div>
<?


} else if (isset($_GET["msg"]) && $_GET["msg"] == "accountDeactivated") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Success </span>Account Deactivated .
    </div>
<?php
}

?>
<div>
    <h1 class="text-4xl font-bold text-center mt-4">Users</h1>
    <div class="mx-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            User Id
                        </th>
                        <th scope="col" class="px-2 py-3">
                            User Name
                        </th>
                        <th scope="col" class="px-2 py-3">
                            User Email
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Profile Picture
                        </th>
                        <th scope="col" class="px-2 py-3">
                            <span class="sr-only">Show Posts</span>
                        </th>
                        <th scope="col" class="px-2 py-3">
                            <span class="sr-only">delete</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $row["user_id"] ?>
                            </th>
                            <td class="px-2 py-4">
                                <?php echo $row["user_name"] ?>
                            </td>
                            <td class="px-2 py-4">
                                <?php echo $row["user_email"] ?>
                            </td>
                            <td class="px-2 py-4 ">
                                <img class="w-16 rounded-lg" src="../../images/user_images/<?php echo $row["user_profile_picture"] ?>" alt="">

                            </td>
                            <td class="px-2 py-4 text-right">
                                <a href="./show_user_all_posts.php?user_id=<?php echo $row["user_id"] ?>" class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 duration-300">All Posts</a>
                            </td>
                            <td class="px-2 py-4 text-right">
                                <a href="./delete_all_posts.php?user_id=<?php echo $row["user_id"] ?>" class="bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-800 duration-300">Delete All Posts</a>
                            </td>



                            <?php

                            if ($row["user_id"] !== $_SESSION["user_id"]) {
                            ?>

                                <td class="px-2 py-4 text-right">
                                    <a href="./change_status.php?user_id=<?php echo $row["user_id"] ?>" class="bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-800 duration-300">Deactivate</a>
                                </td>

                                <td class="px-2 py-4 text-right">
                                    <a href="./delete_user.php?user_id=<?php echo $row["user_id"] ?>" class="bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-800 duration-300">Delete</a>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }


                    ?>
                </tbody>
            </table>
        </div>


        <nav aria-label="Page navigation example" class="flex justify-center mt-4">
            <ul class="flex items-center -space-x-px h-10 text-base">

                <?php



                for ($i = 1; $i <= $noOfPages; $i++) {
                ?>
                    <li>
                        <a href="users.php?pageNo=<?php echo $i ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?php echo $i ?></a>
                    </li>
                <?php
                }


                ?>

            </ul>
        </nav>

    </div>

</div>