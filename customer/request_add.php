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

    $uploadDirectory ='../img/';

    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
        $file_name = $_FILES["files"]["name"][$key];
        $file_type = $_FILES["files"]["type"][$key];
        $file_size = $_FILES["files"]["size"][$key];
    
        // Generate a unique identifier and append it to the original file name
        $new_file_name = $email . '_' . $file_name;
    
        $file_path = $uploadDirectory . $new_file_name;
    
        move_uploaded_file($tmp_name, $file_path);
    }
    

    // Insert data into the "request" table
    $insert_sql = "INSERT INTO request (rq_pd_name, rq_desc, rq_img, rq_ct_email) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ssss", $pd_name, $desc, $file_path, $email);

        if ($insert_stmt->execute()) {
            // Registration successful
            echo json_encode($response);
            echo '<script>alert("Request successfully added."); window.location = "../customer/index.php";</script>';
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