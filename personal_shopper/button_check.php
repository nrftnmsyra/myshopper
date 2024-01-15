<?php
// your_server_script.php

// Start or resume the session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle button click
    if (isset($_POST['clicked']) && $_POST['clicked']) {
        // Perform your desired actions (e.g., update database, log activity)

        // Set a flag in the session indicating the button has been clicked
        $_SESSION['buttonClicked'] = true;

        // Send a response back to the client
        echo json_encode(['success' => true]);
        exit();
    }
}

// If the request is not a valid POST request, return an error response
echo json_encode(['error' => 'Invalid request']);
exit();
?>
