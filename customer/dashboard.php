<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<?php
session_start();
$email = $_SESSION['email'];
$username = $_SESSION['username'];

include 'includes/db.php';
// Select data from the table
$selectQuery = "SELECT * FROM customer WHERE ct_email = '$email'";
$result = $conn->query($selectQuery);
?>
<?php
// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data from each row
    while ($row = $result->fetch_assoc()) {
        // Process data or store it in an array for later use
        $ct_email = $row['ct_email'];
        $ct_username = $row['ct_username'];
        $ct_first_name = $row['ct_first_name'];
        $ct_last_name = $row['ct_last_name'];
        $ct_phnum = $row['ct_phnum'];
        $ct_address = $row['ct_address'];
        $ct_img = $row['ct_img'];
        ?>
        <main class="flex-grow p-4">
            <div class="w-full">
                <div class="flex flex-col items-center pb-10">
                    <div class="mt-10 w-36 h-36 mb-3 rounded-full shadow-lg overflow-hidden">
                        <img src="<?php echo $ct_img;?>" alt="Image" class="object-cover w-full h-full">
                    </div>
                    <h5 class="mb-1 text-xl font-medium text-gray-900"><?php echo $ct_username; ?></h5>
                    <span class="text-sm text-gray-500"><?php echo $ct_email; ?></span>
                    <div class="flex mt-4 md:mt-6">
                        <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Edit Profile</a>
                    </div>
                    <dl class="w-full p-20 text-gray-900 divide-y divide-gray-200">
                    <div class="flex flex-col py-3">
                        <dt class="mb-1 text-gray-500 md:text-lg">Name</dt>
                        <dd class="text-lg font-semibold"><?php echo $ct_first_name.' '.$ct_last_name; ?></dd>
                    </div>
                    <div class="flex flex-col py-3">
                        <dt class="mb-1 text-gray-500 md:text-lg">Phone Number</dt>
                        <dd class="text-lg font-semibold"><?php echo $ct_phnum; ?></dd>
                    </div>
                    <div class="flex flex-col py-3">
                        <dt class="mb-1 text-gray-500 md:text-lg">Home address</dt>
                        <dd class="text-lg font-semibold"><?php echo $ct_address; ?></dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg"></dt>
                    </div>
                </dl>
                </div>
            </div>
    </main>
    <?php
    }
} else {
    echo "No records found";
}

// Close the database connection
$conn->close();

?>



<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>