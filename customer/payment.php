<?php include 'includes/header.php'; ?>
<main class="flex-grow p-4">
      <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
        <div class="px-4 pt-8">
          <p class="text-xl font-medium">Order Summary</p>
          <p class="text-gray-400">Please check your items before placing the order.</p>
          <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['checkoutIds'])) {
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

// Check if the query was successful
if ($result) {
            // Loop through the fetched data and display it in the order summary div
            while ($row = mysqli_fetch_assoc($result)) {
              $pro_id = $row['order_pd_id'];
              $total_price = $total_price + $row['cart_pd_price'];
                ?>
                <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                    <img class="m-2 h-24 w-28 rounded-md border object-cover object-center" src="<?php echo $row['pd_img']; ?>" alt="" />
                    <div class="flex w-full flex-col px-4 py-4">
                        <span class="font-semibold"><?php echo $row['pd_name']; ?></span>
                        <span class="float-right text-gray-400">Quantity : <?php echo $row['order_pd_qty']; ?></span>
                        <p class="text-lg font-bold">RM<?php echo number_format($row['cart_pd_price'],2); ?></p>
                    </div>
                </div>
            <?php
            }
            }
          }
            ?>
        </div>
    </div>
    <?php
} else {
    // Handle the case when the query fails
    echo "Error fetching order data: " . mysqli_error($conn);
}
// Close the database connection
mysqli_close($conn);
?>
    <!-- The rest of your HTML code -->
      <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-10 mb-10">
        <p class="text-xl font-medium">Payment Details</p>
        <p class="text-gray-400">Complete your order by providing your payment details.</p>
          <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
          <div class="flex items-center rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm focus-within:border-blue-500 focus-within:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
            <input type="text" id="email" name="email" class="w-full outline-none focus:outline-none" placeholder="your.email@gmail.com" />
          </div>
          <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Card Holder</label>
          <div class="flex items-center rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm focus-within:border-blue-500 focus-within:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
            </svg>
            <input type="text" id="card-holder" name="card-holder" class="w-full outline-none focus:outline-none" placeholder="Your full name here" />
          </div>
          <label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Card Details</label>
          <div class="flex items-center">
            <input type="text" id="card-no" name="card-no" class="w-full rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-0 focus:border-blue-500 focus:ring-blue-500" placeholder="xxxx-xxxx-xxxx-xxxx" />
            <div class="flex items-center">
            </div>
            <input type="text" name="credit-expiry" class="w-full rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-0 focus:border-blue-500 focus:ring-blue-500" placeholder="MM/YY" />
            <input type="text" name="credit-cvc" class="w-1/6 flex-shrink-0 rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-0 focus:border-blue-500 focus:ring-blue-500" placeholder="CVC" />
          </div>



          <label for="billing-address" class="mt-4 mb-2 block text-sm font-medium">Billing Address</label>
          <div class="flex flex-col sm:flex-row">
            <div class="relative flex-shrink-0 sm:w-7/12">
              <input type="text" id="billing-address" name="billing-address" class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-0 focus:border-blue-500 focus:ring-blue-500" placeholder="Street Address" />
            </div>
            <select type="text" name="billing-state" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-0 focus:border-blue-500 focus:ring-blue-500">
              <option value="State">State</option>
            </select>
            <input type="text" name="billing-zip" class="flex-shrink-0 rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none sm:w-1/6 focus:z-0 focus:border-blue-500 focus:ring-blue-500" placeholder="ZIP" />
          </div>


        <!-- Total -->
        <div class="mt-6 border-t border-b py-2">
          <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Subtotal</p>
            <p class="font-semibold text-gray-900">RM<?php echo number_format($total_price,2);?></p>
          </div>
          <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Shipping</p>
            <p class="font-semibold text-gray-900">RM8.00</p>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-between">
          <p class="text-sm font-medium text-gray-900">Total</p>
          <p class="text-2xl font-semibold text-gray-900">RM<?php echo $total_payment=number_format($total_price+8.00,2);?></p>
        </div>
        <form action="invoice.php" method="post">
          <input type="text" name="pt_date" value="<?php echo date("Y/m/d"); ?>">
          <input type="text" name="" value="<?php echo $pro_id; ?>">
          <input type="text" name="pt_time" value="<?php echo date("h:i:sa"); ?>">
          <input type="text" name="pt_method" value="card">
          <input type="text" name="pt_status" value="succeed">
          <input type="text" name="pt_total_price" value="<?php echo $total_payment; ?>">
          <input type="text" name="pt_ct_email" value="<?php echo $email; ?>">
          <?php
          // Add a hidden input field to store the array of order_pd_id values
          foreach ($order_pd_ids as $order_pd_id) {
              echo '<input type="hidden" name="order_pd_ids[]" value="' . $order_pd_id . '">';
          }
          ?>
        <button type="submit" class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place Order</button>
        </form>
      </div>
</div>
</div>
</main>

<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
