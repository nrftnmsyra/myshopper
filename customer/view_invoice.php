<?php
include 'includes/header.php'; ?>
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php';
include 'includes/db.php';
if (isset($_GET['order_code'])) {
    $clearCartQuery = "DELETE FROM cart WHERE cart_ct_email = ? AND cart_pd_id = ?";
    $stmtClearCart = $conn->prepare($clearCartQuery);
    $stmtClearCart->bind_param("si", $email, $product['product_id']);
    $stmtClearCart->execute();
    $stmtClearCart->close();
    $order_code = $_GET['order_code'];
    ?>
    <main class="flex-grow p-4">
        <nav class="flex mb-1" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="order.php"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Orders
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="order_details.php?order_code=<?php echo $order_code; ?>"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue">
                            Order Details
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Invoice</span>
                    </div>
                </li>
            </ol>
        </nav>
        <button onclick="downloadPDF('contentToPrint')"
            class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center mt-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                <path fill-rule="evenodd"
                    d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm5.845 17.03a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V12a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3z"
                    clip-rule="evenodd" />
                <path
                    d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
            </svg>
            Save as PDF
        </button>
        <div id="contentToPrint" class="">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
            <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
                <?php
                // Get the product ID and customer email from the request
                include 'includes/db.php';
                $total = 0;
                $subtotal = 0;
                $selectQuery = "SELECT
                i.*,
                o.*,
                p.*,
                pr.*,
                c.*,
                ps.*
                FROM
                invoice i
                JOIN
                orders o ON i.iv_id = o.order_invoice_id
                JOIN
                payment p ON o.order_payment_id = p.pt_id
                JOIN
                customer c ON p.pt_ct_email = c.ct_email
                JOIN
                personalshopper ps ON o.order_ps_email = ps.ps_email
                JOIN
                product pr ON o.order_pd_id = pr.pd_id
                WHERE
                o.order_code = '$order_code'";

                $resultQ = $conn->query($selectQuery);
                // Check if there are rows in the result
                if ($resultQ->num_rows > 0) {
                    // Fetch data from each row
                    $rowQ = $resultQ->fetch_assoc();
                    $date = date_create($rowQ['iv_date']);
                    $time = date_create($rowQ['pt_time']);
                    $order_status = $rowQ['order_status'];
                    ?>
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <img class="h-8 w-8 mr-2" src="../assets/logo1.png" alt="Logo" />
                            <div class="text-gray-700 font-semibold text-lg">myShopper</div>
                        </div>
                        <div class="text-gray-700">
                            <div class="font-bold text-xl mb-2">INVOICE</div>
                            <div class="text-sm">Date:
                                <?php echo $rowQ['iv_date']; ?>
                            </div>
                            <div class="text-sm">Invoice #: INV
                                <?php echo $rowQ['iv_id']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="border-b-2 border-gray-300 pb-8 mb-8">
                        <h2 class="text-2xl font-bold mb-4">Shop with
                            <?php echo $rowQ['ps_username']; ?>
                        </h2>
                        <div class="text-gray-700 mb-2">
                            <?php echo $rowQ['ct_first_name'] . ' ' . $rowQ['ct_last_name']; ?>
                        </div>
                        <div class="text-gray-700 mb-2">
                            <?php echo $rowQ['ct_address']; ?>
                        </div>
                        <div class="text-gray-700 mb-2">
                            <?php echo $rowQ['ct_phnum']; ?>
                        </div>
                        <div class="text-gray-700">
                            <?php echo $rowQ['ct_email']; ?>
                        </div>
                    </div>
                    <table class="w-full text-left mb-8">
                        <thead>
                            <tr>
                                <th class="text-gray-700 font-bold uppercase py-2">Description</th>
                                <th class="text-gray-700 font-bold uppercase py-2">Quantity</th>
                                <th class="text-gray-700 font-bold uppercase py-2">Price</th>
                                <th class="text-gray-700 font-bold uppercase py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery2 = "SELECT
                    i.*,
                    o.*,
                    p.*,
                    pr.*,
                    c.*,
                    ps.*
                    FROM
                    invoice i
                    JOIN
                    orders o ON i.iv_id = o.order_invoice_id
                    JOIN
                    payment p ON o.order_payment_id = p.pt_id
                    JOIN
                    customer c ON p.pt_ct_email = c.ct_email
                    JOIN
                    personalshopper ps ON o.order_ps_email = ps.ps_email
                    JOIN
                    product pr ON o.order_pd_id = pr.pd_id
                    WHERE
                    o.order_code = '$order_code'";

                            $result2 = $conn->query($selectQuery2);
                            // Check if there are rows in the result
                            if ($result2) {
                                // Loop through the fetched data and display it in the order summary div
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                    <tr>
                                        <td class="py-4 text-gray-700">
                                            <?php echo $row2['pd_name']; ?>
                                        </td>
                                        <td class="py-4 text-gray-700">
                                            <?php echo $row2['order_pd_qty']; ?>
                                        </td>
                                        <td class="py-4 text-gray-700">RM
                                            <?php echo number_format($row2['order_total_price'], 2); ?>
                                        </td>
                                        <td class="py-4 text-gray-700">RM
                                            <?php echo number_format($total = $row2['order_total_price'] * $row2['order_pd_qty'], 2); ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $subtotal = $subtotal + ($row2['order_total_price'] * $row2['order_pd_qty']);
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="flex justify-end mb-8">
                        <div class="text-gray-700 mr-2">Subtotal:</div>
                        <div class="text-gray-700">RM
                            <?php echo number_format($subtotal, 2); ?>
                        </div>
                    </div>
                    <div class="flex justify-end mb-8">
                        <div class="text-gray-700 mr-2">Shipping:</div>
                        <div class="text-gray-700">RM8.00</div>
                    </div>
                    <div class="flex justify-end mb-8">
                        <div class="text-gray-700 mr-2">Total:</div>
                        <div class="text-gray-700 font-bold text-xl">RM
                            <?php echo number_format($rowQ['pt_total_price'], 2); ?>
                        </div>
                    </div>
                    <div class="border-t-2 border-gray-300 pt-8 mb-8">
                        <div class="text-gray-700 mb-2">The order will be proceed after the invoice is generated.</div>
                    </div>
                </div>

                <?php
                }
}
?>

</main>


<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php
include 'includes/footer.php'; ?>

</body>

</html>
<script>
    function downloadPDF(divId) {
        var element = document.getElementById(divId);

        html2pdf(element, {
            margin: 10,
            filename: 'document.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        });
    }
</script>