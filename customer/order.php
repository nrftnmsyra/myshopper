<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<main class="flex-grow p-4">
    <div id="ordersContent" class="rounded-lg p-4">
        <h1 class="text-2xl font-bold mb-4">Orders Content</h1>

        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-900 px-6 py-4">
            <div>
                <h2 class="text-2xl tracking-tight text-gray-900 dark:text-white font-bold border-b border-gray-600 p-3">PS_NAME</h2>
            </div>

            <a href="order_details.php" class="flex items-center bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                <div class="p-3 flex justify-center items-center">
                    <!-- Image -->
                    <img class="w-32 h-32 object-cover" src="assets/profile_pic.jpeg" alt="" />
                </div>

                <!-- Product Details -->
                <div class="p-5 w-full">
                    <div class="mb-2">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white transition duration-300 hover:text-gray-300">
                            Product Name
                        </h5>
                    </div>
                    <div>
                        <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Quantity: 5</p>
                        <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Status: To Ship</p>
                    </div>
                </div>

                <div class="flex items-center justify-center">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white whitespace-nowrap">Total: RM120</p>
                </div>
            </a>

            <div class="border-t border-gray-600 flex justify-end p-3">
                <button class="p-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</main>


<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>