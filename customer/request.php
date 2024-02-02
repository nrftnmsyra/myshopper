<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<main class="flex-grow p-4 mb-12">
    <div id="ordersContent" class="rounded-lg p-4">
        <h1 class="text-4xl font-bold mb-4">Requests</h1>
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
            <div class="">
                <select id="requestStatusFilter"
                    class="block w-full p-2 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                    onchange="filterCards()">
                    <option value="all" selected>All Requests</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="static">
                <div class="relative left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="mt-10 w-5 h-5 text-gray-400 absolute" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search-users"
                    class="block p-2 ps-10 text-sm border rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search for requests">
            </div>
        </div>
        <?php
        session_start();
        $email = $_SESSION['email'];

        include 'includes/db.php';
        // Select data from the table
        $selectQuery = "SELECT *
        FROM request
        LEFT JOIN product ON request.rq_id = product.pd_rq_id
        WHERE request.rq_ct_email = '$email'
        ORDER BY
            CASE WHEN request.rq_status = 'accepted' THEN 0 ELSE 1 END,
            request.rq_status,
            request.rq_date";
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
                $rq_status = $row['rq_status'];
                $rq_date = $row['rq_date'];
                $pd_name = $row['pd_name'];
                $pd_id = $row['pd_id'];
                $ps_email = $row['pd_ps_email'];
                $pd_qty = $row['pd_qty'];
                $pd_price = $row['pd_price'];

                if ($rq_status == 'accepted' && $pd_id != NULL) {
                    ?>
                    <div data-status="<?php echo $rq_status; ?>"
                        class="flex max-w-full p-6 border rounded-lg shadow bg-gray-800 border-gray-700 mb-2">
                        <!-- Delete Trash Icon -->
                        <button class="ml-2 mr-6 text-gray-500 hover:text-red-500 focus:outline-none"
                            onclick="redirectToRequestDelete('<?php echo $rq_id; ?>')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                        <div class="flex-1">
                            <span
                                class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 bg-green-800 text-green-400 border border-green-500 ">
                                <svg class="w-2.5 h-2.5 me-1.5 mt-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 18 21">
                                    <path
                                        d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                                </svg>
                                Request Accepted. Add to Cart now!
                            </span>
                            <h5 class="mb-2 mt-2.5 text-2xl font-bold tracking-tight text-white">
                                <?php echo $rq_pd_name; ?>
                            </h5>
                            <p class="font-normal text-gray-400">
                                <?php echo $rq_desc; ?>
                            </p>
                            <?php if ($rq_img != null) { ?>
                                <a href="#" class="" id="openModal_<?php echo $rq_id; ?>">
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
                            <?php } ?>
                            <p class="mt-2.5 text-xs text-gray-500 focus:outline-none flex items-center">
                                <?php echo $rq_date; ?>
                            </p>
                        </div>
                        <form class="my-auto" action="request_cart.php" method="post">
                            <input type="hidden" name="rq_id" value="<?php echo $rq_id; ?>">
                            <input type="hidden" name="pd_id_<?php echo $rq_id; ?>" value="<?php echo $pd_id; ?>">
                            <input type="hidden" name="pd_ps_email_<?php echo $rq_id; ?>" value="<?php echo $ps_email; ?>">
                            <input type="hidden" name="pd_qty_<?php echo $rq_id; ?>" value="1">
                            <input type="hidden" name="pd_price_<?php echo $rq_id; ?>" value="<?php echo $pd_price; ?>">
                            <input type="hidden" name="pd_ct_email_<?php echo $rq_id; ?>" value="<?php echo $email; ?>">
                            <button type="submit"
                                class="my-auto h-10 text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 21">
                                    <path
                                        d="M15 14H7.78l-.5-2H16a1 1 0 0 0 .962-.726l.473-1.655A2.968 2.968 0 0 1 16 10a3 3 0 0 1-3-3 3 3 0 0 1-3-3 2.97 2.97 0 0 1 .184-1H4.77L4.175.745A1 1 0 0 0 3.208 0H1a1 1 0 0 0 0 2h1.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 10 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3Zm-8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                    <path d="M19 3h-2V1a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V5h2a1 1 0 1 0 0-2Z" />
                                </svg> Add to Cart
                            </button>
                        </form>

                    </div>
                    <?php
                } else if ($rq_status == 'pending') {
                    ?>
                        <div data-status="<?php echo $rq_status; ?>"
                            class="flex max-w-full p-6 border rounded-lg shadow bg-gray-800 border-gray-700 mb-2">
                            <!-- Delete Trash Icon -->
                            <button class="ml-2 mr-6 text-gray-500 hover:text-red-500 focus:outline-none"
                                onclick="redirectToRequestDelete('<?php echo $rq_id; ?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                            <div class="flex-1">
                                <span
                                    class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 bg-gray-700 text-gray-400 border border-gray-500">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                    </svg>
                                    Request Pending
                                </span>
                                <h5 class="mb-2 mt-2.5 text-2xl font-bold tracking-tight text-white">
                                <?php echo $rq_pd_name; ?>
                                </h5>
                                <p class="font-normal text-gray-400">
                                <?php echo $rq_desc; ?>
                                </p>
                            <?php if ($rq_img != null) { ?>
                                    <a href="#" class="" id="openModal_<?php echo $rq_id; ?>">
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
                            <?php } ?>
                                <p class="mt-2.5 text-xs text-gray-500 focus:outline-none flex items-center">
                                <?php echo $rq_date; ?>
                                </p>
                            </div>
                        </div>
                    <?php
                } else if ($rq_status == 'rejected') {
                    ?>
                            <div data-status="<?php echo $rq_status; ?>"
                                class="flex max-w-full p-6 border rounded-lg shadow bg-gray-800 border-gray-700 mb-2">
                                <!-- Delete Trash Icon -->
                                <button class="ml-2 mr-6 text-gray-500 hover:text-red-500 focus:outline-none"
                                    onclick="redirectToRequestDelete('<?php echo $rq_id; ?>')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                                <div class="flex-1">
                                    <span
                                        class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 bg-red-900 text-red-300 border border-red-500 ">
                                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                                        </svg>
                                        Request Rejected
                                    </span>
                                    <h5 class="mb-2 mt-2.5 text-2xl font-bold tracking-tight text-white">
                                <?php echo $rq_pd_name; ?>
                                    </h5>
                                    <p class="font-normal text-gray-400">
                                <?php echo $rq_desc; ?>
                                    </p>
                            <?php if ($rq_img != null) { ?>
                                        <a href="#" class="" id="openModal_<?php echo $rq_id; ?>">
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
                            <?php } ?>
                                    <p class="mt-2.5 text-xs text-gray-500 focus:outline-none flex items-center">
                                <?php echo $rq_date; ?>
                                    </p>
                                </div>
                            </div>
                    <?php
                }
                ?>
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
                    function redirectToRequestDelete(variableValue) {
                        // Use window.location.href to navigate to the request_delete.php page with the variable in the URL
                        window.location.href = 'request_delete.php?rq_id=' + encodeURIComponent(variableValue);
                    }
                </script>


                <script>
                    // JavaScript to handle modal functionality for each row
                    document.getElementById('openModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                        document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.remove('hidden');
                    });

                    document.getElementById('closeModal_<?php echo $rq_id; ?>').addEventListener('click', function () {
                        document.getElementById('imageModal_<?php echo $rq_id; ?>').classList.add('hidden');
                    });
                </script>
                <script>
                    function filterCards() {
                        var selectedStatus = document.getElementById("requestStatusFilter").value;
                        var cards = document.querySelectorAll('.flex[data-status]');

                        cards.forEach(function (card) {
                            var cardStatus = card.getAttribute('data-status');

                            if (selectedStatus === 'all' || selectedStatus === cardStatus) {
                                card.style.display = 'flex';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    }
                </script>
                <!-- Add the following script after your existing scripts -->
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const requestStatusFilter = document.getElementById("requestStatusFilter");
                        const tableSearchUsers = document.getElementById("table-search-users");
                        const requestCards = document.querySelectorAll('.flex[data-status]');
                        var norequest = document.getElementById("noRequest");

                        var found = false;

                        // Function to handle filtering based on request status
                        function filterByStatus(selectedStatus) {
                            requestCards.forEach(function (card) {
                                const cardStatus = card.getAttribute("data-status");

                                if (selectedStatus === "all" || cardStatus === selectedStatus) {
                                    card.style.display = "flex";
                                    found = true;
                                } else {
                                    card.style.display = "none";
                                }
                            });
                        }

                        if (found) {
                            norequest.style.display = "none";
                        } else {
                            norequest.style.display = "";
                        }

                        // Function to handle filtering based on search input
                        function filterBySearch(searchTerm) {
                            const lowercasedSearchTerm = searchTerm.toLowerCase();

                            requestCards.forEach(function (card) {
                                const cardText = card.innerText.toLowerCase();

                                if (cardText.includes(lowercasedSearchTerm)) {
                                    card.style.display = "flex";
                                } else {
                                    card.style.display = "none";
                                }
                            });
                        }

                        // Event listener for request status filter
                        requestStatusFilter.addEventListener("change", function () {
                            const selectedStatus = requestStatusFilter.value.toLowerCase();
                            filterByStatus(selectedStatus);
                        });

                        // Event listener for search input
                        tableSearchUsers.addEventListener("input", function () {
                            const searchTerm = tableSearchUsers.value.trim();
                            filterBySearch(searchTerm);
                        });
                    });
                </script>

                <?php
            }
        } else {
            ?>
            <div id='noRequest' class="w-full h-max rounded-lg shadow bg-gray-800 border-gray-900 px-6 py-10">
                <h2 class="text-2xl text-center text-bold text-white mb-2.5">Oops, You doesn't Request Anything <p
                        class="pt-1 text-xs tracking-tight text-center text-white border-gray-600">Send a Request to our
                        shoppers now!</p>
                </h2>
                <button
                    class="block mx-auto item-center text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-500 hover:bg-blue-600 focus:ring-blue-700"
                    type="button" data-modal-target="request_modal" data-modal-toggle="request_modal">
                    + Request
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

</html>