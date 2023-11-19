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
<div><?php echo $email; ?></div>
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
            <div id="ordersContent" class="rounded-lg p-4">
                <h1 class="text-2xl font-bold mb-4">Profile</h1>
                <form action="" method="post">
                <img class="pb-5 rounded-t-lg" src="<?php echo $ct_img;?>" alt="product image" />
                <p>Username : <?php echo $ct_username; ?></p>
                <p>Name : <?php echo $ct_first_name.' '.$ct_last_name; ?></p>
                <p>Email : <?php echo $ct_email; ?></p>
                <p>Phone Number : <?php echo $ct_phnum; ?></p>
                <p>Address : <?php echo $ct_address; ?></p>
                <button class="block text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700" type="button">
                    Edit Profile
                </button>
                </form>
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