<?php
// Assuming you have a database connection established
include 'includes/db.php';
// Check if the request method is POST
if (isset($_GET['delete_id']) && isset($_GET['delete_email'])) {
    // Get the product ID and customer email from the request
    $productId = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM product WHERE pd_id = ?");
    $stmt->bind_param("s", $productId);

    if ($stmt->execute()) {
        // Registration successful
        echo '<script>alert("Product deleted successfully"); window.location = "product.php";</script>';
        exit();
    } else {
        // Registration failed
        echo '<script>alert("failed. Please try again.")</script>';
    }

    // Close the prepared statements
    $stmt->close();
}
// Close the database connection
$conn->close();
?>