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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
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
                        <div class="">
                            <select id="requestStatusFilter"
                                class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="pending" selected>Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
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
                                    Product ID
                                </th>
                            </tr>
                        </thead>
                        <tbody id="requestTableBody">
                            <?php
                            session_start();
                            $email = $_SESSION['email'];

                            include 'includes/db.php';
                            // Select data from the table
                            $selectQuery = "SELECT *
                            FROM request
                            LEFT JOIN product ON request.rq_id = product.pd_rq_id
                            WHERE request.rq_ps_email = 'not assigned yet';";
                            $result = $conn->query($selectQuery);
                            ?>
                            <?php
                            // Check if there are rows in the result
                            if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {

                                    $pd_id = $row['pd_id'];
                                    $rq_id = $row['rq_id'];
                                    $rq_ct_email = $row['rq_ct_email'];
                                    $rq_pd_name = $row['rq_pd_name'];
                                    $rq_desc = $row['rq_desc'];
                                    $rq_img = $row['rq_img'];
                                    $rq_status = $row['rq_status'];
                                    ?>
                                    <tr data-rq-id="<?php echo $rq_id; ?>" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                        <!-- td yang hilang -->
                                        <td class="data-status px-6 py-4">
                                        <?php
                                            if ($rq_status == 'accepted' && $pd_id == null) {
                                                ?>
                                                <select id="underline_select_<?php echo $rq_id; ?>"
                                                class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                                onchange="updateStatus('<?php echo $rq_id; ?>')">
                                                <option value="pending" <?php echo ($rq_status == 'pending') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> pending
                                                </option>
                                                <option value="accepted" <?php echo ($rq_status == 'accepted') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> accepted
                                                </option>
                                                <option value="rejected" <?php echo ($rq_status == 'rejected') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                </option>
                                            </select>
                                                <?php
                                            } else if($rq_status == 'accepted' && $pd_id != null) {
                                                ?>
                                                <select id="underline_select_<?php echo $rq_id; ?>"
                                                class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                                onchange="updateStatus('<?php echo $rq_id; ?>')"disabled>
                                                <option value="pending" <?php echo ($rq_status == 'pending') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> pending
                                                </option>
                                                <option value="accepted" <?php echo ($rq_status == 'accepted') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> accepted
                                                </option>
                                                <option value="rejected" <?php echo ($rq_status == 'rejected') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                </option>
                                            </select>
                                            <?php
                                            } else if($rq_status == 'rejected') {
                                                ?>
                                                <select id="underline_select_<?php echo $rq_id; ?>"
                                                class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                                onchange="updateStatus('<?php echo $rq_id; ?>')">
                                                <option value="pending" <?php echo ($rq_status == 'pending') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> pending
                                                </option>
                                                <option value="accepted" <?php echo ($rq_status == 'accepted') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> accepted
                                                </option>
                                                <option value="rejected" <?php echo ($rq_status == 'rejected') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                </option>
                                            </select>
                                            <?php
                                            } else if($rq_status == 'pending') {
                                                ?>
                                                <select id="underline_select_<?php echo $rq_id; ?>"
                                                class="block py-2.5 px-0 max-w-6/12 text-sm text-gray-500 bg-transparent border-0 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                                                onchange="updateStatus('<?php echo $rq_id; ?>')">
                                                <option value="pending" <?php echo ($rq_status == 'pending') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> pending
                                                </option>
                                                <option value="accepted" <?php echo ($rq_status == 'accepted') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> accepted
                                                </option>
                                                <option value="rejected" <?php echo ($rq_status == 'rejected') ? 'selected' : ''; ?>>
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> rejected
                                                </option>
                                            </select>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                            <?php
                                            if ($rq_status == 'accepted' && $pd_id == null) {
                                                ?>
                                                <!-- Modal toggle -->
                                                <td class="pd-status px-6 py-4">
                                                <button data-modal-target="crud-modal_<?php echo $rq_id; ?>"
                                                    data-modal-toggle="crud-modal_<?php echo $rq_id; ?>"
                                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    type="button">
                                                    + Product
                                                </button>
                                                </td>
                                                <?php
                                            } else if($rq_status == 'accepted' && $pd_id != null) {
                                                ?>
                                                <td class="pd-status px-6 py-4">
                                                <div class="flex items-center">
                                                    <?php echo $pd_id; ?>
                                                </div>
                                                </td>
                                            <?php
                                            } else if($rq_status == 'rejected') {
                                                ?>
                                                <td class="pd-status px-6 py-4">
                                                <div class="flex items-center font-italic">
                                                    not assigned yet
                                                </div>
                                                </td>
                                            <?php
                                            } else if($rq_status == 'pending') {
                                                ?>
                                                <td class="pd-status px-6 py-4">
                                                <div class="flex items-center font-italic">
                                                    not assigned yet
                                                </div>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                    </tr>




                                    <!-- Main modal -->
                                    <div id="crud-modal_<?php echo $rq_id; ?>" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        New Request Product
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="crud-modal_<?php echo $rq_id; ?>">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form class="p-8 md:p-5" action="request_product.php" method="POST">
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <div class="col-span-2">
                                                            <label for="name"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                            <input type="text" name="pd_name" id="name" value="<?php echo $rq_pd_name; ?>"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="Type product name" required="">
                                                        </div>
                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="price"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                                            <input type="text" name="pd_price" id="price"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="$2999" required="">
                                                        </div>
                                                        <div class="col-span-2 sm:col-span-1">
                                                            <label for="price"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                                            <input type="number" name="pd_quantity" id="price"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                placeholder="$2999" required="">
                                                        </div>
                                                        <div class="col-span-2">
                                                            <label for="description"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                                                Description</label>
                                                            <textarea id="description" name="pd_description" rows="4"
                                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                placeholder="Write product description here"></textarea>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="rqId" value="<?php echo $rq_id; ?>">
                                                    <input type="hidden" name="pd_ps_email" value="<?php echo $email; ?>">
                                                    <input type="hidden" name="pd_img" value="<?php echo $rq_img; ?>">
                                                    <button type="hidden"
                                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Add new product
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    // Assuming $rq_id is defined and contains the required value
                                    $modalHtml = <<<HTML
                                    <div id="crud-modal_$rq_id" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        New Request Product
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="crud-modal_$rq_id">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form class="p-8 md:p-5" action="request_product.php" method="POST">
                                                    <!-- ... (your form content) ... -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    HTML;
                                    ?>
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
                                    document.addEventListener('DOMContentLoaded', () => {
                                    const requestStatusFilter = document.getElementById('requestStatusFilter');
                                    const tableRows = document.querySelectorAll('tbody tr');

                                    // Function to filter rows based on the selected status
                                    function filterRowsByStatus(selectedStatus) {
                                        tableRows.forEach(row => {
                                            const statusCell = row.querySelector('.data-status select');
                                            const rowStatus = statusCell.value;

                                            if (selectedStatus === 'all' || rowStatus === selectedStatus) {
                                                row.style.display = ''; // Show the row
                                            } else {
                                                row.style.display = 'none'; // Hide the row
                                            }
                                        });
                                    }

                                    // Event listener for the change event on the requestStatusFilter
                                    requestStatusFilter.addEventListener('change', () => {
                                        const selectedStatus = requestStatusFilter.value;
                                        filterRowsByStatus(selectedStatus);
                                    });

                                    var modalHtml = `<?php echo addslashes($modalHtml); ?>`;

                                    // Function to handle status change and update row visibility and content
                                    function handleStatusChange(row, newStatus, pdId) {
                                    const statusCell = row.querySelector('.data-status select');
                                    const pdStatusCell = row.querySelector('.pd-status');

                                    // Update content based on the new status
                                    if (newStatus === 'accepted') {
                                        pdStatusCell.innerHTML = `
                                        <?php
                                        echo $rq_id;
                                         echo '<button id="openModalBtn_'.$rq_id.'" data-modal-target="crud-modal_'.$rq_id.'"
                                            data-modal-toggle="crud-modal_'.$rq_id.'"
                                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            type="button">+ Product</button>'; 
                                            ?>
                                        `;
                                        // Add an event listener to the button to open the modal
document.getElementById("openModalBtn_<?php echo $rq_id; ?>").addEventListener("click", function() {
    var modal = document.getElementById("crud-modal_<?php echo $rq_id; ?>");

    // Check if the modal element exists
    if (modal) {
        // Add code to show the modal, for example, by toggling a class
        modal.classList.add("show"); // You need to define the "show" class in your CSS
    }
});
                                    } else if (newStatus === 'rejected' || newStatus === 'pending') {
                                        pdStatusCell.innerHTML = `<div class="flex items-center font-italic">not assigned yet</div>`;
                                    }

                                    // If the new status is not 'pending', hide the row in the 'pending' view
                                    if (newStatus !== 'pending' && requestStatusFilter.value === 'pending') {
                                        row.style.display = 'none';
                                    } else {
                                        // Show the row for other views
                                        filterRowsByStatus(requestStatusFilter.value);
                                    }
                                }


                                    // Attach event listener to each select element for status change
                                    tableRows.forEach(row => {
                                        const statusCell = row.querySelector('.data-status select');
                                        const pdId = row.dataset.pdId;

                                        statusCell.addEventListener('change', () => {
                                            handleStatusChange(row, statusCell.value, pdId);
                                        });
                                    });
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
                    <!-- all request -->
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                        <div class="">
                            <select id="reqStatusFilter"
                                class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="pending" selected>Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
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
                        <tbody id="requestTableBody">
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
                                        <!-- td yang hilang -->

                                        <td class="px-6 py-4">
                                            <a href="#"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                        </td>
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

                                        // Function to update the status using AJAX
                                        function updateStatus(rqId) {
                                            var selectElement = document.getElementById('underline_select_' + rqId);
                                            var selectedStatus = selectElement.value;

                                            // Send an AJAX request to update the status
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('POST', 'request_update.php', true);
                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                            xhr.onreadystatechange = function () {
                                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                                    if (xhr.status === 200) {
                                                        // Successfully updated status
                                                        console.log('Status updated successfully.');
                                                    } else {
                                                        // Handle error
                                                        console.error('Error updating status:', xhr.statusText);
                                                    }
                                                }
                                            };

                                            // Prepare data to send in the request
                                            var data = 'rqId=' + encodeURIComponent(rqId) + '&selectedStatus=' + encodeURIComponent(selectedStatus);

                                            // Send the request
                                            xhr.send(data);
                                        }

                                        // JavaScript to handle filtering based on request status
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const reqStatusFilter = document.getElementById('reqStatusFilter');
                                            const tableRows = document.querySelectorAll('tbody tr');

                                            // Function to filter rows based on the selected status
                                            function filterRowsByStatus(selectedStatus) {
                                                tableRows.forEach(row => {
                                                    const statusCell = row.querySelector('.data-status select'); // Updated selector to target the select element inside the data-status cell

                                                    if (selectedStatus === 'all' || statusCell.value === selectedStatus) {
                                                        row.style.display = ''; // Show the row
                                                    } else {
                                                        row.style.display = 'none'; // Hide the row
                                                    }
                                                });
                                            }

                                            // Event listener for the change event on the requestStatusFilter
                                            reqStatusFilter.addEventListener('change', () => {
                                                const selectedStatus = reqStatusFilter.value;
                                                filterRowsByStatus(selectedStatus);
                                            });

                                            // Set the default view to show only "Pending" status rows
                                            const defaultStatus = 'pending'; // Change this to the default status you want to show
                                            reqStatusFilter.value = defaultStatus;
                                            filterRowsByStatus(defaultStatus);

                                            // Function to handle status change and update row visibility
                                            function handleStatusChange(row, newStatus) {
                                                const statusCell = row.querySelector('.data-status select');
                                                statusCell.value = newStatus;

                                                // If the new status is not 'pending', hide the row in the 'pending' view
                                                if (newStatus !== 'pending' && reqStatusFilter.value === 'pending') {
                                                    row.style.display = 'none';
                                                } else {
                                                    // Show the row for other views
                                                    filterRowsByStatus(reqStatusFilter.value);
                                                }
                                            }

                                            // Attach event listener to each select element for status change
                                            tableRows.forEach(row => {
                                                const statusCell = row.querySelector('.data-status select');
                                                statusCell.addEventListener('change', () => {
                                                    handleStatusChange(row, statusCell.value);
                                                });
                                            });
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