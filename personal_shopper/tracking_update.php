<?php
session_start();

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderCode = $_POST["order_code"];
    $trackingNumber = $_POST["tracking_number"];
    $order_status = "To Receive";

    // Update the order_tracking_no in the database
    $updateQuery = "UPDATE orders SET order_tracking_no = ?, order_status=? WHERE order_code = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sss", $trackingNumber, $order_status, $orderCode);

    if ($stmt->execute()) {

        // Retrieve customer email
        $getEmailQuery = "SELECT ct_first_name, ct_last_name, order_ct_email, order_tracking_no FROM orders JOIN customer ON orders.order_ct_email = customer.ct_email WHERE order_code = ?";
        $stmtEmail = $conn->prepare($getEmailQuery);
        $stmtEmail->bind_param("s", $orderCode);
        $stmtEmail->execute();
        $resultEmail = $stmtEmail->get_result();

        if ($resultEmail->num_rows > 0) {
            $rowEmail = $resultEmail->fetch_assoc();
            $tracking_no = $rowEmail['order_tracking_no'];
            $first = $rowEmail['ct_first_name'];
            $last = $rowEmail['ct_last_name'];
            $name = $first . ' ' . $last;

            echo '<script>alert("Tracking number added successfully"); window.location = "order.php";</script>';
        }
    }
    $stmtEmail->close();
    // The update was successful


    $stmt->close();
    $conn->close();
}

?>