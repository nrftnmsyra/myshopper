<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/db.php';

    // Function to sanitize and validate input
    function clean_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Sanitize and validate input data
    $pd_name = clean_input($_POST["pd_name"]);
    $pd_id = clean_input($_POST["pd_id"]);
    $pd_price = clean_input($_POST["pd_price"]);
    $pd_quantity = clean_input($_POST["pd_quantity"]);
    $pd_description = clean_input($_POST["pd_description"]);
    $current_image = clean_input($_POST["current_image"]);

    if (!empty($_FILES['files']['name'][0])) {
        // Process the uploaded file and update the profile photo path
        $uploadDir = '../img/';
        $uploadFile = $uploadDir . basename($_FILES['files']['name'][0]);

        if (move_uploaded_file($_FILES['files']['tmp_name'][0], $uploadFile)) {
            $newPdPhotoPath = $uploadFile;
            // Update the user's profile photo path in the database or wherever you store it
        }
    } else {
        // If no new file is selected, use the current user profile photo path
        $newPdPhotoPath = $current_image;
    }

    // Update product table
    $updateProductQuery = "UPDATE product SET pd_name = '$pd_name', pd_price = '$pd_price', 
                           pd_quantity = '$pd_quantity', pd_description = '$pd_description', 
                           pd_img = '$newPdPhotoPath' WHERE pd_id = '$pd_id'";
    $resultProduct = $conn->query($updateProductQuery);

    if ($resultProduct) {
        header("Location: product.php"); // Redirect to a success page
    } else {
        echo "Error updating product data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect if accessed directly without POST request
    header("product.php"); // Redirect to an error page
    exit();
}
?>