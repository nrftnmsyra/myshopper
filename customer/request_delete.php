<?php
include 'includes/db.php';
// Assuming $rq_id is set, either from the URL parameter or elsewhere in your code
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['rq_id'])) {

    // Sanitize the input to prevent SQL injection
    $rq_id = mysqli_real_escape_string($conn, $_GET['rq_id']);

    // SQL DELETE query
    $sql = "DELETE FROM request WHERE rq_id = '$rq_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Product deleted successfully"); window.location = "../customer/request.php";</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request or rq_id not provided in the URL.";
}
?>