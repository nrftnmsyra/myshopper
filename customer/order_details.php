<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<main class="flex-grow p-4">
<?php
if(isset($_GET['order_code'])){
    // Get the product ID and customer email from the request
$order_code = $_GET['order_code'];
include 'includes/db.php';
$total = 0;

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
    $date=date_create($rowQ['iv_date']);
    $time=date_create($rowQ['pt_time']);
    $order_status=$rowQ['order_status'];
         ?>
    <!-- UBAH DALAM MAIN SAHAJA -->
    <div class="rounded-lg p-4">
    <nav class="flex mb-1" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
            <a href="order.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                Orders
            </a>
            </li>
            <li aria-current="page">
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Order Detail</span>
            </div>
            </li>
        </ol>
    </nav>
        <div class="mt-1 mb-2.5 flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-xl dark:text-black lg:text-4xl font-bold leading-7 lg:leading-9 text-gray-800">Order #<?php echo $rowQ['iv_id']; ?></h1>
            <p class="text-base dark:text-gray-800 font-medium leading-6 text-gray-600"><?php echo date_format($date,"jS F Y")?> at <?php echo date_format($time,"g:i A");?></p>
        </div>

        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-900 px-6 py-4">
            <?php include 'order_tracking.php';?>
        </div>
        <h1 class="text-2xl font-bold mb-2.5 mt-10">Order Details</h1>
        <div class="flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
            <div class="rounded-lg p-4 flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                <p class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">Customer’s Cart</p>
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
                    <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-between items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                    <div class="flex items-center"> <!-- Updated this div -->
                        <img class="m-2 h-28 w-28 rounded-md border object-cover object-center" src="<?php echo $row2['pd_img']; ?>" alt="" />
                        <div class="flex flex-col px-4 py-4">
                            <span class="text-xl font-semibold dark:text-white"><?php echo $row2['pd_name']; ?></span>
                            <span class="mt-1 mb-2.5 float-right dark:text-white">Quantity : <?php echo $row2['order_pd_qty']; ?></span>
                            <p class="text-sm dark:text-white leading-none text-gray-800">
                                <span class="dark:text-gray-400 text-gray-300"><?php echo $row2['pd_description']; ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center"> <!-- Added a new div for the price -->
                        <p class="text-lg font-bold dark:text-white">RM<?php echo number_format($row2['order_total_price']*$row2['order_pd_qty'],2); ?></p>
                    </div>
                </div>
                <?php
                        }
                    }
                    ?>
            </div>
            <div class="rounded-lg flex justify-center flex-col md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                <div class="rounded-lg flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Summary</h3>
                <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                    <div class="flex justify-between w-full">
                    <p class="text-base dark:text-white leading-4 text-gray-800">Subtotal</p>
                    <p class="text-base dark:text-gray-300 leading-4 text-gray-600">RM<?php echo number_format($rowQ['pt_total_price']-8.00,2); ?></p>
                    </div>
                    <div class="flex justify-between items-center w-full">
                    <p class="text-base dark:text-white leading-4 text-gray-800">Shipping</p>
                    <p class="text-base dark:text-gray-300 leading-4 text-gray-600">RM8.00</p>
                    </div>
                </div>
                <div class="flex justify-between items-center w-full">
                    <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Total</p>
                    <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">RM<?php echo number_format($rowQ['pt_total_price'],2); ?></p>
                </div>
                </div>
                <div class="rounded-lg flex flex-col justify-center px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Shipping</h3>
                <div class="flex justify-between items-start w-full">
                    <div class="flex justify-center items-center space-x-4">
                    <div class="w-8 h-8">
                        <img class="w-full h-full" alt="logo" src="https://i.ibb.co/L8KSdNQ/image-3.png" />
                    </div>
                    <div class="flex flex-col justify-start items-center">
                        <p class="text-lg leading-6 dark:text-white font-semibold text-gray-800">JNT Express<br /><span class="font-normal">Delivery with 24 Hours</span></p>
                    </div>
                    </div>
                    <p class="text-lg font-semibold leading-6 dark:text-white text-gray-800">RM8.00</p>
                </div>
                </div>
            </div>
            </div>
            <div class="rounded-lg p-4 g-gray-50 dark:bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
            <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Customer's Details</h3>
            <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                <dl class="mt-10 max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3">
                        <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Name</dt>
                        <dd class="text-sm font-semibold"><?php echo $rowQ['ct_first_name'].' '.$rowQ['ct_last_name']; ?></dd>
                    </div>
                    <div class="flex flex-col py-3">
                        <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Home address</dt>
                        <dd class="text-sm font-semibold"><?php echo $rowQ['ct_address']; ?></dd>
                    </div>
                    <div class="flex flex-col py-3">
                        <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Email</dt>
                        <dd class="text-sm font-semibold"><?php echo $rowQ['ct_email']; ?></dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Phone number</dt>
                        <dd class="text-sm font-semibold"><?php echo $rowQ['ct_phnum']; ?></dd>
                    </div>
                </dl>
            </div>
            <div class="flex w-full justify-center items-center md:justify-start md:items-start">
                <button onClick="parent.location='view_invoice.php?order_code=<?php echo $order_code;?>'" class="mt-6 md:mt-0 dark:border-white dark:hover:bg-gray-900 dark:bg-transparent dark:text-white py-5 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 border border-gray-800 font-medium w-96 2xl:w-full text-base font-medium leading-4 text-gray-800">View Invoice</button>
          </div>
        </div>
    </div>
    <?php
    if(($order_status == 'To Ship') || ($order_status ==  'To Pay')){ ?>
        <div class="mt-5 flex w-full justify-center items-center md:justify-start md:items-start">
            <button class="mt-6 md:mt-0 dark:border-black dark:hover:bg-gray-900 dark:bg-transparent dark:text-black py-5 hover:bg-gray-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 border border-gray-800 font-medium w-96 2xl:w-full text-base font-medium leading-4 text-gray-800">Cancel Order</button>
        </div>
  <?php  
}
}
}
?>
</main>


<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>