<?php
session_start();

include 'includes/db.php';
$orderCode = 'nrftn@gmail.com1700966275';
$ct_email = 'nrftnmsyra@gmail.com';
$tracking_no = '19393857937293';
$name = 'atin';
// Retrieve customer email
$getEmailQuery = "SELECT ct_first_name, ct_last_name, order_ct_email, order_tracking_no FROM orders JOIN customer ON orders.order_ct_email = customer.ct_email WHERE order_code = ?";
$stmtEmail = $conn->prepare($getEmailQuery);
$stmtEmail->bind_param("s", $orderCode);
$stmtEmail->execute();
$resultEmail = $stmtEmail->get_result();

if ($resultEmail->num_rows > 0) {
    $rowEmail = $resultEmail->fetch_assoc();
    $tracking_no = $rowEmail['order_tracking_no'];
    $ct_email = $rowEmail['order_ct_email'];
    $first = $rowEmail['ct_first_name'];
    $last = $rowEmail['ct_last_name'];
    $name = $first . ' ' . $last;

    ?>
    <!-- modify this form HTML and place wherever you want your form -->

    <?php
}

$stmtEmail->close();
// The update was successful
$conn->close();


?>
<form id="myForm" action="https://formspree.io/f/xzbnzgyr" method="POST">
    <input type="email" name="email" value="<?php echo $ct_email; ?>">
    <input type="text" name="message"
        value="Dear <?php echo $name; ?>,Your order with tracking number <?php echo $tracking_no; ?> has been shipped and will be delivered in 3 days. Thank you for shopping with us!"></textarea>
    <!-- your other form fields go here -->
    <button type="submit">Send</button>
</form>
<script>
    // You can use JavaScript to automatically submit the form


    // After the form is submitted, redirect to order.php
    // window.location.href = 'order.php';
</script>