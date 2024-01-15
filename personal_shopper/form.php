<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Send Email in PHP using PHPMailer and Gmail</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="info">
            Send an email to your self
        </div>

        <label>Enter your email</label>
        <input type="email" name="email" value="">

        <label>Enter a subject</label>
        <input type="text" name="subject" value="">

        <label>Enter your message</label>
        <textarea name="message"></textarea>

        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html> -->

<?php
include 'includes/db.php';
if (isset($_GET['order_code'])) {
    // Get the product ID and customer email from the request
    $orderCode = $_GET['order_code'];
    $order_notify = 1;
    $updateQuery = "UPDATE orders SET order_notify = ? WHERE order_code = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("is", $order_notify, $orderCode);
    $stmt->execute();

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
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <form id="myForm" action="" class="hidden" method="POST">
        <input type="hidden" name="email" value="<?php echo $ct_email; ?>">
        <input type="hidden" name="subject" value="Your order has been shipped!">
        <input type="hidden" name="message"
            value="Dear <?php echo $name; ?>, Your order with tracking number <?php echo $tracking_no; ?> has been shipped and will be delivered in 3 days. Thank you for shopping with us!"></textarea>
        <!-- your other form fields go here -->
        <button id="myButton" onclick="buttonClick()" type="submit" name="submit" class="hidden">Send</button>
    </form>
    <script>
        // Function to handle the button click
        function buttonClick() {
            header("Location: order.php");
        }

        // Automatically click the button when the page is loaded
        window.addEventListener("load", function () {
            document.getElementById("myButton").click();
        });
    </script>
    <?php require("script.php"); ?>
    <?php
    if (isset($_POST['submit'])) {
        if (empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
            $response = "All fields are required";
        } else {
            $response = sendMail($_POST['email'], $_POST['subject'], $_POST['message']);
        }
    }
}
?>