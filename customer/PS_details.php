<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<style>
    @media screen and (-webkit-min-device-pixel-ratio: 0) {

        /* Style the scrollbar only for the card with class 'card' */
        #review::-webkit-scrollbar {
            width: 12px;
            /* width of the entire scrollbar */
        }

        #review::-webkit-scrollbar-track {
            background: #1f2937;
            /* color of the tracking area */
        }

        #review::-webkit-scrollbar-thumb {
            background-color: white;
            /* color of the scroll thumb */
            border-radius: 20px;
            /* roundness of the scroll thumb */
            border: 3px solid #1f2937;
            /* creates padding around scroll thumb */
        }
    }
</style>
<?php
session_start();
include 'includes/header.php';
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$review_count = 0;
include 'includes/db.php';
// Select data from the table
if (isset($_GET['ps_email'])) {
    // Get the product ID and customer email from the request
    $ps_email = $_GET['ps_email'];
    $selectQuery = "SELECT ps.*, AVG(rv.rv_rating) AS avg_rating
    FROM personalshopper ps
    LEFT JOIN review rv ON ps.ps_email = rv.rv_ps_email WHERE ps.ps_email = '$ps_email'";
    $result = $conn->query($selectQuery);
    $ps_rating = 0;
    ?>
    <div class="max-w-screen-xl pt-5 px-4 py-3 mx-auto flex flex-wrap gap-4 justify-start" id="filteredContent">
        <?php
        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            // Fetch data from each row
            $row = $result->fetch_assoc();
            // Process data or store it in an array for later use
            $ps_username = $row['ps_username'];
            $ps_first_name = $row['ps_first_name'];
            $ps_last_name = $row['ps_last_name'];
            $ps_phnum = $row['ps_phnum'];
            $ps_expertise = $row['ps_expertise'];
            $ps_area = $row['ps_area'];
            $ps_order_count = $row['ps_order_count'];
            $ps_fee = $row['ps_fee'];
            $ps_availability = $row['ps_availability'];
            $ps_img = $row['ps_img'];
            $ps_desc = $row['ps_desc'];
            $ps_rating = $row['avg_rating'];

            ?>
            <div class="container mx-auto p-4">
                <nav class="flex mb-2.5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="index.php"
                                class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue">
                                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="ms-1 text-sm font-medium md:ms-2 text-gray-400">Personal Shopper
                                    Details</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="flex max-w-full border rounded-lg shadow bg-gray-800 border-gray-700">
                    <div class="flex w-48 h-full p-3">
                        <a href="#">
                            <img class="rounded" src="<?php echo $ps_img; ?>" alt="product image" />
                        </a>
                    </div>
                    <div class="flex-grow px-5 py-5">
                        <a href="#" disabled>
                            <h5 class="text-xl font-semibold tracking-tight text-white">
                                <?php echo $ps_username; ?>
                            </h5>
                        </a>
                        <p class="mt-2 text-sm text-gray-400">
                            <?php echo $ps_expertise; ?>
                        </p>
                        <div class="flex items-center mt-2.5 mb-5">
                            <?php
                            echo '<div class="flex items-center space-x-1 rtl:space-x-reverse">';
                            for ($i = 0; $i < $ps_rating; $i++) {
                                echo '<svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>';
                            }

                            if ($ps_rating < 5) {
                                for ($i = 0; $i < 5 - $ps_rating; $i++) {
                                    echo '<svg class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>';
                                }
                                echo '</div>';
                            } else {
                                echo '</div>';
                            }
                            ?>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded bg-blue-200 text-blue-800 ms-3">
                                <?php echo number_format($ps_rating, 1); ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-white">RM
                                <?php echo number_format($ps_fee, 2); ?><span class="text-sm text-gray-500"> (service
                                    fee)</span>
                            </span>
                        </div>
                    </div>
                </div>
                <?php
        }
}
?>
        <div class="mx-auto">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                            data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="true">Description</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">Request</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Review (
                            <?php echo $review_count ?>)
                        </button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-800" id="profile" role="tabpanel"
                    aria-labelledby="profile-tab">
                    <p class="text-sm text-gray-400">
                        <?php echo $ps_desc; ?>
                    </p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-800" id="dashboard" role="tabpanel"
                    aria-labelledby="dashboard-tab">
                    <div class="p-4 md:p-5">
                        <form class="space-y-2" id="request-form" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $email; ?>" name="email">
                            <input type="hidden" value="<?php echo $ps_email; ?>" name="ps_email">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-white">What would you
                                    like to buy</label>
                                <input type="text" name="pd_name"
                                    class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                                    placeholder="Pants, Blouse, etc" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-white"
                                    for="file_input">Attachment</label>
                                <input
                                    class="block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                                    aria-describedby="file_input_help" name="files[]"
                                    onchange="displaySelectedFiles(this.files)" id="file_input"
                                    accept=".pdf, .jpg, .jpeg, .png" type="file">
                                <p class="mt-1 text-sm text-gray-300" id="file_input_help">PNG or
                                    JPG (MAX.
                                    1080x1080px).</p>
                            </div>
                            <div class="col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-white">Product
                                    Description</label>
                                <textarea id="description" name="desc" rows="4"
                                    class="block p-2.5 w-full text-sm rounded-lg border bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write product description here"></textarea>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-500 hover:bg-blue-600 focus:ring-blue-700">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Send Shopping Request
                            </button>
                        </form>
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-800" id="settings" role="tabpanel"
                    aria-labelledby="settings-tab">
                    <div id="review" class="overflow-auto max-h-96 flex flex-col gap-4 p-4">
                        <?php
                        $selectReview = "SELECT *, COUNT(*) OVER() AS row_count
                        FROM review
                        JOIN customer ON review.rv_ct_email = customer.ct_email
                        WHERE rv_ps_email = '$ps_email'";
                        $resultR = $conn->query($selectReview);
                        // Check if there are rows in the result
                        if ($resultR->num_rows > 0) {
                            // Fetch data from each row
                            while ($rowR = $resultR->fetch_assoc()) {
                                // Process data or store it in an array for later use
                                global $r;
                                $ct_username = $rowR['ct_username'];
                                $ct_img = $rowR['ct_img'];
                                $rv_rating = $rowR['rv_rating'];
                                $date = new DateTime($rowR['rv_date']);
                                $rv_date = date_format($date, "M d, Y");
                                $rv_desc = $rowR['rv_description'];
                                $rv_id = $rowR['rv_id'];
                                $review_count = $rowR['row_count'];
                                ?>
                                <!-- Profile and Rating -->
                                <div class="flex justify justify-between mb-2.5">
                                    <div class="flex items-center">
                                        <img class="w-10 h-10 rounded-full" src="<?php echo $rowR['ct_img'] ?>"
                                            alt="Jese image">
                                        <div class="ps-3">
                                            <div class="text-white text-base font-semibold">
                                                <?php echo $rowR['ct_username']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center mt-2.5 mb-2.5">
                                        <?php
                                        echo '<div class="flex items-center space-x-1 rtl:space-x-reverse">';
                                        for ($i = 0; $i < $rv_rating; $i++) {
                                            echo '<svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>';
                                        }

                                        if ($rv_rating < 5) {
                                            for ($i = 0; $i < 5 - $rv_rating; $i++) {
                                                echo '<svg class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>';
                                            }
                                            echo '</div>';
                                        } else {
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="text-white text-base font-normal">
                                    <?php echo $rv_desc; ?>
                                </div>
                                <div class="flex">
                                    <?php
                                    $selectImage = "SELECT * FROM image WHERE ref_id = '$rv_id'";
                                    $resultI = $conn->query($selectImage);
                                    // Check if there are rows in the result
                                    if ($resultI->num_rows > 0) {
                                        // Fetch data from each row
                                        while ($rowI = $resultI->fetch_assoc()) {
                                            // Process data or store it in an array for later use
                                            $ref_id = $rowI['ref_id'];
                                            $img_path = $rowI['img_path'];
                                            ?>
                                            <img src="<?php echo $img_path; ?>" class="w-24 h-24 rounded-lg mr-2.5"
                                                id="openModal_<?php echo $ref_id; ?>" alt="image description">
                                            <div id="imageModal_<?php echo $ref_id; ?>"
                                                class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                                                <!-- Modal content -->
                                                <div class="bg-white p-4 rounded-md shadow-md max-w-md w-full mx-auto relative">
                                                    <!-- Close button (x icon) -->
                                                    <span
                                                        class="cursor-pointer absolute top-0.5 right-2 text-gray-800 hover:text-red-500 text-4xl"
                                                        id="closeModal_<?php echo $ref_id; ?>">&times;</span>
                                                    <!-- Image container -->
                                                    <div id="modalContent_<?php echo $ref_id; ?>"><img class="pb-5 rounded-t-lg"
                                                            src="<?php echo $img_path; ?>" alt="product image" /></div>
                                                </div>
                                            </div>
                                            <script>
                                                // JavaScript to handle modal functionality for each row
                                                document.getElementById('openModal_<?php echo $ref_id; ?>').addEventListener('click', function () {
                                                    document.getElementById('imageModal_<?php echo $ref_id; ?>').classList.remove('hidden');
                                                });

                                                document.getElementById('closeModal_<?php echo $ref_id; ?>').addEventListener('click', function () {
                                                    document.getElementById('imageModal_<?php echo $ref_id; ?>').classList.add('hidden');
                                                });
                                            </script>
                                        <?php }
                                    } else {
                                    } ?>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white text-xs font-semibold">
                                        <?php echo $rv_date; ?>
                                    </span>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="w-full h-max rounded-lg bg-gray-800 px-56 py-10">
                                <p class="pt-1 text-normal tracking-tight text-center text-gray-200">No
                                    Review Yet</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="w-full">
        <div class="flex justify-center items-center mb-10 max-content mx-auto">
            <h1 class="mx-auto font-sans item-center text-4xl font-bold">Products</h1>
        </div>
        <?php
        $selectProduct = "SELECT * FROM product WHERE pd_ps_email = '$ps_email' AND pd_type='shopper' AND pd_availability = 1 AND pd_quantity >= 1";
        $resultProduct = $conn->query($selectProduct);

        // Check if there are rows in the result
        if ($resultProduct->num_rows > 0) {

            ?>
            <div class="productList w-full mx-auto flex overflow-x-hidden items-center pb-24 px-2">
                <div class="grid grid-cols-4 gap-4" id="productCarousel">
                    <?php
                    // Fetch data from each row
                    while ($rowP = $resultProduct->fetch_assoc()) {
                        // Process data or store it in an array for later use
                        $pd_id = $rowP['pd_id'];
                        $pd_name = $rowP['pd_name'];
                        $pd_price = $rowP['pd_price'];
                        $pd_quantity = $rowP['pd_quantity'];
                        $pd_desc = $rowP['pd_description'];
                        $pd_img = $rowP['pd_img'];
                        $pd_availability = $rowP['pd_availability'];

                        if ($pd_availability == 1) {
                            $status = "Available";
                        } else {
                            $status = "Out of stock";
                        }
                        ?>
                        <div class="w-[300px]">

                            <div class="group h-full overflow-hidden rounded-lg border-gray-200 shadow-lg mb-1">
                                <form action="cart_add.php" method="post">
                                    <!-- Adjusted the styles for the image to make it square -->
                                    <div class="w-full h-64">
                                        <a href="#" id="openModal_<?php echo $pd_id; ?>"><img
                                                class="w-full h-full object-cover object-center" src="<?php echo $pd_img; ?>"
                                                alt="blog" /></a>
                                    </div>
                                    <div id="imageModal_<?php echo $pd_id; ?>"
                                        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                                        <!-- Modal content -->
                                        <div class="bg-white p-4 rounded-md shadow-md max-w-md w-full mx-auto relative">
                                            <!-- Close button (x icon) -->
                                            <span
                                                class="cursor-pointer absolute top-0.5 right-2 text-gray-800 hover:text-red-500 text-4xl"
                                                id="closeModal_<?php echo $pd_id; ?>">&times;</span>
                                            <!-- Image container -->
                                            <div id="modalContent_<?php echo $pd_id; ?>"><img class="pb-5 rounded-t-lg"
                                                    src="<?php echo $pd_img; ?>" alt="product image" /></div>
                                        </div>
                                    </div>
                                    <script>
                                        // JavaScript to handle modal functionality for each row
                                        document.getElementById('openModal_<?php echo $pd_id; ?>').addEventListener('click', function () {
                                            document.getElementById('imageModal_<?php echo $pd_id; ?>').classList.remove('hidden');
                                        });

                                        document.getElementById('closeModal_<?php echo $pd_id; ?>').addEventListener('click', function () {
                                            document.getElementById('imageModal_<?php echo $pd_id; ?>').classList.add('hidden');
                                        });
                                    </script>
                                    <h2
                                        class="title-font inline-block cursor-pointer px-6 pt-4 pb-1 text-xs font-semibold uppercase tracking-widest text-blue-500 hover:font-bold">
                                        <?php echo $pd_status; ?>
                                    </h2>
                                    <div class="h-56 py-1 px-6">
                                        <h1
                                            class="mb-3 inline-block cursor-pointer text-xl capitali font-bold tracking-wide text-gray-800">
                                            <?php echo $pd_name; ?>
                                        </h1>
                                        <p
                                            class="line-clamp-6 mb-3 text-sm cursor-pointer overflow-hidden leading-relaxed text-gray-500">
                                            <?php echo nl2br($pd_desc); ?>
                                        </p>
                                    </div>
                                    <div class="flex flex-wrap items-center justify-between px-6 pt-1">
                                        <div class="flex flex-wrap text-gray-500">
                                            <span class="mr-1 text-md">RM
                                                <?php echo number_format($pd_price, 2); ?>
                                            </span>
                                        </div>
                                        <div class="flex flex-wrap text-gray-500">
                                            <span class="text-sm">
                                                <?php echo $pd_quantity; ?> lefts
                                            </span>
                                        </div>
                                    </div>
                                    <div class="px-6 pt-1 mb-4 mr-1 text-gray-500 text-xs">
                                        (service fee included)
                                    </div>

                                    <div class="flex justify-center items-center w-full px-6 pb-4">
                                        <label for="quantity"
                                            class="mb-2 text-md font-semibold text-gray-800 mr-2.5">Quantity</label>
                                        <div class="py-2 px-3 inline-block bg-white border border-gray-200 rounded-lg"
                                            data-hs-input-number>
                                            <div class="flex items-center gap-x-1.5">
                                                <button type="button"
                                                    class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none "
                                                    data-hs-input-number-decrement
                                                    onclick="decrementValue_<?php echo $pd_id; ?>()">
                                                    <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14" />
                                                    </svg>
                                                </button>
                                                <input
                                                    class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0"
                                                    type="text" name="pd_qty" value="1" data-hs-input-number-input
                                                    max="<?php echo $pd_quantity; ?>" id="quantity_<?php echo $pd_id; ?>"
                                                    onkeydown="return false">
                                                <button type="button"
                                                    class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                    data-hs-input-number-increment
                                                    onclick="incrementValue_<?php echo $pd_id; ?>()">
                                                    <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14" />
                                                        <path d="M12 5v14" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="pd_id" value="<?php echo $pd_id; ?>">
                                        <input type="hidden" name="pd_ps_email" value="<?php echo $ps_email; ?>">
                                        <input type="hidden" name="pd_ct_email" value="<?php echo $email; ?>">
                                        <input type="hidden" name="pd_price" value="<?php echo $pd_price; ?>">
                                        <button type="submit"
                                            class="flex justify-center items-center w-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg ml-2.5">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 5h4m-2 2V3M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.938-11H17l-2 7H5m0 0L3 4m0 0h2M3 4l-.792-3H1" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>



                            </div>
                        </div>
                        <script>
                            function incrementValue_<?php echo $pd_id; ?>() {
                                var inputElement = document.getElementById('quantity_<?php echo $pd_id; ?>');
                                var currentValue = parseInt(inputElement.value, 10);
                                var maxValue = parseInt(inputElement.max, 10);

                                // Check if the current value is less than the maximum allowed value
                                if (currentValue < maxValue) {
                                    inputElement.value = currentValue + 1;
                                }
                            }

                            function decrementValue_<?php echo $pd_id; ?>() {
                                var inputElement = document.getElementById('quantity_<?php echo $pd_id; ?>');
                                var currentValue = parseInt(inputElement.value, 10);

                                // Ensure the value doesn't go below the minimum allowed value (1)
                                if (currentValue > 1) {
                                    inputElement.value = currentValue - 1;
                                }
                            }
                        </script>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="w-fit mb-72 mx-auto">
                No Product Yet
            </div>
            <?php
        }
        ?>

    </section>


    <!-- benda bawah ni kena bubuh dalam semua page content -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection and configuration
        include 'includes/db.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $ps_email = $_POST['ps_email'];
        $email = $_POST['email'];
        $pd_name = $_POST['pd_name'];
        $desc = $_POST['desc'];

        $uploadDirectory = '../img/';

        foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["files"]["name"][$key];
            $file_type = $_FILES["files"]["type"][$key];
            $file_size = $_FILES["files"]["size"][$key];

            // Generate a unique identifier and append it to the original file name
            $new_file_name = $email . '_' . $file_name;

            $file_path = $uploadDirectory . $new_file_name;

            move_uploaded_file($tmp_name, $file_path);
        }


        // Insert data into the "request" table
        $insert_sql = "INSERT INTO request (rq_pd_name, rq_desc, rq_img, rq_ct_email, rq_ps_email) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssss", $pd_name, $desc, $file_path, $email, $ps_email);

        if ($insert_stmt->execute()) {
            // Registration successful
            echo '<script>alert("Request send successfully")</script>';
        } else {
            // Registration failed
            echo '<script>alert("Operation failed. Please try again.")</script>';
        }

        // Close the prepared statements
        // Close the prepared statement
        $insert_stmt->close();

    }
    // Close the database connection
    $conn->close();
    ?>
</div>

<script>
    document.getElementById('settings-tab').innerText = "Review (<?php echo $review_count; ?>)";
</script>
<!-- Add these scripts at the end of your HTML body -->
<!-- Add these scripts at the end of your HTML body -->
<!-- Add these scripts at the end of your HTML body -->
<script>
    const productList = document.querySelector('.productList');
    const productWidth = document.querySelector('.flex-shrink-0').offsetWidth;

    function changeProduct(direction) {
        const scrollAmount = direction * productWidth;
        productList.scrollBy({ left: scrollAmount, behavior: 'smooth' });

        // Check if scrolled to the end, and adjust scroll position accordingly
        if (direction === 1 && productList.scrollLeft + productList.clientWidth >= productList.scrollWidth) {
            productList.scrollTo({ left: 0, behavior: 'smooth' });
        } else if (direction === -1 && productList.scrollLeft === 0) {
            productList.scrollTo({ left: productList.scrollWidth, behavior: 'smooth' });
        }
    }
</script>









</body>

</html>
<?php
include 'includes/footer.php';
?>