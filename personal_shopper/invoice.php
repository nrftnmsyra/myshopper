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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</head>

<?php include 'includes/navigation.php'; ?>

<body class="bg-gray-900">
    <div class="p-4 sm:ml-52 bg-gray-900 h-100">
        <!-- wajib letak -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-20">
            <h1 class="text-4xl font-bold mb-4 text-white">Invoice</h1>
            <div
                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                <div class="flex items-center">
                    <div class="relative">
                        <input id="start-date" type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5"
                            placeholder="Select date start">
                    </div>
                    <span class="mx-4 text-white">to</span>
                    <div class="relative">
                        <input name="end" id="end-date" type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5"
                            placeholder="Select date end">

                    </div>
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
                    <input type="text" id="table-search-users"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for invoices">
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Invoice ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Customer Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="invoice-table-body">
                    <?php
                    session_start();
                    $email = $_SESSION['email'];

                    include 'includes/db.php';
                    // Select data from the table
                    $selectQuery = "SELECT invoice.*, orders.*, customer.* FROM invoice JOIN orders ON invoice.iv_ct_email = orders.order_ct_email JOIN customer ON orders.order_ct_email = customer.ct_email WHERE orders.order_ps_email = '$email' GROUP BY invoice.iv_id";
                    $result = $conn->query($selectQuery);
                    ?>
                    <?php
                    // Check if there are rows in the result
                    if ($result->num_rows > 0) {
                        // Fetch data from each row
                        while ($row = $result->fetch_assoc()) {

                            $iv_id = $row['iv_id'];
                            $iv_date = $row['iv_date'];
                            $ct_name = $row['ct_first_name'] . ' ' . $row['ct_last_name'];
                            $order_code = $row['iv_order_code'];
                            ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <?php echo $iv_id; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $iv_date; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $ct_name; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="view_invoice.php?order_code=<?php echo $order_code; ?>"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Invoice</a>
                                </td>
                            </tr>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var startDateInput = document.getElementById('start-date');
                        var endDateInput = document.getElementById('end-date');

                        startDateInput.addEventListener('change', function () {
                            console.log('Start Date Changed:', startDateInput.value);
                            updateTable();
                        });

                        endDateInput.addEventListener('change', function () {
                            console.log('End Date Changed:', endDateInput.value);
                            updateTable();
                        });
                    });

                    function updateTable() {
                        var startDate = document.getElementById("start-date").value;
                        var endDate = document.getElementById("end-date").value;

                        console.log('Start Date:', startDate);
                        console.log('End Date:', endDate);

                        // Check if both dates are present
                        if (startDate !== "" && endDate !== "") {
                            // Convert the input dates to a format compatible with your table (YYYY/MM/DD)
                            var formattedStartDate = formatDate(startDate);
                            var formattedEndDate = formatDate(endDate);

                            // Filter the table rows based on the date range
                            var tableRows = document.querySelectorAll("table tbody tr");

                            tableRows.forEach(function (row) {
                                var rowDate = row.querySelector("td:nth-child(2)").innerText; // Assuming the date is in the second column
                                var formattedRowDate = formatDate(rowDate);

                                if (formattedRowDate >= formattedStartDate && formattedRowDate <= formattedEndDate) {
                                    row.style.display = "";
                                } else {
                                    row.style.display = "none";
                                }
                            });
                        }
                    }

                    // Function to format the date to YYYY/MM/DD
                    function formatDate(inputDate) {
                        var date = new Date(inputDate);
                        var year = date.getFullYear();
                        var month = ('0' + (date.getMonth() + 1)).slice(-2);
                        var day = ('0' + date.getDate()).slice(-2);
                        return year + '/' + month + '/' + day;
                    }


                </script>
                <?php
                        }
                    }
                    ?>
        </tbody>
        </table>
    </div>

</body>
<!-- wajib letak -->
</div>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('table-search-users');

        searchInput.addEventListener('input', function () {
            var searchTerm = searchInput.value.toLowerCase();
            var tableRows = document.querySelectorAll("#invoice-table-body tr");

            tableRows.forEach(function (row) {
                // Modify the condition based on the specific columns you want to search
                var rowData = row.innerText.toLowerCase();

                if (rowData.includes(searchTerm)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>