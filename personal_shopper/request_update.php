<?php
// update_status.php

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request ID and selected status from the POST data
    $rqId = $_POST['rqId'];
    $selectedStatus = $_POST['selectedStatus'];

    // Include your database connection file
    include 'includes/db.php';

    // Update the status in the database
    $updateQuery = "UPDATE request SET rq_status = '$selectedStatus' WHERE rq_id = $rqId";
    $conn->query($updateQuery);

    // Close the database connection
    $conn->close();

    // Send a response back to the JavaScript (optional)
    echo json_encode(['success' => true]);
} else {
    // Handle non-POST requests
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>