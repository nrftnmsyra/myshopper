<?php
error_reporting(0);
session_start();
    // Get user input
    $email = $_SESSION["email"];

    include 'includes/db.php';

    $stmt1 = $conn->prepare("SELECT * FROM personalshopper WHERE ps_email = ?");
    $stmt1->bind_param("s", $email);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1->num_rows == 1) {
        // Fetch the username
        $row1 = $result1->fetch_assoc();
        $username = $row1['ps_username'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myShopper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <nav class="fixed top-0 z-80 w-full h-24 bg-white border-gray-200 dark:bg-gray-800">
        <div class="mt-4 mb-2.5 flex justify-between items-center mx-auto max-w-screen-xl px-4 py-2">
            <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../customer/assets/logo1.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-bold dark:text-white">myShopper</span><span class="text-sm font-semibold dark:text-gray-300">(Personal Shopper)</span>
            </a>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <div class="px-1 py-3 text-md text-gray-900 font-semibold dark:text-white text-transform: uppercase">
                <?php echo $row1['ps_username']; ?>
                </div>
                <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer" src="<?php echo $row1['ps_img']; ?>" alt="User dropdown">
                <!-- Dropdown menu -->
                <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div><?php echo $row1['ps_username']; ?></div>
                        <div class="font-medium truncate"><?php echo $email; ?></div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                    </li>
                    <li>
                        <a href="logout.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign Out</a>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    </body>
<?php
}

$conn->close();
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>

    <div class="mt-24">

