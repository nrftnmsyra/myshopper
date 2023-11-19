<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection file (includes/db.php)
    include 'includes/db.php';

    // Retrieve user email from session
    $email = $_SESSION['email'];

    $order_date = date("Y/m/d");
    $order_time = date("h:i:sa");
    $order_status = "To Pay";
    $order_code = $_SESSION['email'] . time();
    $_SESSION['order_c'] = $order_code;

    // Get selected products for checkout
    if (isset($_POST['checkout_product']) && is_array($_POST['checkout_product'])) {
        $checkoutProducts = $_POST['checkout_product'];
        $_SESSION['checkoutIds'] = $checkoutProducts;
        //Group selected products by personal shopper
        $groupedProducts = array();
        foreach ($checkoutProducts as $productId) {
            $selectProductQuery = "SELECT
                product.pd_name,
                product.pd_ps_email,
                cart.cart_pd_id,
                cart.cart_qty,
                cart.cart_pd_price
                FROM
                cart
                JOIN
                product ON cart.cart_pd_id = product.pd_id
                WHERE
                cart.cart_ct_email = ? AND
                cart.cart_pd_id = ?";
            $stmtSelect = $conn->prepare($selectProductQuery);
            $stmtSelect->bind_param("si", $email, $productId);
            $stmtSelect->execute();
            $resultProduct = $stmtSelect->get_result();

            if ($resultProduct->num_rows > 0) {
                $rowProduct = $resultProduct->fetch_assoc();
                $psEmail = $rowProduct['pd_ps_email'];

                // Group products by personal shopper
                $groupedProducts[$psEmail][] = array(
                    'product_id' => $rowProduct['cart_pd_id'],
                    'quantity' => $rowProduct['cart_qty'],
                    'total_price' => $rowProduct['cart_pd_price']
                );
            }
        }

        // Insert orders into the database for each personal shopper
        foreach ($groupedProducts as $psEmail => $products) {
            // Calculate total price for the personal shopper's products
            $totalPrice = array_reduce($products, function ($carry, $product) {
                return $carry + ($product['total_price']);
            }, 0);

            // Insert order details into the orders table
            $insertOrderQuery = "INSERT INTO orders (order_code, order_ct_email, order_ps_email, order_pd_id, order_pd_qty, order_date, order_time, order_status,
            order_total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($insertOrderQuery);
            foreach ($products as $product) {
                $stmtInsert->bind_param("sssiisssd", $order_code, $email, $psEmail, $product['product_id'], $product['quantity'], $order_date, $order_time, $order_status, $product['total_price']);
                if (!$stmtInsert->execute()) {
                    die('Error: ' . $stmtInsert->error);
                }                
                $result = $stmtInsert->get_result();
            }
            $stmtInsert->close();
        }

        // Clear the cart after checkout (you may want to adapt this based on your logic)
        // foreach ($checkoutProducts as $productId) {
        // $clearCartQuery = "DELETE FROM cart WHERE cart_ct_email = ? AND cart_pd_id = ?";
        // $stmtClearCart = $conn->prepare($clearCartQuery);
        // $stmtClearCart->bind_param("si", $email, $productId);
        // $stmtClearCart->execute();
        // $stmtClearCart->close();
        // }

        // Close the database connection
        $conn->close();

        // Redirect to a thank you page or any other appropriate page
        // header("Location: thank_you.php");
        // exit();
    
    header("Location: payment.php");
    exit();
    } 
    else {
        // Handle the case where no products are selected for checkout
        echo '<script>alert("No products selected for checkout.")';
    }
} 
else {
    // Handle the case where the request method is not POST
    echo '<script>alert("Invalid request method.")';
}
?>

