<?php
session_start();
$email = $_SESSION['email'];

include 'includes/db.php';  // Assuming db.php contains the database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $currentImage = $_POST["current_image"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $phoneNumber = $_POST["phnum"];
    $expertise = $_POST["expertise"];
    $shopperFee = $_POST["ShopperFee"];
    $description = $_POST["description"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Handle file upload if a new image is selected
    if ($_FILES["files"]["error"][0] == 0) {
        $uploadDir = "../img/"; // Specify your upload directory
        $newImageName = $uploadDir . basename($_FILES["files"]["name"][0]);
        move_uploaded_file($_FILES["files"]["tmp_name"][0], $newImageName);
        $currentImage = $newImageName;
    }

    // Sanitize and validate data before updating the database (you may need to customize this based on your requirements)

    // Update the personalshopper table using prepared statements
    $queryPersonalShopper = "UPDATE personalshopper SET 
        ps_img = ?, 
        ps_first_name = ?, 
        ps_last_name = ?, 
        ps_phnum = ?, 
        ps_expertise = ?, 
        ps_fee = ?, 
        ps_desc = ?, 
        ps_username = ? 
        WHERE ps_email = ?";

    $statementPersonalShopper = $conn->prepare($queryPersonalShopper);
    $statementPersonalShopper->bind_param("sssssssss", $currentImage, $firstName, $lastName, $phoneNumber, $expertise, $shopperFee, $description, $username, $email);

    // Update the user table for the password using prepared statements
    $queryUser = "UPDATE user SET 
        password = ? 
        WHERE email = ?";

    $statementUser = $conn->prepare($queryUser);
    $statementUser->bind_param("ss", $password, $email);

    // Execute both queries without a transaction
    $resultPersonalShopper = $statementPersonalShopper->execute();

    // If the personalshopper update is successful, proceed with the user table update
    if ($resultPersonalShopper) {
        $resultUser = $statementUser->execute();

        if ($resultUser) {
            header("Location: profile.php"); // Redirect to the dashboard or any other page after successful update
            exit();
        } else {
            echo "User table update failed. Please try again.";
        }
    } else {
        echo "Personalshopper table update failed. Please try again.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
