<?php 
include 'includes/header.php'; ?>

<div class="flex justify-center mt-10 mb-2">
    <!-- Change the Exit button to use an exit icon -->
    <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center mr-2 mt-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 1a9 9 0 1 1 0 18 9 9 0 0 1 0-18zm0 2a7 7 0 1 0 0 14 7 7 0 0 0 0-14zm0 3a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0V7a1 1 0 0 1 1-1zm0 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        Exit
    </a>

    <!-- Move the Save as PDF button to the top right -->
    <button onclick="printDiv('contentToPrint')" class="bg-green-500 text-white px-4 py-2 rounded-md flex items-center mt-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-4V1a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1H3zm14 2H1v12h16V4zM5 6a1 1 0 0 0 0 2h10a1 1 0 1 0 0-2H5zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H5z"/>
        </svg>
        Save as PDF
    </button>
</div>
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

    $invoice_id = 0;
    $subtotal = 0;

    $orderstatus ='To Ship';

    $email = $_SESSION['email'];
    $order_code = $_SESSION['order_c'];
    
    $sqlpayment = "INSERT INTO payment (pt_date, pt_time, pt_method, pt_status, pt_total_price, pt_ct_email)
    VALUES ('$pt_date', '$pt_time', '$pt_method', '$pt_status', '$pt_total_price', '$pt_ct_email')";
    $conn->query($sqlpayment);

    $sqlInsert = "INSERT INTO invoice (iv_ct_email, iv_date, iv_order_code) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("sss",$pt_ct_email, $pt_date, $order_code);
    $stmtInsert->execute();

foreach ($ProductIds as $productId1) {

    $sqlSelectPID ="SELECT pt_id FROM payment WHERE pt_date=? AND pt_time=? AND pt_method=? AND pt_status=? AND pt_total_price=? AND pt_ct_email=?";
    $stmtselectpid = $conn->prepare($sqlSelectPID);
    $stmtselectpid->bind_param("ssssds",$pt_date, $pt_time, $pt_method, $pt_status, $pt_total_price, $pt_ct_email);
    $stmtselectpid->execute();
    $resultSelect = $stmtselectpid->get_result();

    if ($resultSelect->num_rows > 0) {
        $row1 = $resultSelect->fetch_assoc();
        $pt_id = $row1['pt_id'];

        $sqlstatus = "UPDATE orders SET order_status='$orderstatus', order_payment_id = '$pt_id'
        WHERE order_ct_email ='$pt_ct_email' AND order_pd_id = '$productId1'";
        $conn->query($sqlstatus);

        $sqlSelectIID ="SELECT iv_id FROM invoice WHERE iv_ct_email=? AND iv_order_code =?";
        $stmtselectiid = $conn->prepare($sqlSelectIID);
        $stmtselectiid->bind_param("ss",$pt_ct_email, $order_code);
        $stmtselectiid->execute();
        $resultSelectiid = $stmtselectiid->get_result();

        if ($resultSelectiid->num_rows > 0) {
            $row2 = $resultSelectiid->fetch_assoc();
            $iv_id = $row2['iv_id'];
            $GLOBALS['invoice_id'] = $iv_id;

            $sqlinvoice = "UPDATE invoice SET iv_payment_id='$pt_id' WHERE iv_id = '$iv_id'";
            $conn->query($sqlinvoice);
        }
}
    $sqlupdate = "UPDATE orders SET order_invoice_id = '$iv_id'
    WHERE order_ct_email ='$pt_ct_email' AND order_pd_id = '$productId1'";
    $conn->query($sqlupdate);
    }
$conn->close();
?>

<?php
include 'includes/db.php';
$total = 0;

$selectQuery = "SELECT
                i.*,
                o.*,
                p.*,
                pr.*,
                c.*,
                ps.*
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
                o.order_ct_email = '$pt_ct_email' AND o.order_invoice_id ='$iv_id';
                ";

