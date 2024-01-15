<?php
session_start();

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $orderCode = $_GET["order_code"];
    $order_status = "Cancelled";

    // Update the order_tracking_no in the database
    $updateQuery = "UPDATE orders SET order_status=? WHERE order_code = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $order_status, $orderCode);

    if ($stmt->execute()) {


        header("Location: order_details.php?order_code=$orderCode");
    }
    $stmt->close();
    $conn->close();
}

?>