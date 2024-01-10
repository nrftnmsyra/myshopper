<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<main class="flex-grow p-4">
    <div id="ordersContent" class="rounded-lg p-4">
        <h1 class="text-4xl font-bold mb-4">Requests</h1>
        <?php
        session_start();
        $email = $_SESSION['email'];

        include 'includes/db.php';
        // Select data from the table
        $selectQuery = "SELECT * FROM request WHERE rq_ct_email = '$email'";
        $result = $conn->query($selectQuery);
        ?>
        <!-- <div><?php echo $email; ?></div> -->
        <?php
        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            // Fetch data from each row
            while ($row = $result->fetch_assoc()) {

                $rq_id = $row['rq_id'];
                $rq_pd_name = $row['rq_pd_name'];
                $rq_desc = $row['rq_desc'];
                $rq_img = $row['rq_img'];
                ?>
                <div
                    class="flex max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-2">
                    <div class="flex-1">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <?php echo $rq_pd_name; ?>
                        </h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            <?php echo $rq_desc; ?>
                        </p>
                        <a href="#" class="ml-2" id="openModal_<?php echo $rq_id; ?>">
                            <div class="inline-block border border-gray-500 rounded p-2 mt-3">
                                <p class="text-xs text-gray-500 focus:outline-none flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                    </svg>&nbsp; Attachment
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Delete Trash Icon -->
                    <button class="ml-2 text-gray-500 hover:text-red-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>



                <!-- Modal container -->
                <div id="imageModal_<?php echo $rq_id; ?>"
                    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                    <!-- Modal content -->
                    <div class="bg-white p-4 rounded-md shadow-md max-w-md w-full mx-auto relative">
                        <!-- Close button (x icon) -->
                        <span class="cursor-pointer absolute top-0.5 right-2 text-gray-800 hover:text-red-500 text-4xl"
                            id="closeModal_<?php echo $rq_id; ?>">&times;</span>
                        <!-- Image container -->
                        <div id="modalContent_<?php echo $rq_id; ?>"><img class="pb-5 rounded-t-lg" src="<?php echo $rq_img; ?>"
                                alt="product image" /></div>
                    </div>
                </div>




                <script>
                    // JavaScript to handle modal functionality for each row
                    document.getElementById('openModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                        document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.remove('hidden');
                    });

                    document.getElementById('closeModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                        document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.add('hidden');
                    });
                </script>
                <?php

            }
        }
        ?>

    </div>
</main>


<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>