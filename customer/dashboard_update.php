<?php
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
    $first_name = clean_input($_POST["first_name"]);
    $last_name = clean_input($_POST["last_name"]);
    $phnum = clean_input($_POST["phnum"]);
    $address = clean_input($_POST["address"]);
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);
    $ct_img = clean_input($_POST["current_image"]);


    if (!empty($_FILES['files']['name'][0])) {
        // Process the uploaded file and update the profile photo path
        $uploadDir = '../img/';
        $uploadFile = $uploadDir . basename($_FILES['files']['name'][0]);

        if (move_uploaded_file($_FILES['files']['tmp_name'][0], $uploadFile)) {
            $newProfilePhotoPath = $uploadFile;
            // Update the user's profile photo path in the database or wherever you store it
        }
    } else {
        // If no new file is selected, use the current user profile photo path
        $newProfilePhotoPath = $ct_img;
    }


    // Update customer table
    $updateCustomerQuery = "UPDATE customer SET ct_username = '$username', ct_first_name = '$first_name', ct_last_name = '$last_name', 
                            ct_phnum = '$phnum', ct_address = '$address', ct_img = '$newProfilePhotoPath' WHERE ct_email = '$email'";
    $resultCustomer = $conn->query($updateCustomerQuery);

    // Update user table
    $updateUserQuery = "UPDATE user SET password = '$password'  WHERE email = '$email'";
    $resultUser = $conn->query($updateUserQuery);

    if ($resultCustomer && $resultUser) {
        echo '<script>alert("Profile Updated Successfully"); window.location = "dashboard.php";</script>';
    } else {
        echo "Error updating data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect if accessed directly without POST request
    header("Location: dashboard.php");
    exit();
}
?>