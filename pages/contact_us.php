<?php

session_start();

?>


<?php

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    $query = "INSERT INTO tbl_contactus (userName , userEmail , userMessage ) VALUES ('$name', '$email' , '$message')";



    include './components/connection.php';
    if (mysqli_query($connection, $query)) {
        header("Location: contact_us.php?msg=created");
        mysqli_close($connection);
    } else {

        header("Location: contact_us.php?err=1");
        mysqli_close($connection);
    }
}

?>

<?php

include './components/header.php';
?>



<?php

if (isset($_GET['msg']) && $_GET['msg'] = "created") {
?>
    <div class="p-4 mb-4 text-sm text-black rounded-lg bg-green-300 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Success </span>Thank you for Contacting Us .
    </div>
<?php
} else if (isset($_GET['err']) && $_GET['msg'] = "1") {
?>
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Error </span>Please Try Again.
    </div>
<?php


}

?>
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
    <h1 class="text-3xl font-bold mb-4 text-center">Contact Us</h1>
    <p class="text-gray-700 mb-4 text-center">
        We’d love to hear from you! Please fill out the form below, and we will get back to you as soon as possible.
    </p>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="mt-6">
        <div class="mb-4">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Your Name</label>
            <input type="text" id="name" name="name" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter your name">
        </div>
        <div class="mb-4">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your Email</label>
            <input type="email" id="email" name="email" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter your email">
        </div>
        <div class="mb-4">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your Message</label>
            <textarea id="message" name="message" rows="4" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Write your message"></textarea>
        </div>
        <div>
            <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5">
                Send Message
            </button>
        </div>
    </form>
</div>

<?php include './components/footer.php'; ?>