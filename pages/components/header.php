<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../../../PHP_MORNING/blog_app/public/favicon.png" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>

  <?php

  $title = "";


  if (isset($_SESSION["user_id"]) && $_SESSION["user_type"] == 1) {
    $title = "Admin: ";
  }

  switch (basename($_SERVER["PHP_SELF"])) {
    case "login.php":
      $title .= "Login";
      break;
    case "register.php":
      $title .= "Create Account";
      break;
    case "home.php":
      $title .= "Home Page";
      break;
    case "create_post.php":
      $title .= "Create Post";
      break;
    case "about_us.php":
      $title .= "About Us";
      break;
    case "contact_us.php":
      $title .= "Contact Us";
      break;
    case "read_more.php":
      $title .= "Read More";
      break;
    case "edit_post.php":
      $title .= "Edit post";
      break;
    case "users.php":
      $title .= "All Users";
      break;
    case "show_user_all_posts.php":
      $title .= "All Posts";
      break;
    case "show_contact_us.php":
      $title .= "Contact Us Messages";
      break;
    case "change_logo.php":
      $title .= "Change Logo";
      break;
  }
  ?>

  <title><?php echo $title ?> </title>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userMenuButton = document.getElementById('user-menu-button');
      const userDropdown = document.getElementById('user-dropdown');

      userMenuButton.addEventListener('click', function() {
        userDropdown.classList.toggle('hidden');
      });

      // Close the dropdown when clicking outside of it
      window.addEventListener('click', function(event) {
        if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
          userDropdown.classList.add('hidden');
        }
      });
    });
  </script>
</head>

<body>
  <?php if (isset($_SESSION["user_id"])) {

    $query = "SELECT * FROM tbl_website_logo ORDER BY logo_id DESC LIMIT 1";

    $connection = mysqli_connect("localhost", "root", "", "blog_app");

    $logoData = mysqli_query($connection, $query);

    $fetchedData = mysqli_fetch_assoc($logoData);


    if ($_SESSION["user_type"] == 1) {

  ?>
      <nav class="bg-white border-b border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href="../../../../PHP_MORNING/blog_app/pages/home.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
              <img class="rounded-full w-10" src="../../../../PHP_MORNING/blog_app/images/logos/<?php echo $fetchedData['logo_name'] ?>" alt="">
            </span>
          </a>

          <div class="relative flex items-center md:order-2 space-x-4">
            <p class="">Hello Admin</p>

            <button type="button" class="flex text-sm bg-gray-800 rounded-full p-1 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="../../../../PHP_MORNING/blog_app/images/user_images/<?php echo $_SESSION['user_picture'] ?>" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="absolute right-0 z-50 hidden my-2 w-48 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
              <div class="px-4 py-3">
                <span class="block text-sm text-gray-900 dark:text-white"><?php echo $_SESSION["user_name"] ?></span>
                <span class="block text-sm text-gray-500 truncate dark:text-gray-400"><?php echo $_SESSION["user_email"] ?></span>
              </div>
              <ul class="py-2" aria-labelledby="user-menu-button">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                </li>
                <li>
                  <a href="../../../../PHP_MORNING/blog_app/pages/signout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                </li>
              </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
              </svg>
            </button>
          </div>
          <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/home.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/create_post.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Create Post</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/about_us.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About Us</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/admin/users.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Users</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/admin/show_contact_us.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Show Contact Us</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/admin/change_logo.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Change Logo</a>
              </li>

            </ul>
          </div>
        </div>

      </nav>
    <?php

    } else if ($_SESSION["user_type"] == 0) {
    ?>
      <nav class="bg-white border-b border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href="../../../../PHP_MORNING/blog_app/pages/home.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
              <img class="rounded-full w-10" src="../../../../PHP_MORNING/blog_app/images/logos/<?php echo $fetchedData['logo_name'] ?>" alt="">
            </span>
          </a>
          <div class="relative flex items-center md:order-2 space-x-4">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full p-1 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="../../../../PHP_MORNING/blog_app/images/user_images/<?php echo $_SESSION['user_picture'] ?>" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="absolute right-0 z-50 hidden my-2 w-48 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
              <div class="px-4 py-3">
                <span class="block text-sm text-gray-900 dark:text-white"><?php echo $_SESSION["user_name"] ?></span>
                <span class="block text-sm text-gray-500 truncate dark:text-gray-400"><?php echo $_SESSION["user_email"] ?></span>
              </div>
              <ul class="py-2" aria-labelledby="user-menu-button">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                </li>
                <li>
                  <a href="../../../../PHP_MORNING/blog_app/pages/signout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                </li>
              </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
              </svg>
            </button>
          </div>
          <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/home.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/create_post.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Create Post</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/about_us.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About Us</a>
              </li>
              <li>
                <a href="../../../../PHP_MORNING/blog_app/pages/contact_us.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact Us</a>
              </li>

            </ul>
          </div>
        </div>
      </nav>
    <?php
    }





    ?>



  <?php } ?>