$resultQ = $conn->query($selectQuery);
// Check if there are rows in the result
if ($resultQ->num_rows > 0) {
    // Fetch data from each row
    $rowQ = $resultQ->fetch_assoc();
         ?>
        <main class="flex-grow p-4">
             <div id="contentToPrint" class="">
             <script src="https://cdn.tailwindcss.com"></script>
            <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
             <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
             <div class="flex items-center justify-between mb-8">
                 <div class="flex items-center">
                     <img class="h-8 w-8 mr-2" src="../assets/logo1.png"
                         alt="Logo" />
                     <div class="text-gray-700 font-semibold text-lg">myShopper</div>
                 </div>
                 <div class="text-gray-700">
                    <div class="font-bold text-xl mb-2">INVOICE</div>
                    <div class="text-sm">Date: <?php echo $rowQ['iv_date']; ?></div>
                    <div class="text-sm">Invoice #: INV<?php echo $rowQ['iv_id']; ?></div>
                </div>
             </div>
             <div class="border-b-2 border-gray-300 pb-8 mb-8">
                 <h2 class="text-2xl font-bold mb-4">Shop with <?php echo $rowQ['ps_username']; ?></h2>
                 <div class="text-gray-700 mb-2"><?php echo $rowQ['ct_first_name'].' '.$rowQ['ct_last_name']; ?></div>
                 <div class="text-gray-700 mb-2"><?php echo $rowQ['ct_address']; ?></div>
                 <div class="text-gray-700 mb-2"><?php echo $rowQ['ct_phnum']; ?></div>
                 <div class="text-gray-700"><?php echo $rowQ['ct_email']; ?></div>
             </div>
             <table class="w-full text-left mb-8">
                 <thead>
                     <tr>
                         <th class="text-gray-700 font-bold uppercase py-2">Description</th>
                         <th class="text-gray-700 font-bold uppercase py-2">Quantity</th>
                         <th class="text-gray-700 font-bold uppercase py-2">Price</th>
                         <th class="text-gray-700 font-bold uppercase py-2">Total</th>
                     </tr>
                 </thead>
                 <tbody>
         <?php
foreach ($ProductIds as $productId3) {
    // Build the SQL query with the dynamic conditions
    $queryP = "SELECT
                i.*,
                o.*,
                p.*,
                pr.*,
                c.*,
                ps.*
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
                o.order_ct_email = '$pt_ct_email' AND o.order_pd_id ='$productId3';
            ";
  
  $resultP = mysqli_query($conn, $queryP);
  
  // Check if the query was successful
  if ($resultP) {
              // Loop through the fetched data and display it in the order summary div
              while ($rowP = mysqli_fetch_assoc($resultP)) {
?>
            <tr>
                <td class="py-4 text-gray-700"><?php echo $rowP['pd_name']; ?></td>
                <td class="py-4 text-gray-700"><?php echo $rowP['order_pd_qty']; ?></td>
                <td class="py-4 text-gray-700">RM<?php echo number_format($rowP['order_total_price'],2); ?></td>
                <td class="py-4 text-gray-700">RM<?php echo number_format($total = $rowP['order_total_price']*$rowP['order_pd_qty'],2); ?></td>
            </tr>
<?php
            $GLOBALS['subtotal'] =  $GLOBALS['subtotal'] + ($rowP['order_total_price']*$rowP['order_pd_qty']);
    }
}
}
?>
        </tbody>
        </table>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Subtotal:</div>
            <div class="text-gray-700">RM<?php echo number_format($subtotal,2); ?></div>
        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Shipping:</div>
            <div class="text-gray-700">RM8.00</div>

        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">RM<?php echo number_format($rowQ['pt_total_price'],2); ?></div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-8">
            <div class="text-gray-700 mb-2">The order will be proceed after the invoice is generated.</div>
        </div>
    </div> 

<?php
}
}
?>

</div>
</div>

<?php 
include 'includes/footer.php'; ?>

</body>
</html>
<script>
        function printDiv(divId) {
            var content = document.getElementById(divId).innerHTML;
            var myWindow = window.open('', '', 'width=full,height=full');
            myWindow.document.open();
            myWindow.document.write('<html><head><title>Print</title></head><body>');
            myWindow.document.write(content);
            myWindow.document.write('</body></html>');
            myWindow.document.close();
            myWindow.print();
        }
</script>