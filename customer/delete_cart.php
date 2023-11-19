<?php
// Assuming you have a database connection established
include 'includes/db.php';
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID and customer email from the request
    $productId = $_POST['delete_id'];
    $email = $_POST['delete_email'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_ct_email = ? AND cart_pd_id = ?");
    $stmt->bind_param("ss", $email, $productId);

    if ($stmt->execute()) {
        // Registration successful
        echo '<script>alert("Deleted successfully.")</script>';
        header("Location: cart.php");
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
