<!-- wajib letak -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myShopper</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo1.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<?php include 'includes/navigation.php'; ?>

<body class="bg-gray-900">
    <div class="p-4 sm:ml-52 bg-gray-900 h-100">
        <!-- wajib letak -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-20">
            <h1 class="text-4xl font-bold mb-4 text-white">Requests</h1>

            <!-- all request -->
            <div
                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-gray-900">
                <div class="">
                    <select id="requestStatusFilter"
                        class="block w-full p-2 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending" selected>Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search-users"
                        class="block p-2 ps-10 text-sm border rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for requests">
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Request ID
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
                        <th scope="col" class="px-6 py-3">
                            To
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
                            $rq_ps_email = $row['rq_ps_email'];
                            ?>
                            <tr data-rq-id="<?php echo $rq_id; ?>" class="border-b bg-gray-800 border-gray-700">
                                <td class="data-status px-6 py-4">
                                    <?php echo $rq_id; ?>
                                </td>
                                <td scope="row" class="flex items-center px-6 py-4 whitespace-nowrap text-white">
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
                                </td>
                                <!-- td yang hilang -->
                                <td class="data-status px-6 py-4">
                                    <div style="display: flex;">
                                        <div class="flex">
                                            <p class="mr-4">
                                                <?php echo $rq_status; ?>
                                            </p>
                                            <a href="#" data-modal-target="up-modal_<?php echo $rq_id; ?>"
                                                data-modal-toggle="up-modal_<?php echo $rq_id; ?>">
                                                <svg class="w-3 h-3 text-gray-100 mt-1 hover:text-blue-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                                                </svg>
                                            </a>
                                        </div>

                                    </div>

                                </td>
                                <?php
                                if ($rq_status == 'accepted' && $pd_id == null) {
                                    ?>
                                    <!-- Modal toggle -->
                                    <td class="pd-status px-6 py-4">
                                        <button data-modal-target="crud-modal_<?php echo $rq_id; ?>"
                                            data-modal-toggle="crud-modal_<?php echo $rq_id; ?>"
                                            class="block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800"
                                            type="button">
                                            + Product
                                        </button>
                                    </td>
                                    <?php
                                } else if ($rq_status == 'accepted' && $pd_id != null) {
                                    ?>
                                        <td class="pd-status px-6 py-4">
                                            <div class="flex items-center">
                                            <?php echo $pd_id; ?>
                                            </div>
                                        </td>
                                    <?php
                                } else if ($rq_status == 'rejected') {
                                    ?>
                                            <td class="pd-status px-6 py-4">
                                                <div class="flex items-center font-italic">
                                                    not assigned yet
                                                </div>
                                            </td>
                                    <?php
                                } else if ($rq_status == 'pending') {
                                    ?>
                                                <td class="pd-status px-6 py-4">
                                                    <div class="flex items-center font-italic">
                                                        not assigned yet
                                                    </div>
                                                </td>
                                    <?php
                                }

                                if ($rq_ps_email == $email) {
                                    ?>
                                    <td class="data-status px-6 py-4">
                                        For You
                                    </td>
                                <?php } else {
                                    ?>
                                    <td class="data-status px-6 py-4">
                                        All Shopper
                                    </td>
                                <?php }
                                ?>
                            </tr>


                            <div id="up-modal_<?php echo $rq_id; ?>" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative rounded-lg shadow bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                            <h3 class="text-lg font-semibold text-white">
                                                Request Status
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                                data-modal-toggle="up-modal_<?php echo $rq_id; ?>">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form action="request_update.php" method="post">
                                                <div class="grid gap-4 mb-4">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-white mt-0">Order
                                                            ID</label>
                                                        <input type="hidden" name="rq_id" value="<?php echo $rq_id; ?>">
                                                        <input type="text" name="rqId" id="name" value="<?php echo $rq_id; ?>"
                                                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                                            disabled>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-white">Status</label>
                                                        <?php if ($rq_status == 'pending') { ?>
                                                            <select name="selectedStatus"
                                                                class="block w-full p-2 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                                <option value="pending" selected>Pending</option>
                                                                <option value="accepted">Accepted</option>
                                                                <option value="rejected">Rejected</option>
                                                            </select>
                                                        <?php } else if ($rq_status == 'accepted') { ?>
                                                                <select name="selectedStatus"
                                                                    class="block w-full p-2 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                                    <option value="pending">Pending</option>
                                                                    <option value="accepted" selected>Accepted</option>
                                                                    <option value="rejected">Rejected</option>
                                                                </select>
                                                        <?php } else if ($rq_status == 'reject') { ?>
                                                                    <select name="selectedStatus"
                                                                        class="block w-full p-2 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                                        <option value="pending">Pending</option>
                                                                        <option value="accepted">Accepted</option>
                                                                        <option value="rejected" selected>Rejected</option>
                                                                    </select>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                                    Done
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main modal -->
                            <div id="crud-modal_<?php echo $rq_id; ?>" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative rounded-lg shadow bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                            <h3 class="text-lg font-semibold text-white">
                                                New Request Product
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                                data-modal-toggle="crud-modal_<?php echo $rq_id; ?>">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form action="request_product.php" method="POST">
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-white">Name</label>
                                                        <input type="text" name="pd_name" id="name"
                                                            value="<?php echo $rq_pd_name; ?>"
                                                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                                            placeholder="Type product name" disabled>
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="price"
                                                            class="block mb-2 text-sm font-medium text-white">Price</label>
                                                        <input type="text" name="pd_price" id="price"
                                                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                                            placeholder="299.99" required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="price"
                                                            class="block mb-2 text-sm font-medium text-white">Quantity</label>
                                                        <input type="number" name="pd_quantity" id="price"
                                                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                                            placeholder="0" required="">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="description"
                                                            class="block mb-2 text-sm font-medium text-white">Product
                                                            Description</label>
                                                        <textarea id="description" name="pd_description" rows="4"
                                                            class="block p-2.5 w-full text-sm rounded-lg border bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                                            placeholder="Write product description here"></textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="rqId" value="<?php echo $rq_id; ?>">
                                                <input type="hidden" name="pd_ps_email" value="<?php echo $email; ?>">
                                                <input type="hidden" name="pd_img" value="<?php echo $rq_img; ?>">
                                                <button type="hidden"
                                                    class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
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
                            </div>

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
                                function toggleModal(modalId) {
                                    var modal = document.getElementById(modalId);
                                    modal.classList.toggle('hidden');
                                    modal.setAttribute('aria-hidden', modal.classList.contains('hidden'));
                                }
                            </script>
                            <!-- Separate script for the input filter -->
                            <!-- Separate script for the input filter -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    // Add an event listener to the search input
                                    var searchInput = document.getElementById('table-search-users');
                                    searchInput.addEventListener('input', filterTableBySearch);

                                    // Function to filter table rows based on the search input
                                    function filterTableBySearch() {
                                        var searchQuery = searchInput.value.trim().toLowerCase();

                                        // Get all rows in the table
                                        var rows = document.querySelectorAll('tr[data-rq-id]');

                                        // Loop through each row and hide/show based on the search input
                                        rows.forEach(function (row) {
                                            var productCell = row.querySelector('.pd-status');
                                            var rowText = productCell ? productCell.textContent.trim().toLowerCase() : '';

                                            var isSearchMatch = !searchQuery || rowText.includes(searchQuery);

                                            if (isSearchMatch) {
                                                row.style.display = 'table-row'; // Show the row
                                            } else {
                                                row.style.display = 'none'; // Hide the row
                                                var noReviewRow = document.getElementById('noReviewRow');
                                                noReviewRow.style.display = Array.from(rows).every(row => row.style.display === 'none') ? 'table-row' : 'none';
                                            }
                                        });

                                    }
                                });
                            </script>

                            <script>
                                // JavaScript to handle modal functionality for each row
                                document.getElementById('openModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                                    document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.remove('hidden');
                                });

                                document.getElementById('closeModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                                    document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.add('hidden');
                                });
                            </script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    // Set the default value to 'pending'
                                    var selectElement = document.getElementById('requestStatusFilter');
                                    selectElement.value = 'pending';

                                    // Trigger the filtering function
                                    filterTableRows();

                                    // Add an event listener to the select element
                                    selectElement.addEventListener('change', filterTableRows);

                                    // Function to filter table rows based on the selected status
                                    function filterTableRows() {
                                        var selectedStatus = selectElement.value;

                                        // Get all rows in the table
                                        var rows = document.querySelectorAll('tr[data-rq-id]');

                                        // Flag to check if any row matches the selected status
                                        var hasMatchingRows = false;

                                        // Loop through each row and hide/show based on the selected status
                                        rows.forEach(function (row) {
                                            var statusCell = row.querySelector('.data-status p');
                                            if (statusCell && statusCell.textContent.trim() === selectedStatus) {
                                                row.style.display = 'table-row'; // Show the row
                                                hasMatchingRows = true;
                                            } else {
                                                row.style.display = 'none'; // Hide the row
                                            }
                                        });
                                    }
                                });
                            </script>




                            <?php
                        }
                    } else {
                        echo "<tbody>";
                        echo "<tr class='border-b bg-gray-800 border-gray-700 hover:bg-gray-900'>";
                        echo "<td colspan='4' class='px-6 py-4 text-center'>No Request Found</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    ?>
                </tbody>
                <tr id='noReviewRow' class='border-b bg-gray-800 border-gray-700 hover:bg-gray-900'
                    style='display: none;'>
                    <td colspan='5' class='px-6 py-4 text-center'>No Request Found</td>
                </tr>
            </table>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('table-search-users');
        var noReviewRow = document.getElementById('noReviewRow');
        var selectElement = document.getElementById('requestStatusFilter');

        // Add an input event listener to the search input
        searchInput.addEventListener('input', function () {
            filterTableRows();
        });

        // Add an event listener to the select element
        selectElement.addEventListener('change', function () {
            filterTableRows();
        });

        // Trigger the filtering function when the page loads
        filterTableRows();

        function filterTableRows() {
            var searchQuery = searchInput.value.toLowerCase();
            var selectedStatus = selectElement.value.toLowerCase();
            var rows = document.querySelectorAll('#requestTableBody tr[data-rq-id]');

            var found = false;

            // Loop through each row and hide/show based on the search query and selected status
            rows.forEach(function (row) {
                var rowDataCells = row.querySelectorAll('td');
                var isMatch = false;

                rowDataCells.forEach(function (cell) {
                    var cellText = cell.textContent.trim().toLowerCase();
                    if (cellText.includes(searchQuery) && (selectedStatus === 'all' || cellText === selectedStatus)) {
                        isMatch = true;
                        found = true;
                    }
                });

                if (isMatch) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });

            // Show or hide the noReviewRow based on whether any rows were found
            noReviewRow.style.display = found ? 'none' : 'table-row';
        }
    });
</script>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>
<!-- wajib letak -->
</div>

</html>