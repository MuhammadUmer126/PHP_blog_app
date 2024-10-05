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

$query = 'SELECT * FROM tbl_contactus ORDER BY contact_us_id DESC';

$data = mysqli_query($connection, $query);
?>


<?php

if (isset($_GET["msg"]) && $_GET["msg"] == "deletedSuccess") {
?>
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Success</span>User Successfully Deleted .
    </div>
<?php
} else if (isset($_GET["err"]) && $_GET["msg"] == "unableToDeleteContactUs") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Delete Failed </span>Unable To Delete Contact Us Message .
    </div>
<?php

}

?>


<div>
    <h1 class="text-4xl font-bold text-center mt-4">Contact Us Messages</h1>
    <div class="mx-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            S.No
                        </th>
                        <th scope="col" class="px-2 py-3">
                            User Name
                        </th>
                        <th scope="col" class="px-2 py-3">
                            User Email
                        </th>
                        <th scope="col" class="px-2 py-3">
                            User Message
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Contacted At
                        </th>
                        <th scope="col" class="px-2 py-3">
                            <span class="sr-only">Show Posts</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sno = 0;
                    while ($row = mysqli_fetch_assoc($data)) {
                        $sno++;
                    ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                            <td class="px-2 py-4">
                                <?php echo $sno ?>
                            </td>
                            <td class="px-2 py-4">
                                <?php echo $row["userName"] ?>
                            </td>
                            <td class="px-2 py-4">
                                <?php echo $row["userEmail"] ?>
                            </td>
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $row["userMessage"] ?>
                            </th>
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $row["contact_us_date"] ?>
                            </th>

                            <td class="px-2 py-4 text-right">
                                <a href="./delete_contact_us.php?contact_us_id=<?php echo $row["contact_us_id"] ?>" class="bg-red-700 text-white px-4 py-2 rounded-md hover:bg-red-800 duration-300">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }


                    ?>
                </tbody>
            </table>
        </div>

    </div>

</div>