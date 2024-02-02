<?php
session_start();

include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Select data from the table with the search condition
    $ps_email = $_GET['ps_email'];

    $selectQuery = "SELECT * FROM personalshopper WHERE ps_email = '$ps_email'";
    $result = $conn->query($selectQuery);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Fetch data from each row
        while ($row = $result->fetch_assoc()) {
            // Process data or store it in an array for later use
            $ps_email = $row['ps_email'];
            $ps_username = $row['ps_username'];
            $ps_first_name = $row['ps_first_name'];
            $ps_last_name = $row['ps_last_name'];
            $ps_phnum = $row['ps_phnum'];
            $ps_expertise = $row['ps_expertise'];
            $ps_img = $row['ps_img'];
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
                    <nav class="flex mb-1" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="personal_shopper.php"
                                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    Personal Shopper
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span class="ms-1 text-sm font-medium md:ms-2 text-gray-400">Shopper
                                        Details</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-bold mb-4">Shopper Details</h1>

                    <div class="bg-gray-800 shadow-md rounded-lg flex flex-col mb-6">
                        <!-- Profile Header -->
                        <div class=" bg-gray-900 rounded-md p-4">
                            <h2 class="text-2xl font-bold text-gray-100">Shopper Profile</h2>
                        </div>

                        <!-- Profile Details -->
                        <div class="flex flex-row px-6 py-6">
                            <div class="flex-none flex flex-col items-center mr-4 ">
                                <img src="<?php echo $ps_img; ?>" alt="Profile Photo 1" class="w-40 h-40 rounded-full mb-2">
                            </div>


                            <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                                <tbody>
                                    <tr class="border-b border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white bg-gray-800">
                                            First Name
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo $ps_first_name; ?>
                                        </td>
                                        <td class="px-6 py-4 font-medium whitespace-nowrap text-white bg-gray-800">
                                            Last Name
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $ps_last_name; ?>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white bg-gray-800">
                                            Email
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo $ps_email; ?>
                                        </td>
                                        <td class="px-6 py-4 font-medium whitespace-nowrap text-white bg-gray-800">
                                            Username
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $ps_username; ?>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white bg-gray-800">
                                            Phone Number
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo $ps_phnum; ?>
                                        </td>
                                        <td class="px-6 py-4 font-medium whitespace-nowrap text-white bg-gray-800">
                                            Expertise
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $ps_expertise; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div
                            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 bg-gray-900">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="text-2xl text-gray-100 font-bold">
                                Order History
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search-users" oninput="filterTable()"
                                    class="block p-2 ps-10 text-sm border rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Search for orders">
                            </div>
                        </div>
                        <table id="orders-table" class="w-full text-sm text-left rtl:text-right text-gray-400">
                            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Order Details
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Order Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        View
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                session_start();

                                include 'includes/db.php';

                                // Select data from the table with the search condition
                                $selectQuery2 = "SELECT
                        customer.ct_username,
                        customer.ct_email,
                        product.pd_name,
                        product.pd_img,
                        orders.order_ct_email,
                        orders.order_pd_id,
                        orders.order_id,
                        orders.order_date,
                        orders.order_pd_qty,
                        orders.order_total_price,
                        payment.pt_total_price,
                        payment.pt_time,
                        payment.pt_date,
                        payment.pt_total_price,
                        orders.order_code,
                        orders.order_status
                        FROM
                        orders
                        JOIN
                        payment ON orders.order_payment_id = payment.pt_id
                        JOIN
                        product ON orders.order_pd_id = product.pd_id
                        JOIN
                        customer ON orders.order_ct_email = customer.ct_email
                        WHERE
                        orders.order_ps_email = ?
                        GROUP BY orders.order_code ORDER BY DATE(payment.pt_date) DESC";

                                $stmt = $conn->prepare($selectQuery2);
                                $stmt->bind_param("s", $ps_email);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                // Check if there are rows in the result
                                if ($result->num_rows > 0) {
                                    // Fetch data from each row and group by personal shopper
                                    while ($row = $result->fetch_assoc()) {
                                        $ct_email = $row['ct_email'];
                                        $ct_username = $row['ct_username'];
                                        $order_ct_email = $row['order_ct_email'];
                                        $order_code = $row['order_code'];
                                        $order_pd_id = $row['order_pd_id'];
                                        $order_id = $row['order_id'];
                                        $order_date = $row['order_date'];
                                        $pd_name = $row['pd_name'];
                                        $pd_img = $row['pd_img'];
                                        $order_status = $row['order_status'];
                                        $order_pd_qty = $row['order_pd_qty'];
                                        $order_total_price = $row['order_total_price'];
                                        $payment_date = $row['pt_date'];
                                        $payment_time = $row['pt_time'];
                                        $pt_total_price = $row['pt_total_price'];
                                        $totalPrice += $order_total_price * $order_pd_qty;

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
                            orders.order_code = ?";

                                        $stmtP = $conn->prepare($selectP);
                                        $stmtP->bind_param("s", $order_code);
                                        $stmtP->execute();
                                        $resultP = $stmtP->get_result();

                                        ?>
                                        <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-600">
                                            <th scope="row" class="flex items-center px-6 py-4 whitespace-nowrap text-white">
                                                <img class="w-10 h-10 rounded-lg" src="<?php echo $pd_img; ?>" alt="Jese image">
                                                <div class="ps-3">
                                                    <div class="text-base font-semibold">
                                                        <?php echo $pd_name; ?>
                                                    </div>
                                                    <div class="font-normal text-gray-500">
                                                        RM
                                                        <?php echo number_format($order_total_price, 2); ?>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="px-6 py-4">
                                                <?php echo $order_date; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php echo $ct_email; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="order_info.php?order_code=<?php echo $order_code; ?>"
                                                    class="font-medium text-blue-500 hover:underline">View</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tbody>";
                                    echo "<tr class='border-b bg-gray-800 border-gray-700 hover:bg-gray-900'>";
                                    echo "<td colspan='4' class='px-6 py-4 text-center'>No Order Found</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
                                ?>
                            </tbody>
                            <tr id='noReviewRow' class='border-b bg-gray-800 border-gray-700 hover:bg-gray-900'
                                style='display: none;'>
                                <td colspan='4' class='px-6 py-4 text-center'>No Order Found</td>
                            </tr>
                        </table>
                    </div>
                    <script>
                        function filterTable() {
                            var input, filter, table, tr, td, i, txtValue, noReviewRow;
                            input = document.getElementById("table-search-users");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("orders-table");
                            tr = table.getElementsByTagName("tr");
                            noReviewRow = document.getElementById("noReviewRow");

                            var found = false;

                            for (i = 0; i < tr.length; i++) {
                                var rowFound = false; // Flag to check if the filter matches any column in the current row

                                // Check the first <td> element (index 0) for the "Product Name" column
                                td = tr[i].getElementsByTagName("th")[0];
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        rowFound = true;
                                    }
                                }

                                // Loop through the rest of the <td> elements in the current row
                                for (var j = 1; j < tr[i].getElementsByTagName("td").length; j++) {
                                    td = tr[i].getElementsByTagName("td")[j];
                                    if (td) {
                                        txtValue = td.textContent || td.innerText;
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            rowFound = true;
                                            break; // Exit the loop if a match is found in any column
                                        }
                                    }
                                }

                                // Show/hide the row based on whether any column matches the filter
                                if (rowFound) {
                                    tr[i].style.display = "";
                                    found = true;
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }

                            // Show/hide the 'No Request Found' row
                            if (found) {
                                noReviewRow.style.display = "none";
                            } else {
                                noReviewRow.style.display = "";
                            }
                        }

                    </script>

                    <?php
        }
    }
}
?>
    </div>
</body>
<!-- wajib letak -->
</div>

</html>