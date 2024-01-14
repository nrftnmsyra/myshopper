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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>

<?php include 'includes/navigation.php'; ?>

<body class="bg-gray-900">
    <div class="p-4 sm:ml-52 bg-gray-900 h-100">
        <!-- wajib letak -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-20">
            <h1 class="text-4xl font-bold mb-4 text-white">Orders</h1>
            <div
                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                <div class="">
                    <select id="orderStatusFilter"
                        class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all">All Orders</option>
                        <option value="To Pay">To Pay</option>
                        <option value="To Ship">To Ship</option>
                        <option value="To Receive">To Receive</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="orderSearch"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for orders">
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
                            Order ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Customer Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tracking Number
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
                    $selectQuery = "SELECT * FROM orders JOIN product ON orders.order_pd_id = product.pd_id WHERE orders.order_ps_email = '$email' GROUP BY orders.order_code";
                    $result = $conn->query($selectQuery);
                    ?>
                    <?php
                    // Check if there are rows in the result
                    if ($result->num_rows > 0) {
                        // Fetch data from each row
                        while ($row = $result->fetch_assoc()) {

                            $order_id = $row['order_id'];
                            $order_pd_name = $row['order_pd_name'];
                            $order_pd_qty = $row['order_pd_qty'];
                            $order_pd_id = $row['order_pd_id'];
                            $pd_name = $row['pd_name'];
                            $pd_img = $row['pd_img'];
                            $order_code = $row['order_code'];
                            $order_ct_email = $row['order_ct_email'];
                            $order_status = $row['order_status'];
                            $order_date = $row['order_date'];
                            $gantt_chart_task_id = $row['order_code'];
                            $order_tracking = $row['order_tracking_no'];

                            $selectP = "SELECT
        orders.order_code
        FROM
        orders
        JOIN
        payment ON orders.order_payment_id = payment.pt_id
        JOIN
        product ON orders.order_pd_id = product.pd_id
        JOIN
        personalshopper ON product.pd_ps_email = personalshopper.ps_email
        WHERE
        orders.order_code = ? AND orders.order_ps_email = ?";

                            $stmtP = $conn->prepare($selectP);
                            $stmtP->bind_param("ss", $order_code, $email);
                            $stmtP->execute();
                            $resultP = $stmtP->get_result();
                            ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <?php echo $order_id; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <?php echo $order_date; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <?php echo $order_ct_email; ?>
                                    </div>
                                </td>
                                <th scope="row"
                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="#" id="openModal_<?php echo $rq_id; ?>">
                                        <img class="w-10 h-10 rounded-full" src="<?php echo $pd_img; ?>" alt="Jese image">
                                    </a>
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">
                                            <?php echo $pd_name; ?>
                                        </div>
                                        <div class="font-normal text-gray-500 mb-1">Quantity:
                                            <?php echo $order_pd_qty; ?>
                                        </div>
                                        <?php
                                        if ($resultP->num_rows > 1) {
                                            ?>
                                            <div>
                                                <a href="order_details.php?order_code=<?= $order_code ?>"
                                                    class="text-sm text-gray-500 items-center mx-auto">View more product</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </th>

                                <?php
                                if ($order_status == 'To Pay') {
                                    ?>
                                    <td class="status-cell px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div>
                                            <?php echo $order_status; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            Not assigned yet
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                    </td>
                                    <?php
                                } else if ($order_status == 'To Ship') {
                                    ?>
                                        <td class="status-cell px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                            <?php echo $order_status; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <button data-modal-target="crud-modal_<?php echo $order_code; ?>"
                                                    data-modal-toggle="crud-modal_<?php echo $order_code; ?>"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    type="button">
                                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Tracking No.
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                        </td>
                                    <?php
                                } else if ($order_status == 'To Receive') {
                                    ?>
                                            <td class="status-cell px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div>
                                            <?php echo $order_status; ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                            <?php echo $order_tracking; ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                            </td>
                                    <?php
                                } else if ($order_status == 'Completed') {
                                    ?>
                                                <td class="status-cell px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div>
                                            <?php echo $order_status; ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                            <?php echo $order_tracking; ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
                                                </td>
                                    <?php
                                } else if ($order_status == 'Cancelled') {
                                    ?>
                                                    <td class="status-cell px-6 py-4">
                                                        <div class="flex items-center">
                                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                            <?php echo $order_status; ?>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center">
                                                            No Tracking Number
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Action</a>
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

                            <div id="crud-modal_<?php echo $order_code; ?>" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Tracking Number
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="crud-modal_<?php echo $order_code; ?>">
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
                                            <form class="" action="tracking_update.php" method="post">
                                                <div class="grid gap-4 mb-4">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-0">Order
                                                            ID</label>
                                                        <input type="text" name="name" id="name"
                                                            value="<?php echo $order_id; ?>"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            disabled>
                                                        <input type="hidden" name="order_code"
                                                            value="<?php echo $order_code; ?>">
                                                        <input type="text" name="email" value="<?php echo $order_ct_email; ?>">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tracking
                                                            Number</label>
                                                        <input type="text" name="tracking_number" id="name"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Type product name" required="">
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Done
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
                </tbody>
            </table>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script>
            // Function to send email
            function sendEmail(orderCode) {
                // Make an AJAX request to send an email
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "email.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("order_code=" + orderCode);
            }
        </script>
        <script>
            // Add this script after your existing script

            const orderStatusFilter = document.getElementById('orderStatusFilter');
            const tableRows = document.querySelectorAll('tbody tr');

            orderStatusFilter.addEventListener('change', () => {
                const selectedStatus = orderStatusFilter.value;

                tableRows.forEach(row => {
                    const statusCell = row.querySelector('.status-cell'); // Update this selector with the actual class or element that contains order_status

                    if (selectedStatus === 'all' || statusCell.textContent.trim() === selectedStatus) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });
            });
        </script>
        <!-- Add the following script to handle the search functionality -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Get the search input element
                var searchInput = document.getElementById("orderSearch");

                // Add an event listener for the input event
                searchInput.addEventListener("input", function () {
                    // Get the search input value
                    var searchValue = searchInput.value.toLowerCase();

                    // Get all the table rows
                    var rows = document.querySelectorAll("tbody tr");

                    // Iterate through the rows and hide those that don't match the search criteria
                    rows.forEach(function (row) {
                        var orderId = row.querySelector("td:nth-child(2)").innerText.toLowerCase();
                        var date = row.querySelector("td:nth-child(3)").innerText.toLowerCase();
                        var customerEmail = row.querySelector("td:nth-child(4)").innerText.toLowerCase();
                        var productName = row.querySelector("th:nth-child(5)").innerText.toLowerCase();
                        var status = row.querySelector("td:nth-child(6)").innerText.toLowerCase();

                        // Check if any of the row content contains the search value
                        if (
                            orderId.includes(searchValue) ||
                            date.includes(searchValue) ||
                            customerEmail.includes(searchValue) ||
                            productName.includes(searchValue) ||
                            status.includes(searchValue)
                        ) {
                            // If there's a match, display the row
                            row.style.display = "table-row";
                        } else {
                            // If there's no match, hide the row
                            row.style.display = "none";
                        }
                    });
                });
            });
        </script>





</body>
<!-- wajib letak -->
</div>

</html>