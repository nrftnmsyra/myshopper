<?php
session_start();
  // Handle the case when session variables are not set
  // Redirect to an error page or set default values
  $email = $_SESSION['email'];
  $ProductIds = $_SESSION['checkoutIds'];
  $total_price = 0;
  
  // Include the database connection file
  include 'includes/db.php';
  
  // Loop through each product ID and add a condition to the array
  foreach ($ProductIds as $productId) {
  // Build the SQL query with the dynamic conditions
  $order_pd_ids[] = $productId;
  $query = "SELECT o.*, p.pd_name, p.pd_img, c.*
            FROM orders o
            JOIN product p ON o.order_pd_id = p.pd_id
            JOIN cart c ON p.pd_id = c.cart_pd_id
            WHERE o.order_ct_email = '$email' AND c.cart_ct_email = '$email' AND o.order_pd_id = '$productId'";

$result = mysqli_query($conn, $query);
?>
<form action="invoice.php" method="post">
          <input type="text" name="pt_date" value="<?php echo date("Y/m/d"); ?>">
          <input type="text" name="pt_time" value="<?php echo date("h:i:sa"); ?>">
          <input type="text" name="pt_method" value="card">
          <input type="text" name="pt_status" value="succeed">
          <input type="text" name="pt_total_price" value="<?php echo $total_price; ?>">
          <input type="text" name="pt_ct_email" value="<?php echo $email; ?>">
          <?php
          // Add a hidden input field to store the array of order_pd_id values
          foreach ($order_pd_ids as $order_pd_id) {
              echo '<input type="text" name="order_pd_ids[]" value="' . $order_pd_id . '">';
          }
          ?>
        <button type="submit" class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place Order</button>
        </form>
<?php
  }
  ?>