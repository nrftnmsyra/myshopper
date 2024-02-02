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
    <div class="p-4 sm:ml-52 bg-gray-900 h-100">
        <!-- wajib letak -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-20">
            <h1 class="text-4xl font-bold mb-4 text-white">Review</h1>
            <div
                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-gray-900">
                <div class="relative">
                    <input id="filter-date" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2"
                        placeholder="Select date start">
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search-users"
                        class="block p-2 ps-10 text-sm border rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for reviews">
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Customer Details
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Order ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Review
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rating
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        session_start();
                        $email = $_SESSION['email'];
                        $review_count = 0;
                        include 'includes/db.php';
                        // Select data from the table
                        // Get the product ID and customer email from the request
                        $selectReview = "SELECT *, COUNT(*) OVER() AS row_count
                        FROM review
                        JOIN customer ON review.rv_ct_email = customer.ct_email JOIN orders ON review.rv_order_id = orders.order_id JOIN product ON orders.order_pd_id = product.pd_id
                        WHERE rv_ps_email = '$email'";
                        $resultR = $conn->query($selectReview);
                        // Check if there are rows in the result
                        if ($resultR->num_rows > 0) {
                            // Fetch data from each row
                            while ($rowR = $resultR->fetch_assoc()) {
                                // Process data or store it in an array for later use
                                global $r;
                                $order_id = $rowR['order_id'];
                                $pd_name = $rowR['pd_name'];
                                $ct_username = $rowR['ct_username'];
                                $ct_email = $rowR['ct_email'];
                                $ct_img = $rowR['ct_img'];
                                $rv_rating = $rowR['rv_rating'];
                                $date = new DateTime($rowR['rv_date']);
                                $rv_date = date_format($date, "M d, Y");
                                $rv_desc = $rowR['rv_description'];
                                $rv_id = $rowR['rv_id'];
                                $review_count = $rowR['row_count'];
                                ?>
                                <tr class="border-b bg-gray-800 border-gray-700">
                                    <td class="px-6 py-4 font-semibold text-xl text-white p-4 ct-username">
                                        <?php echo $ct_username; ?>
                                        <p class="py-2.5 font-normal text-xs text-white ct-email">
                                            <?php echo $ct_email; ?>
                                        <p>
                                    </td>
                                    <td class="text-center px-6 py-4 text-white">
                                        <?php echo $order_id; ?>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-white pd-name">
                                        <?php echo $pd_name; ?>
                                        <p class="py-2.5 font-normal text-xs text-white rv-desc">
                                            <?php echo $rv_desc; ?>
                                        <p>
                                        <div>
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
                                                    <a id="openModal_<?php echo $ref_id; ?>">
                                                        <img src="<?php echo $img_path; ?>" id="img_<?php echo $ref_id; ?>"
                                                            class="w-16 md:w-32 max-w-full max-h-full rounded mr-2.5"
                                                            alt="image description">
                                                    </a>

                                                    <!-- Modal container -->
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
                                            } ?>
                                        </div>
                                    </td>
                                    <td class="text-center px-6 py-4">
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
                                    </td>
                                    <td class="text-center px-6 py-4 rv-date"
                                        data-date="<?php echo date_format($date, "Y-m-d"); ?>">
                                        <?php echo $rv_date; ?>
                                    </td>

                                </tr>
                                <?php
                            }
                        
                        
                    } else {
                        echo "<tbody>";
                        echo "<tr class='border-b bg-gray-800 border-gray-700 hover:bg-gray-900'>";
                        echo "<td colspan='5' class='px-6 py-4 text-center'>No Review Found</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                        
                        ?>
                    </tbody>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const searchInput = document.getElementById('table-search-users');
                            const filterDateInput = document.getElementById('filter-date');
                            const tableRows = document.querySelectorAll('tbody tr');

                            function filterRows() {
                                const searchTerm = searchInput.value.toLowerCase();
                                const filterDate = filterDateInput.value;

                                tableRows.forEach(function (row) {
                                    const username = row.querySelector('.ct-username').innerText.toLowerCase();
                                    const email = row.querySelector('.ct-email').innerText.toLowerCase();
                                    const productName = row.querySelector('.pd-name').innerText.toLowerCase();
                                    const description = row.querySelector('.rv-desc').innerText.toLowerCase();
                                    const rowDate = row.querySelector('.rv-date').getAttribute('data-date');

                                    const dateMatches = !filterDate || rowDate === filterDate;

                                    if (
                                        (username.includes(searchTerm) ||
                                            email.includes(searchTerm) ||
                                            productName.includes(searchTerm) ||
                                            description.includes(searchTerm)) &&
                                        dateMatches
                                    ) {
                                        row.style.display = '';
                                    } else {
                                        row.style.display = 'none';
                                    }
                                });
                            }

                            searchInput.addEventListener('input', filterRows);
                            filterDateInput.addEventListener('input', filterRows);
                        });
                    </script>



                </table>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>
<!-- wajib letak -->
</div>

</html>