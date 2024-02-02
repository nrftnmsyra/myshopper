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

<body class="bg-gray-900">
    <div class="p-4 sm:ml-52 relative overflow-x-auto  mt-12">
        <!-- wajib letak -->
        <main class="flex-grow p-4">
            <?php
            if (isset($_GET['order_code'])) {
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
                    $date = date_create($rowQ['iv_date']);
                    $time = date_create($rowQ['pt_time']);
                    $ct_email = $rowQ['ct_email'];
                    $order_status = $rowQ['order_status'];
                    ?>
                    <!-- UBAH DALAM MAIN SAHAJA -->
                    <div class="rounded-lg p-4">
                        <nav class="flex mb-1" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <a href="order.php"
                                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue">
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
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span class="ms-1 text-sm font-medium md:ms-2 text-gray-400">Order
                                            Details</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <div class="mt-4 mb-2.5 flex justify-start item-start space-y-2 flex-col">
                            <h1 class="text-xl lg:text-4xl font-bold leading-7 lg:leading-9 text-white">Order
                                #
                                <?php echo $rowQ['iv_id']; ?>
                            </h1>
                            <p class="text-base text-white font-medium leading-6">
                                <?php echo date_format($date, "jS F Y") ?> at
                                <?php echo date_format($time, "g:i A"); ?> |
                                Status: <span class="font-normal">
                                    <?php echo $order_status; ?>
                                </span>
                            </p>
                        </div>
                        <h1 class="text-white text-2xl font-bold mb-2.5 mt-5">Order Details</h1>
                        <div
                            class="flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
                            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                                <div
                                    class="shadow rounded-lg p-4 flex flex-col justify-start items-start bg-gray-800 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                                    <p class="text-lg md:text-xl text-white font-semibold leading-6 xl:leading-5">
                                        Customer’s Cart</p>
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
                                            <div
                                                class="mt-4 md:mt-6 flex flex-col md:flex-row justify-between items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                                                <div class="h-28 w-28">
                                                    <!-- A rectangular picture -->
                                                    <img class="h-full w-full object-cover rounded-lg"
                                                        src="<?php echo $row2['pd_img']; ?>" alt="" />
                                                </div>
                                                <div class="flex items-center w-3/5"> <!-- Updated this div -->
                                                    <div class="flex flex-col px-4 py-4">
                                                        <span class="text-xl font-semibold text-white">
                                                            <?php echo $row2['pd_name']; ?>
                                                        </span>
                                                        <span class="mt-1 mb-2.5 float-right text-white">Quantity :
                                                            <?php echo $row2['order_pd_qty']; ?>
                                                        </span>
                                                        <p class="text-sm text-white leading-none">
                                                            <span class="text-gray-400">
                                                                <?php echo $row2['pd_description']; ?>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center"> <!-- Added a new div for the price -->
                                                    <p class="text-lg font-bold text-white">RM
                                                        <?php echo number_format($row2['order_total_price'] * $row2['order_pd_qty'], 2); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div
                                    class="shadow rounded-lg flex justify-center flex-col md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                                    <div
                                        class="shadow rounded-lg flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-800 space-y-6">
                                        <h3 class="text-xl text-white font-semibold leading-5">Summary</h3>
                                        <div
                                            class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                                            <div class="flex justify-between w-full">
                                                <p class="text-base text-white leading-4">Subtotal</p>
                                                <p class="text-base text-gray-300 leading-4">RM
                                                    <?php echo number_format($rowQ['pt_total_price'] - 8.00, 2); ?>
                                                </p>
                                            </div>
                                            <div class="flex justify-between items-center w-full">
                                                <p class="text-base text-white leading-4">Shipping</p>
                                                <p class="text-base text-gray-300 leading-4">RM8.00</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center w-full">
                                            <p class="text-base text-white font-semibold leading-4">Total</p>
                                            <p class="text-base text-gray-300 font-semibold leading-4">RM
                                                <?php echo number_format($rowQ['pt_total_price'], 2); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="shadow rounded-lg flex flex-col justify-center px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-800 space-y-6">
                                        <h3 class="text-xl text-white font-semibold leading-5">Shipping</h3>
                                        <div class="flex justify-between items-start w-full">
                                            <div class="flex justify-center items-center space-x-4">
                                                <div class="w-8 h-8">
                                                    <img class="w-full h-full" alt="logo"
                                                        src="https://i.ibb.co/L8KSdNQ/image-3.png" />
                                                </div>
                                                <div class="flex flex-col justify-start items-center">
                                                    <p class="text-lg leading-6 text-white font-semibold">JNT
                                                        Express<br /><span class="font-normal">Delivery with 24 Hours</span></p>
                                                </div>
                                            </div>
                                            <p class="text-lg font-semibold leading-6 text-white">RM8.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="shadow rounded-lg p-4 bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                                <h3 class="text-xl text-white font-semibold leading-5">Customer's Details
                                </h3>
                                <div
                                    class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                                    <dl class="mt-10 max-w-md divide-y text-white divide-gray-700">
                                        <div class="flex flex-col pb-3">
                                            <dt class="mb-1 md:text-sm text-gray-400">Name</dt>
                                            <dd class="text-sm font-semibold">
                                                <?php echo $rowQ['ct_first_name'] . ' ' . $rowQ['ct_last_name']; ?>
                                            </dd>
                                        </div>
                                        <div class="flex flex-col py-3">
                                            <dt class="mb-1 md:text-sm text-gray-400">Home address</dt>
                                            <dd class="text-sm font-semibold">
                                                <?php echo $rowQ['ct_address']; ?>
                                            </dd>
                                        </div>
                                        <div class="flex flex-col py-3">
                                            <dt class="mb-1 md:text-sm text-gray-400">Email</dt>
                                            <dd class="text-sm font-semibold">
                                                <?php echo $rowQ['ct_email']; ?>
                                            </dd>
                                        </div>
                                        <div class="flex flex-col pt-3">
                                            <dt class="mb-1 md:text-sm text-gray-400">Phone number</dt>
                                            <dd class="text-sm font-semibold">
                                                <?php echo $rowQ['ct_phnum']; ?>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                                <div class="flex w-full justify-center items-center md:justify-start md:items-start">
                                    <button
                                        onClick="parent.location='view_invoice_order.php?order_code=<?php echo $order_code; ?>'"
                                        class="rounded mt-6 md:mt-0 border-white hover:bg-gray-900 bg-transparent text-white py-5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 border font-medium w-96 2xl:w-full text-base font-medium leading-4">View
                                        Invoice</button>
                                </div>
                            </div>
                        </div>
                        <?php
                }
            }
            ?>
        </main>
        <!-- wajib letak -->
    </div>
</body>

</html>