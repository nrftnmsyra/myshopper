<?php


?>

<!-- wajib letak -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myShopper</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo1.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>

<?php include 'includes/navigation.php'; ?>

<body class="bg-gray-100">
    <div class="p-4 sm:ml-52 relative overflow-x-auto  mt-20 ">
        <!-- wajib letak -->

        <h1 class="text-4xl font-bold mb-4">Personal Shopper Details</h1>

        <div class="bg-gray-800 shadow-md rounded-lg flex flex-col mb-4">
            <!-- Profile Header -->
            <div class=" bg-gray-900 rounded-md p-4">
                <h2 class="text-2xl font-bold text-gray-100">Customer Profile</h2>
            </div>

            <!-- Profile Details -->
            <div class="flex flex-row px-6 py-4">
                <!-- Left Div (Profile Photos) -->
                <div class="flex-none flex flex-col items-center mr-4 ">
                    <img src="../assets/default_pfp.png" alt="Profile Photo 1" class="w-40 h-40 rounded-full mb-2">
                </div>

                <!-- Middle Div (Name, Email, and Phone) -->
                <div class="flex-grow ml-4">
                    <div class="mb-2">
                        <h2 class="text-xl font-semibold text-gray-100">Name:</h2>
                        <p class="text-gray-100">John Doe</p>
                    </div>
                    <div class="mb-2">
                        <h2 class="text-xl font-semibold text-gray-100">Email:</h2>
                        <p class="text-gray-100">john.doe@example.com</p>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-100">Phone:</h2>
                        <p class="text-gray-100">123-456-7890</p>
                    </div>
                </div>

                <!-- Right Div (Username and Address) -->
                <div class="flex-none">
                    <div class="mb-2">
                        <h2 class="text-xl font-semibold text-gray-100">Username:</h2>
                        <p class="text-gray-100">@johndoe</p>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-100">Address:</h2>
                        <p class="text-gray-100">123 Main Street, Cityville, USA</p>
                    </div>
                </div>

            </div>
        </div>




        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 bg-gray-900">
                <label for="table-search" class="sr-only">Search</label>
                <div class="text-2xl text-gray-100 font-bold">
                    Customer Order
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Position
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="../assets/default_pfp.png" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">Neil Sims</div>
                                <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            React Developer
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>


    </div>
</body>
<!-- wajib letak -->
</div>

</html>