<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection and configuration
    include 'includes/db.php';

    // Get form data
    $email = $_POST['pd_ct_email'];
    $pd_id = $_POST['pd_id'];
    $ps_email = $_POST['pd_ps_email'];
    $pd_qty = $_POST['pd_qty'];
    $pd_price = $_POST['pd_price'];

    $selectCart = "SELECT * FROM CART WHERE cart_pd_id ='$pd_id' AND cart_ps_email ='$ps_email' AND cart_ct_email='$email'";
    $result = $conn->query($selectCart);
    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        echo '<script>alert("Product already added in the cart"); window.location = "../customer/ps_details.php?ps_email='.$ps_email.'";</script>';
    } else {

    // Insert data into the "request" table
    $insert_sql = "INSERT INTO CART (cart_pd_id, cart_qty, cart_ps_email, cart_ct_email, cart_pd_price) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iissd", $pd_id, $pd_qty, $ps_email, $email, $pd_price);

        if ($insert_stmt->execute()) {
            // Registration successful
            echo '<script>alert("Product added successfully"); window.location = "../customer/ps_details.php?ps_email='.$ps_email.'";</script>';
        } else {
            // Registration failed
            echo '<script>alert("Operation failed. Please try again.")</script>';
        }

        // Close the prepared statements
        $insert_stmt->close();
    }
}
    // Close the database connection
    $conn->close();
?>