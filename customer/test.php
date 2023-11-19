<?php 
// include 'includes/header.php'; ?>

<?php
session_start();
include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data and insert into the payment table
    $pt_date = $_POST['pt_date'];
    $pt_time = $_POST['pt_time'];
    $pt_method = $_POST['pt_method'];
    $pt_status = $_POST['pt_status'];
    $pt_total_price = $_POST['pt_total_price'];
    $pt_ct_email = $_POST['pt_ct_email'];
    $ProductIds =  $_POST['order_pd_ids'];

    $email = $_SESSION['email'];

    $orderstatus ='To Ship';
    
    $sqlpayment = "INSERT INTO payment (pt_date, pt_time, pt_method, pt_status, pt_total_price, pt_ct_email)
    VALUES ('$pt_date', '$pt_time', '$pt_method', '$pt_status', '$pt_total_price', '$pt_ct_email')";
    $conn->query($sqlpayment);

    $sqlInsert = "INSERT INTO invoice (iv_ct_email, iv_date) VALUES (?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("ss",$pt_ct_email, $pt_date);
    $stmtInsert->execute();

// foreach ($ProductIds as $productId1) {

$queryS = "	SELECT
            i.iv_id, p.pt_id, p.pt_ct_email, o.order_pd_id
            FROM
            invoice i
            JOIN
            orders o ON i.iv_id = o.order_invoice_id
            JOIN
            payment p ON o.order_payment_id = p.pt_id
            JOIN
            customer c ON p.pt_ct_email = c.ct_email
            JOIN
            personalshopper ps ON o.order_ps_email = ps.ps_email
            JOIN
            product pr ON o.order_pd_id = pr.pd_id
            WHERE
            o.order_ct_email = '$email' AND o.order_pd_id ='$productIds';
            ";

$resultS = $conn->query($queryS);
$pt_id = "";
$iv_id = "";
// Check if the query was successful
if ($resultS->num_rows > 0) {
    // Fetch data from each row

    while ($rowS = $resultS->fetch_assoc()) {

            $pt_id = $rowS['pt_id'];
            $iv_id = $rowS['iv_id'];
            ?>
            <input type="text" value="<?php echo $pt_id; ?>">
            <input type="text" value="<?php echo $iv_id; ?>">
            <div><?php echo $email; ?></div>
            <?php
            print_r($rowS);
            echo $pt_id;
            echo $iv_id;
          }
        }
        $sqlinvoice = "UPDATE invoice SET iv_payment_id='$pt_id' WHERE iv_id = '$iv_id'";
        $conn->query($sqlinvoice);
        // Close the statement and database connection
        
        // $sqlstatus = "UPDATE orders SET order_status='$orderstatus', order_payment_id = '$pt_id', order_invoice_id='$iv_id'
        // WHERE order_ct_email ='$pt_ct_email' AND order_pd_id = '$productId1'";
        // $conn->query($sqlstatus);
    }
$conn->close();
?>