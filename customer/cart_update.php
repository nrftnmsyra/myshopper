
<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Assuming you have the following variables set from the POST request
$newQuantity = $_POST['quantity'];
$cartPdId = $_POST['cartPdId'];

// Prepare and execute the update statement
$updateQuery = "UPDATE cart SET cart_qty = ? WHERE cart_pd_id = ?";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bind_param("ii", $newQuantity, $cartPdId);

if ($updateStmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

// Exit to avoid additional output
exit();
}
?>
?>
