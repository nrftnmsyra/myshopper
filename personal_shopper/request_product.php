<?php
// update_status.php
session_start();
$email = $_SESSION['email'];

// Include your database connection file
include 'includes/db.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request ID and selected status from the POST data
    $rqId = $_POST['rqId'];

    $pd_ps_email = $_POST['pd_ps_email'];
    $pd_name = $_POST['pd_name'];
    $pd_price = $_POST['pd_price'];
    $pd_quantity = $_POST['pd_quantity'];
    $pd_description = $_POST['pd_description'];
    $pd_img = $_POST['pd_img'];
    $pd_availability = 1; // Assuming availability is 1 for available
    $pd_type = "request"; // Assuming product type is 'shopper'

    // Prepare and execute the SQL query
    $sql = "INSERT INTO product (pd_ps_email, pd_name, pd_price, pd_quantity, pd_description, pd_img, pd_availability, pd_type, pd_rq_id)
        VALUES ('$pd_ps_email', '$pd_name', $pd_price, $pd_quantity, '$pd_description', '$pd_img', $pd_availability, '$pd_type', $rqId)";

    if ($conn->query($sql) === TRUE) {
        header("Location: request.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Free the result set
    $result->free();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close the database connection
$conn->close();
?>