<?php
error_reporting(0);
session_start();
// Get user input
if (!isset($_SESSION['email'])) {
    header("Location: logout.php");
    exit();
}
$email = $_SESSION["email"];

include 'includes/db.php';

?>
<nav class="fixed top-0 z-50 w-full border-b bg-gray-800 border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm rounded-lg sm:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="dashboard.php" class="flex ms-2 md:me-24">
                    <img src="../assets/logo1.png" class="h-8 me-3" alt="FlowBite Logo" />
                    <span
                        class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap text-white mr-2">myShopper</span>
                    <span class="text-sm font-semibold text-gray-300">(Administrator)</span>
                </a>
            </div>
            <div class="relative">
                <div class="flex items-center">
                    <p
                        class="px-1 py-3 text-md font-semibold text-white text-transform uppercase mr-2.5">
                        <?php echo $email; ?>
                    </p>
                    <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="top-start" class="w-10 h-10 rounded-full cursor-pointer"
                        src="../assets/default_pfp.png" alt="User dropdown">
                </div>
                <!-- Dropdown menu -->
                <div id="userDropdown"
                    class="absolute right-0 mt-2 z-10 hidden divide-y rounded-lg shadow w-44 bg-gray-700 divide-gray-600">
                    <div class="px-4 py-3 text-sm text-white">
                        <div class="font-medium truncate">
                            <?php echo $email; ?>
                        </div>
                    </div>
                    <ul class="py-2 text-sm text-gray-200" aria-labelledby="avatarButton">
                        <li>
                            <a href="logout.php"
                                class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Sign
                                Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-52 h-screen pt-20 transition-transform -translate-x-full border-r sm:translate-x-0 bg-gray-800 border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="dashboard.php"
                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                    <svg class="w-5 h-5 transition duration-75 text-gray-400 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="customer.php"
                    class="flex items-center p-2 rounded-lg text-white  hover:bg-gray-700 group">
                    <svg class="w-5 h-5 transition duration-75 text-gray-400 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                        <path
                            d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Customer</span>
                </a>
            </li>
            <li>
                <a href="personal_shopper.php"
                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                    <svg class="w-5 h-5 transition duration-75 text-gray-400 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.824 5.937a1 1 0 0 0 .726-.312 2.042 2.042 0 0 1 2.835-.065 1 1 0 0 0 1.388-1.441 3.994 3.994 0 0 0-5.674.13 1 1 0 0 0 .725 1.688Z" />
                        <path
                            d="M17 7A7 7 0 1 0 3 7a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V7a5 5 0 1 1 10 0v7.083A2.92 2.92 0 0 1 12.083 17H12a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a1.993 1.993 0 0 0 1.722-1h.361a4.92 4.92 0 0 0 4.824-4H17a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Personal Shopper</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<script>
    document.getElementById('avatarButton').addEventListener('click', function () {
        var dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('hidden');
    });
</script>