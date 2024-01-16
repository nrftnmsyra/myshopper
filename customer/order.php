<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<main class="flex-grow p-4">
    <div id="ordersContent" class="rounded-lg p-4">
        <h1 class="text-4xl font-bold mb-4">Your Order</h1>
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
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
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for orders">
            </div>
        </div>
        <?php
        session_start();
        $email = $_SESSION['email'];
        $totalPrice = 0;

        include 'includes/db.php';

        // Select data from the table
        $selectQuery = "SELECT
                        personalshopper.ps_username,
                        personalshopper.ps_email,
                        product.pd_name,
                        product.pd_img,
                        orders.order_ct_email,
                        orders.order_pd_id,
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
                        personalshopper ON product.pd_ps_email = personalshopper.ps_email
                        WHERE
                        orders.order_ct_email = ?
                        GROUP BY orders.order_code ORDER BY DATE(payment.pt_date) DESC";

        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            // Fetch data from each row and group by personal shopper
            while ($row = $result->fetch_assoc()) {
                $ps_email = $row['ps_email'];
                $ps_username = $row['ps_username'];
                $order_ct_email = $row['order_ct_email'];
                $order_code = $row['order_code'];
                $order_pd_id = $row['order_pd_id'];
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
                <div class="mb-5 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-900 px-6 py-4 order-card"
                    data-order-status="<?php echo strtolower($order_status); ?>">

                    <a href="order_details.php?order_code=<?= $order_code ?>">
                        <div>
                            <h2
                                class="text-2xl tracking-tight text-gray-900 dark:text-white font-bold border-b border-gray-600 p-3 flex items-center justify-center">
                                <?php echo $ps_username; ?>
                                <!-- Display status on the right side -->
                                <?php
                                if ($order_status == 'To Pay') {
                                    ?><span class="ml-auto text-sm font-semibold text-gray-500">
                                        <?php echo $order_status; ?>
                                    </span>
                                    <?php
                                } else if ($order_status == 'To Ship') {
                                    ?><span class="ml-auto text-sm font-semibold text-blue-500">
                                        <?php echo $order_status; ?>
                                        </span>
                                    <?php
                                } else if ($order_status == 'To Receive') {
                                    ?><span class="ml-auto text-sm font-semibold text-green-500">
                                        <?php echo $order_status; ?>
                                            </span>
                                    <?php
                                } else if ($order_status == 'Completed') {
                                    ?><span class="ml-auto text-sm font-semibold text-gray-500">
                                        <?php echo $order_status; ?>
                                                </span>
                                    <?php
                                } else if ($order_status == 'Cancelled') {
                                    ?><span class="ml-auto text-sm font-semibold text-red-500">
                                        <?php echo $order_status; ?>
                                                    </span>
                                    <?php
                                }
                                ?>
                            </h2>
                        </div>
                        <!-- Display product details for the current personal shopper -->
                        <div class="flex items-center bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="p-3 flex justify-center items-center">
                                <!-- Square Image with Rounded Corners -->
                                <img class="w-24 h-24 object-cover rounded-md" src="<?php echo $pd_img; ?>" alt="" />
                            </div>
                            <!-- Product Details -->
                            <div class="p-5 w-full">
                                <!-- <a href="order_details.php"> -->
                                <div class="mb-2">
                                    <h5
                                        class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white transition duration-300 hover:text-gray-300">
                                        <?php echo $pd_name; ?>
                                    </h5>
                                </div>
                    </a>
                    <!-- Quantity input for the current product -->
                    <div>
                        <label for="quantity" class="mb-2 font-normal text-gray-700 dark:text-gray-400">Quantity : x
                            <?php echo $order_pd_qty; ?>
                        </label>
                        <!-- input number -->
                    </div>
                </div>

                <div class="flex items-center justify-center">
                    <h1 id="totalPrice" class="text-xl font-semibold text-gray-900 dark:text-white whitespace-nowrap">Total : RM
                    </h1>
                    <p class="text-xl font-semibold text-gray-900 dark:text-white whitespace-nowrap"
                        id="total_<?php echo $ps_email; ?>">
                        <?= number_format($totalPrice, 2) ?>
                    </p>
                </div>
            </div>
            <?php
            if ($resultP->num_rows > 1) {
                ?>
                <div class="border-t border-gray-600 flex justify-center p-3">
                    <a href="order_details.php?order_code=<?= $order_code ?>"
                        class="text-sm text-gray-500 items-center mx-auto">View more product</a>
                </div>
                <?php
            }
            ?>
            <div class="border-t border-gray-600 flex justify-between p-3">
                <h1 id="totalPrice" class="text-xl font-semibold text-gray-900 dark:text-white whitespace-nowrap">Total : RM
                </h1>
                <p class="text-xl font-semibold text-gray-900 dark:text-white whitespace-nowrap"
                    id="total_<?php echo $ps_email; ?>">
                    <?= number_format($pt_total_price, 2) ?>
                </p>
                <div class="flex items-center ml-auto">
                    <!-- Checkout button on the right side -->
                    <div class="flex flex-wrap items-center justify-between px-6 pt-1 pb-4">
                        <div class="flex flex-wrap text-gray-500">
                            <span class="mr-1 text-sm">
                                <?php echo $payment_date; ?>
                            </span>
                        </div>
                        <div class="flex flex-wrap text-gray-500">
                            <span class="text-sm">
                                <?php echo $payment_time; ?>
                            </span>
                        </div>
                    </div>
                    <button type="submit"
                        class="p-5 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        onClick="parent.location='order_details.php?order_code=<?php echo $order_code; ?>'">
                        View
                    </button>
                </div>
            </div>
            </div>
            </a>
            <?php
            }

        } else {
            ?>
        <div class="w-full h-max rounded-lg shadow bg-gray-800 border-gray-900 px-6 py-10">
            <h2 class="text-2xl text-center text-bold text-white mb-2.5">No Orders Yet<p
                    class="pt-1 text-xs tracking-tight text-center text-white border-gray-600">Checkout your Item now!</p>
            </h2>
            <button
                class="block mx-auto item-center text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700"
                type="button" onClick="parent.location='cart.php'">
                Go to Your Cart
            </button>
        </div>

    <?php } ?>
    </div>
</main>


<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const orderStatusFilter = document.getElementById("orderStatusFilter");
        const tableSearch = document.getElementById("table-search");
        const orderCards = document.querySelectorAll(".order-card");

        // Function to handle filtering based on order status
        function filterByStatus(selectedStatus) {
            orderCards.forEach(function (card) {
                const cardStatus = card.getAttribute("data-order-status");

                if (selectedStatus === "all" || cardStatus === selectedStatus) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        // Function to handle filtering based on search input
        function filterBySearch(searchTerm) {
            const lowercasedSearchTerm = searchTerm.toLowerCase();

            orderCards.forEach(function (card) {
                const cardText = card.innerText.toLowerCase();

                if (cardText.includes(lowercasedSearchTerm)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        // Event listener for order status filter
        orderStatusFilter.addEventListener("change", function () {
            const selectedStatus = orderStatusFilter.value.toLowerCase();
            filterByStatus(selectedStatus);
        });

        // Event listener for search input
        tableSearch.addEventListener("input", function () {
            const searchTerm = tableSearch.value.trim();
            filterBySearch(searchTerm);
        });
    });
</script>



</html>