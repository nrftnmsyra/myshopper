<?php
// update_status.php
session_start();
$email = $_SESSION['email'];

// Include your database connection file
include 'includes/db.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request ID and selected status from the POST data
    $current_image = $_POST["current_image"];
    $pd_name = $_POST['pd_name'];
    $pd_price = $_POST['pd_price'];
    $pd_quantity = $_POST['pd_quantity'];
    $pd_description = $_POST['pd_description'];
    // $pd_img = $_POST['pd_img'];
    $pd_availability = 1; // Assuming availability is 1 for available
    $pd_type = "shopper"; // Assuming product type is 'shopper'

    if (isset($_POST['image'])) {
        $data = $_POST['image'];

        $image_array_1 = explode(";", $data);


        $image_array_2 = explode(",", $image_array_1[1]);

        $data = base64_decode($image_array_2[1]);

        $PdPhotoPath = '../img/' . time() . '.png';

        file_put_contents($PdPhotoPath, $data);
    }
    else {
        // If no new file is selected, use the current user profile photo path
        $PdPhotoPath = $current_image;
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO product (pd_ps_email, pd_name, pd_price, pd_quantity, pd_description, pd_img, pd_availability, pd_type)
        VALUES ('$email', '$pd_name', $pd_price, $pd_quantity, '$pd_description', '$PdPhotoPath ', $pd_availability, '$pd_type')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New Product added successfully"); window.location = "product.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Free the result set
    $result->free();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close the database connection
$conn->close();
?>