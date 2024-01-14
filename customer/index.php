<?php
session_start();
include 'includes/header.php';

$email = $_SESSION['email'];
$username = $_SESSION['username'];

include 'includes/db.php';

// Retrieve the search query from the URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchCondition = '';

// If a search query is provided, construct a condition for the SQL query
if (!empty($searchQuery)) {
    $searchCondition = "WHERE ps_username LIKE '%$searchQuery%' OR ps_expertise LIKE '%$searchQuery%'";
}

// Select data from the table with the search condition
$selectQuery = "SELECT ps.*, AVG(rv.rv_rating) AS avg_rating
FROM personalshopper ps
LEFT JOIN review rv ON ps.ps_email = rv.rv_ps_email
GROUP BY ps.ps_email, ps.ps_username, ps.ps_first_name, ps.ps_last_name $searchCondition";
$result = $conn->query($selectQuery);
$ps_rating = 0;
?>

<div class="mt-32 h-auto mb-5 items-center" id="filteredContent">
    <?php
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
            $ps_rating = $row['avg_rating'];
            $ps_area = $row['ps_area'];
            $ps_order_count = $row['ps_order_count'];
            $ps_fee = $row['ps_fee'];
            $ps_availability = $row['ps_availability'];
            $ps_img = $row['ps_img'];
            ?>
            <div class="flex justify-center">
                <div
                    class="w-1/2 mt-1 mb-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex">
                        <div class="flex w-48 p-3">
                            <a href="ps_details.php?ps_email=<?php echo $ps_email; ?>">
                                <img class="rounded" src="<?php echo $ps_img; ?>" alt="product image" />
                            </a>
                        </div>
                        <div class="flex-grow px-5 py-5">
                            <a href="ps_details.php?ps_email=<?php echo $ps_email; ?>">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
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
                                        echo '<svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>';
                                    }
                                    echo '</div>';
                                } else {
                                    echo '</div>';
                                }
                                ?>
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">
                                    <?php echo number_format($ps_rating,1); ?>
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">RM
                                    <?php echo number_format($ps_fee, 2); ?><span class="text-sm text-gray-500"> (service
                                        fee)</span>
                                </span>
                                <button
                                    class="block text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700"
                                    type="button" onClick="parent.location='ps_details.php?ps_email=<?php echo $ps_email; ?>'">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No records found";
    }

    // Close the database connection
    $conn->close();

    ?>
</div>



<script>
    const requestButton = document.querySelector('[data-modal-toggle="request_modal"]');
    const requestModal = document.getElementById('request_modal');
    const requestCloseButton = requestModal.querySelector('[data-modal-hide="request_modal"]');

    const openRequestModal = () => {
        requestModal.classList.remove('hidden');
        requestModal.setAttribute('aria-hidden', 'false');
        // Additional actions for the request modal open state
    };

    const closeRequestModal = () => {
        requestModal.classList.add('hidden');
        requestModal.setAttribute('aria-hidden', 'true');
        // Additional actions for the request modal close state
    };

    requestButton.addEventListener('click', openRequestModal);
    requestCloseButton.addEventListener('click', closeRequestModal);
</script>

<!-- benda bawah ni kena bubuh dalam semua page content -->

</div>
<?php
include 'includes/footer.php';
?>
</body>

</html>