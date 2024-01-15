<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/min/dropzone.min.css">

</head>
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
            $order_status = $rowQ['order_status'];
            ?>
            <!-- UBAH DALAM MAIN SAHAJA -->
            <div class="rounded-lg p-4">
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
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Review</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="mt-1 mb-2.5 flex justify-start item-start space-y-2 flex-col">
                    <h1 class="mt-1 mb-2.5 text-xl dark:text-black lg:text-4xl font-bold leading-7 lg:leading-9 text-gray-800">
                        Review
                    </h1>
                </div>
                <div
                    class="flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
                    <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                        <div
                            class="rounded-lg flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
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
                                $row2 = mysqli_fetch_assoc($result2);
                                ?>
                                <div class="border-b border-gray-700 pb-5 flex flex-col items-center md:items-start w-full">
                                    <!-- Updated flex properties -->
                                    <div class="flex items-center mb-2.5">
                                        <img class="w-10 h-10 rounded-full" src="<?php echo $row2['ps_img'] ?>" alt="Jese image">
                                        <div class="ps-3">
                                            <div class="text-white text-base font-semibold">
                                                <?php echo $row2['ps_username']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center w-full">
                                        <div id="1" class="flex-1">
                                            <div class="flex items-center">
                                                <img class="mr-2 my-2 h-28 w-28 rounded-md border object-cover object-center"
                                                    src="<?php echo $row2['pd_img']; ?>" alt="" />
                                                <div class="flex flex-col px-4 py-4">
                                                    <span class="text-xl font-semibold dark:text-white">
                                                        <?php echo $row2['pd_name']; ?>
                                                    </span>
                                                    <span class="mt-1 mb-2.5 float-right dark:text-white">Quantity :
                                                        <?php echo $row2['order_pd_qty']; ?>
                                                    </span>
                                                    <p class="text-sm dark:text-white leading-none text-gray-800">
                                                        <span class="dark:text-gray-400 text-gray-300">
                                                            <?php echo $row2['pd_description']; ?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="2" class="ml-auto pr-4"> <!-- Added ml-auto for right alignment -->
                                            <p class="text-lg font-bold dark:text-white">RM
                                                <?php echo number_format($row2['order_total_price'] * $row2['order_pd_qty'], 2); ?>
                                            </p>
                                        </div>
                                    </div>


                                </div>




                                <?php
                            }
        }
        ?>
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
                        <form class="w-full" action="review_add.php" method="post" enctype="multipart/form-data">
                            <div class="mt-10 flex items-center">
                                <p class="mr-2 text-white text-base font-semibold">Rating </p>
                                <div class="rating-box">
                                    <div class="stars">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <input type="hidden" name="rating" value="">
                                    <input type="hidden" name="order_code" value="<?php echo $row2['order_code'] ?>">
                                    <input type="hidden" name="rv_ct_email" value="<?php echo $row2['ct_email'] ?>">
                                    <input type="hidden" name="rv_ps_email" value="<?php echo $row2['ps_email'] ?>">
                                    <input type="hidden" name="rv_order_id" value="<?php echo $row2['order_id'] ?>">
                                </div>
                            </div>

                            <textarea id="message" rows="4" name="rv_description"
                                class="mt-5 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Share more thoughts on the product to help other buyers."></textarea>
                            <div class="mt-4 flex items-center justify-center w-full">
                                <div class="mt-4 flex flex-col items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Click to upload</span>
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                                800x400px)</p>
                                        </div>
                                        <input id="dropzone-file" type="file" name="rv_img[]" class="hidden" multiple
                                            onchange="updateFileNames(this)">
                                    </label>
                                    <span id="selected-file-names"
                                        class="mt-2 text-sm text-gray-500 dark:text-gray-400"></span>
                                </div>

                            </div>
                            <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>\
                            <button type="submit"
                                class="mx-auto block w-40 px-3 py-2 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Submit
                            </button>

                        </form>

                        <script>
                            // Select all elements with the "i" tag and store them in a NodeList called "stars"
                            const stars = document.querySelectorAll(".stars i");
                            // Select the hidden input field
                            const ratingInput = document.querySelector('input[name="rating"]');

                            // Function to update the rating based on the selected stars
                            const updateRating = (selectedCount) => {
                                // Set the value of the hidden input field to the selected count
                                ratingInput.value = selectedCount;
                            };

                            // Loop through the "stars" NodeList
                            stars.forEach((star, index1) => {
                                // Add an event listener that runs a function when the "click" event is triggered
                                star.addEventListener("click", () => {
                                    // Loop through the "stars" NodeList Again
                                    stars.forEach((star, index2) => {
                                        // Add the "active" class to the clicked star and any stars with a lower index
                                        // and remove the "active" class from any stars with a higher index
                                        index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
                                    });

                                    // Update the rating based on the number of selected stars
                                    updateRating(index1 + 1);
                                });
                            });
                        </script>

                        <style>
                            .rating-box .stars {
                                display: flex;
                                align-items: center;
                                gap: 10px;
                            }

                            .stars i {
                                color: #e6e6e6;
                                font-size: 20px;
                                cursor: pointer;
                                transition: color 0.2s ease;
                            }

                            .stars i.active {
                                color: #fde047;
                            }
                        </style>
                    </div>
                    <div
                        class="rounded-lg flex justify-center flex-col md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">

                    </div>
                </div>
            </div>

            <?php
    }
    ?>
        <script>
            function updateFileNames(input) {
                const fileInput = document.getElementById('dropzone-file');
                const fileNamesSpan = document.getElementById('selected-file-names');

                const files = fileInput.files;

                if (files.length > 0) {
                    const fileNames = Array.from(files).map(file => file.name);
                    fileNamesSpan.textContent = `Selected files: ${fileNames.join(', ')}`;
                } else {
                    fileNamesSpan.textContent = '';
                }
            }
        </script>
</main>
<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>