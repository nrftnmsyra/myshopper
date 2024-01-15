<?php
error_reporting(0);
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: logout.php");
    exit();
}
// Get user input
$email = $_SESSION['email'];
$password = $_POST["password"];

include 'db.php';

// Select data from the table with the search condition
$selectQueryC = "SELECT COUNT(*) AS cart_count
    FROM cart
    WHERE cart_ct_email = '$email';
    ";
$resultC = $conn->query($selectQueryC);

// Check if there are rows in the result
if ($resultC->num_rows > 0) {
    // Fetch data from each row
    if ($rowC = $resultC->fetch_assoc()) {
        // Process data or store it in an array for later use
        $cart_count = $rowC['cart_count'];
        ?>


        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>myShopper</title>
            <link rel="icon" type="image/x-icon" href="assets/logo1.ico">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
        </head>

        <body class="bg-gray-100">


            <nav class="fixed top-0 z-50 w-full bg-gray-50 dark:bg-gray-700">
                <div class="max-w-screen-xl px-4 py-3 mx-auto">
                    <div class="flex items-center">
                        <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                            <li>
                                <a href="dashboard.php" class="text-gray-900 dark:text-white hover:underline"
                                    aria-current="page">My Account</a>
                            </li>
                            <li>
                                <a class="text-gray-900 dark:text-white">WELCOME &nbsp;
                                    <?php echo $username = $_SESSION['username']; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <nav class="fixed top-10 z-80 w-full bg-white border-gray-200 dark:bg-gray-900">
                <div class="flex justify-between items-center mx-auto max-w-screen-xl px-4 py-2">
                    <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="../customer/assets/logo1.png" class="h-8" alt="Flowbite Logo" />
                        <span class="self-center text-2xl font-bold dark:text-white">myShopper</span>
                    </a>
                    <div class="flex-1 py-2 pl-16">
                        <form action="index.php" method="get" class="m-0" id="search">
                            <label for="default-search"
                                class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="searchInput" name="search" onkeyup="myFunction()"
                                    class="block w-full h-10 p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search things that you wanna lookup..." required>
                            </div>
                        </form>
                    </div>
                    <div class="pl-2 pr-16">
                        <button data-modal-target="request_modal" data-modal-toggle="request_modal"
                            class="block text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700"
                            type="button">
                            Request +
                        </button>
                    </div>
                    <div class="flex items-center space-x-6 rtl:space-x-reverse">
                        <a href="cart.php" class="text-sm text-blue-500 dark:text-blue-500 hover:underline">
                            <button type="button"
                                class="relative inline-flex items-center p-3 text-sm font-medium text-center text-blue-500 bg-gray-900 rounded-lg">
                                <svg class="w-6 h-6 hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                                </svg>
                                <span class="sr-only">Notifications</span>
                                <div
                                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-2 dark:border-gray-900">
                                    <?php echo $cart_count; ?>
                                </div>
                            </button>
                        </a>
                    </div>
                    <div class="ml-10 flex items-center space-x-6 rtl:space-x-reverse">
                        <?php
                        $stmtImg = $conn->prepare("SELECT ct_img, ct_username FROM customer WHERE ct_email = ?");
                        $stmtImg->bind_param("s", $email);
                        $stmtImg->execute();
                        $resultImage = $stmtImg->get_result();

                        if ($resultImage->num_rows == 1) {
                            // Fetch the username
                            $rowImage = $resultImage->fetch_assoc();
                            $img = $rowImage['ct_img'];
                        }
                        ?>
                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                            data-dropdown-placement="bottom-start" class="w-12 h-12 rounded-full cursor-pointer"
                            src="<?php echo $img; ?>" alt="User dropdown">
                        <!-- Dropdown menu -->
                        <div id="userDropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div class="font-medium truncate">
                                    <?php echo $email; ?>
                                </div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                                <li>
                                    <a href="dashboard.php"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                                </li>
                                <li>
                                    <a href="logout.php"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                                        Out</a>
                                </li>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- request modal -->
            <div id="request_modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Shopping Request
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="request_modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-2" action="request_add.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $email = $_SESSION['email']; ?>" name="email">
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What
                                        would you like to buy</label>
                                    <input type="text" name="pd_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Pants, Blouse, etc" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input">Attachment</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="file_input_help" name="files[]" multiple
                                        onchange="displaySelectedFiles(this.files)" id="file_input" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG
                                        or GIF (MAX. 800x400px).</p>
                                </div>
                                <div class="col-span-2">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                        Description</label>
                                    <textarea id="description" name="desc" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write product description here"></textarea>
                                </div>
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Send Shopping Request
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
    }
}
?>
    <script>
        // Get the login button for the authentication modal
        const loginButton = document.querySelector('[data-modal-toggle="authentication-modal"]');
        const modal = document.getElementById('authentication-modal');
        const closeButton = modal.querySelector('[data-modal-hide="authentication-modal"]');

        // Get the button for the request modal
        const requestButton = document.querySelector('[data-modal-toggle="request_modal"]');
        const requestModal = document.getElementById('request_modal');
        const requestCloseButton = requestModal.querySelector('[data-modal-hide="request_modal"]');

        const openAuthenticationModal = () => {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
            // Additional actions for the authentication modal open state
        };

        const closeAuthenticationModal = () => {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            // Additional actions for the authentication modal close state
        };

        const openRequestModal = () => {
            requestModal.classList.remove('hidden');
            requestModal.setAttribute('aria-hidden', 'false');
            // Additional actions for the request modal open state
        };

        const closeRequestModal = () => {
            requestModal.classList.add('hidden');
            requestModal.setAttribute('aria-hidden', 'true');
            // Additional actions for the request modal close state
        };

        loginButton.addEventListener('click', openAuthenticationModal);
        closeButton.addEventListener('click', closeAuthenticationModal);

        requestButton.addEventListener('click', openRequestModal);
        requestCloseButton.addEventListener('click', closeRequestModal);
    </script>

    <script>
        function myFunction() {
            var input, filter, content, items, name, expertise, i, nameTxt, expertiseTxt;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            content = document.getElementById("filteredContent");
            items = content.getElementsByClassName("flex justify-center"); // Adjust the class name

            for (i = 0; i < items.length; i++) {
                name = items[i].querySelector("h5");
                expertise = items[i].querySelector(".text-gray-400"); // Adjust the class name

                nameTxt = name.textContent || name.innerText;
                expertiseTxt = expertise.textContent || expertise.innerText;

                // Adjust the condition based on your needs
                if (
                    nameTxt.toUpperCase().indexOf(filter) > -1 ||
                    expertiseTxt.toUpperCase().indexOf(filter) > -1
                ) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        // Handle form submission
        document.getElementById("searchInput").addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                this.closest("form").submit();
            }
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>

    <div class="mt-28">