<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection and configuration
    include 'includes/db.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Get form data
    $email = $_POST['email'];
    $pd_name = $_POST['pd_name'];
    $desc = $_POST['desc'];
    $currentDate = date('Y-m-d');

    $uploadDirectory = '../img/';

    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
        $file_name = $_FILES["files"]["name"][$key];
        $file_type = $_FILES["files"]["type"][$key];
        $file_size = $_FILES["files"]["size"][$key];

        // Check if the file is not empty
        if ($file_size > 0) {
            // Generate a unique identifier and append it to the original file name
            $new_file_name = $email . '_' . $file_name;

            $file_path = $uploadDirectory . $new_file_name;

            move_uploaded_file($tmp_name, $file_path);

            // You can add additional processing code here for the uploaded file
        }
    }



    // Insert data into the "request" table
    $insert_sql = "INSERT INTO request (rq_pd_name, rq_desc, rq_img, rq_ct_email, rq_date) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sssss", $pd_name, $desc, $file_path, $email, $currentDate);

    if ($insert_stmt->execute()) {
        // Registration successful
        echo '<script>alert("Request added successfully"); window.location = "../customer/index.php";</script>';
    } else {
        // Registration failed
        echo '<script>alert("Operation failed. Please try again.")</script>';
    }

    // Close the prepared statements
    $insert__stmt->close();
}
// Close the database connection
$conn->close();
?>