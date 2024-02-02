<?php
// update_status.php
include 'includes/db.php';
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request ID and selected status from the POST data
    $rqId = $_POST['rq_id'];
    $selectedStatus = $_POST['selectedStatus'];

    // Include your database connection file


    // Update the status in the database
    $updateQuery = "UPDATE request SET rq_status = '$selectedStatus' WHERE rq_id = $rqId";
    $conn->query($updateQuery);

    // Close the database connection
    $conn->close();

    // Send a response back to the JavaScript (optional)
    echo '<script>alert("Request status updated successfully"); window.location = "request.php";</script>';
} else {
    // Handle non-POST requests
}
?>