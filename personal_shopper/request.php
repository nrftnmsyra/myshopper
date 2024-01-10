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

<body class="bg-gray-900">
    <div class="p-4 sm:ml-52 bg-gray-900 h-100">
        <!-- wajib letak -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-20">
            <h1 class="text-4xl font-bold mb-4 text-white">Requests</h1>


            <div class="mb-4 border-b border-gray-200 dark:border-gray-700 text-center">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-base" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="flex-grow" role="presentation">
                        <button class="inline-block w-full p-4 border-b-2 rounded-t-lg" id="profile-tab"
                            data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">All Requests</button>
                    </li>
                    <li class="flex-grow" role="presentation">
                        <button
                            class="inline-block w-full p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">For You</button>
                    </li>
                </ul>
            </div>

            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-900 dark:bg-gray-900" id="profile" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <!-- all request -->
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                        <div>
                            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">
                                <span class="sr-only">Action button</span>
                                Action
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownAction"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownActionButton">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                            account</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                        User</a>
                                </div>
                            </div>
                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users"
                                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for requests">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Request Detail
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
                            <?php
                            session_start();
                            $email = $_SESSION['email'];

                            include 'includes/db.php';
                            // Select data from the table
                            $selectQuery = "SELECT * FROM request WHERE rq_ps_email != '$email'";
                            $result = $conn->query($selectQuery);
                            ?>
                            <?php
                            // Check if there are rows in the result
                            if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {

                                    $rq_id = $row['rq_id'];
                                    $rq_pd_name = $row['rq_pd_name'];
                                    $rq_desc = $row['rq_desc'];
                                    $rq_img = $row['rq_img'];
                                    $rq_status = $row['rq_status'];
                                    ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="#" id="openModal_<?php echo $rq_id; ?>"><img class="w-10 h-10 rounded-full"
                                                    src="<?php echo $rq_img; ?>" alt="Jese image"></a>
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">
                                                    <?php echo $rq_pd_name; ?>
                                                </div>
                                                <div class="font-normal text-gray-500">
                                                    <?php echo $rq_desc; ?>
                                                </div>
                                            </div>
                                        </th>
                                        <?php
                                        if ($rq_status == 'waiting') {
                                            ?>
                                            <td class="px-6 py-4">
                                                <select id="underline_select"
                                                    class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                    <option value="waiting" selected>
                                                        <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> waiting
                                                    </option>
                                                    <option value="accepted">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> accepted
                                                    </option>
                                                    <option value="rejected">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                            </td>
                                            <?php
                                        } else if ($rq_status == 'Accepted') {
                                            ?>
                                                <td class="px-6 py-4">
                                                    <select id="underline_select"
                                                        class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                        <option value="accepted" selected>
                                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"> accepted
                                                        </option>
                                                        <option value="rejected">
                                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                        </option>
                                                    </select>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                                </td>
                                            <?php
                                        } else if ($rq_status == 'Rejected') {
                                            ?>
                                                    <td class="px-6 py-4">
                                                        <select id="underline_select"
                                                            class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                            <option value="accepted">
                                                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"> accepted
                                                            </option>
                                                            <option value="rejected" selected>
                                                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <a href="#"
                                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                                    </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <!-- Modal container -->
                                    <div id="imageModal_<?php echo $rq_id; ?>"
                                        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                                        <!-- Modal content -->
                                        <div class="bg-white p-4 rounded-md shadow-md max-w-md w-full mx-auto relative">
                                            <!-- Close button (x icon) -->
                                            <span
                                                class="cursor-pointer absolute top-0.5 right-2 text-gray-800 hover:text-red-500 text-4xl"
                                                id="closeModal_<?php echo $rq_id; ?>">&times;</span>
                                            <!-- Image container -->
                                            <div id="modalContent_<?php echo $rq_id; ?>"><img class="pb-5 rounded-t-lg"
                                                    src="<?php echo $rq_img; ?>" alt="product image" /></div>
                                        </div>
                                    </div>
                                    <script>
                                        // JavaScript to handle modal functionality for each row
                                        document.getElementById('openModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                                            document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.remove('hidden');
                                        });

                                        document.getElementById('closeModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                                            document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.add('hidden');
                                        });
                                    </script>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-900" id="dashboard" role="tabpanel"
                    aria-labelledby="dashboard-tab">
                    <!-- for you request -->
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                        <div>
                            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">
                                <span class="sr-only">Action button</span>
                                Action
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownAction"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownActionButton">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                            account</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                        User</a>
                                </div>
                            </div>
                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users"
                                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for requests">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Request Detail
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
                            <?php
                            session_start();
                            $email = $_SESSION['email'];

                            include 'includes/db.php';
                            // Select data from the table
                            $selectQuery = "SELECT * FROM request WHERE rq_ps_email = '$email'";
                            $result = $conn->query($selectQuery);
                            ?>
                            <?php
                            // Check if there are rows in the result
                            if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {

                                    $rq_id = $row['rq_id'];
                                    $rq_pd_name = $row['rq_pd_name'];
                                    $rq_desc = $row['rq_desc'];
                                    $rq_img = $row['rq_img'];
                                    $rq_status = $row['rq_status'];
                                    ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="#" id="openModal_<?php echo $rq_id; ?>"><img class="w-10 h-10 rounded-full"
                                                    src="<?php echo $rq_img; ?>" alt="Jese image"></a>
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">
                                                    <?php echo $rq_pd_name; ?>
                                                </div>
                                                <div class="font-normal text-gray-500">
                                                    <?php echo $rq_desc; ?>
                                                </div>
                                            </div>
                                        </th>
                                        <?php
                                        if ($rq_status == 'waiting') {
                                            ?>
                                            <td class="px-6 py-4">
                                                <select id="underline_select"
                                                    class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                    <option value="waiting" selected>
                                                        <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> waiting
                                                    </option>
                                                    <option value="accepted">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> accepted
                                                    </option>
                                                    <option value="rejected">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                            </td>
                                            <?php
                                        } else if ($rq_status == 'Accepted') {
                                            ?>
                                                <td class="px-6 py-4">
                                                    <select id="underline_select"
                                                        class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                        <option value="accepted" selected>
                                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"> accepted
                                                        </option>
                                                        <option value="rejected">
                                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                        </option>
                                                    </select>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                                </td>
                                            <?php
                                        } else if ($rq_status == 'Rejected') {
                                            ?>
                                                    <td class="px-6 py-4">
                                                        <select id="underline_select"
                                                            class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                                            <option value="accepted">
                                                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"> accepted
                                                            </option>
                                                            <option value="rejected" selected>
                                                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <a href="#"
                                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                                    </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <!-- Modal container -->
                                    <div id="imageModal_<?php echo $rq_id; ?>"
                                        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                                        <!-- Modal content -->
                                        <div class="bg-white p-4 rounded-md shadow-md max-w-md w-full mx-auto relative">
                                            <!-- Close button (x icon) -->
                                            <span
                                                class="cursor-pointer absolute top-0.5 right-2 text-gray-800 hover:text-red-500 text-4xl"
                                                id="closeModal_<?php echo $rq_id; ?>">&times;</span>
                                            <!-- Image container -->
                                            <div id="modalContent_<?php echo $rq_id; ?>"><img class="pb-5 rounded-t-lg"
                                                    src="<?php echo $rq_img; ?>" alt="product image" /></div>
                                        </div>
                                    </div>
                                    <script>
                                        // JavaScript to handle modal functionality for each row
                                        document.getElementById('openModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                                            document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.remove('hidden');
                                        });

                                        document.getElementById('closeModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                                            document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.add('hidden');
                                        });
                                    </script>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>
<!-- wajib letak -->
</div>

</html>