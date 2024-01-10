<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a function to sanitize user input
    echo '<pre>';
    print_r($_POST);
    print_r($_FILES);
    echo '</pre>';
    function sanitizeInput($data)
    {
        // Implement your sanitization logic here
        return $data;
    }

    // Extract and sanitize form data
    $order_code = sanitizeInput($_POST["order_code"]);
    $rating = sanitizeInput($_POST["rating"]);
    $rv_ct_email = sanitizeInput($_POST["rv_ct_email"]);
    $rv_ps_email = sanitizeInput($_POST["rv_ps_email"]);
    $rv_order_id = sanitizeInput($_POST["rv_order_id"]);
    $rv_description = sanitizeInput($_POST["rv_description"]);

    // Insert review data into the 'review' table
    $sqlReview = "INSERT INTO review (rv_ps_email, rv_ct_email, rv_order_id, rv_description, rv_rating, rv_date, rv_time)
                  VALUES (?, ?, ?, ?, ?, CURDATE(), CURTIME())";

    // Use prepared statement to prevent SQL injection
    $stmtReview = $conn->prepare($sqlReview);
    $stmtReview->bind_param("ssisi", $rv_ps_email, $rv_ct_email, $rv_order_id, $rv_description, $rating);
    $stmtReview->execute();
    $stmtReview->close();

    // Get the last inserted review ID
    $reviewId = $conn->insert_id;

    $uploadDirectory = '../img/';
    $num = 1;
    foreach ($_FILES["rv_img"]["tmp_name"] as $key => $tmp_name) {

        $file_name = $_FILES["rv_img"]["name"][$key];
        $file_type = $_FILES["rv_img"]["type"][$key];
        $file_size = $_FILES["rv_img"]["size"][$key];

        // Generate a unique identifier and append it to the original file name
        $new_file_name = $reviewId . '_' . $num . '_' . $file_name;

        $file_path = $uploadDirectory . $new_file_name;

        move_uploaded_file($tmp_name, $file_path);
        $sqlImage = "INSERT INTO image (ref_id, img_path) VALUES (?, ?)";
        $stmtImage = $conn->prepare($sqlImage);
        $stmtImage->bind_param("is", $reviewId, $file_path);
        $stmtImage->execute();
        $num = $num + 1;
    }
    header("Location: order_details.php?order_code=$order_code");
    // Handle file uploads
    // if (!empty($_FILES['rv_img']['name'][0])) {
    //     $fileNames = array();

    //     foreach ($_FILES['rv_img']['name'] as $key => $value) {
    //         $fileName = $reviewId . '_' . basename($_FILES['rv_img']['name'][$key]);
    //         $targetPath = "../img/" . $fileName;

    //         if (move_uploaded_file($_FILES['rv_img']['tmp_name'][$key], $targetPath)) {
    //             // Insert image path into 'image' table
    //             $sqlImage = "INSERT INTO image (ref_id, img_path) VALUES (?, ?)";
    //             $stmtImage = $conn->prepare($sqlImage);

    //             if (!$stmtImage) {
    //                 die('Error preparing statement: ' . $conn->error);
    //             }

    //             // Use 'i' for integer and 's' for string
    //             $stmtImage->bind_param("is", $reviewId, $targetPath);

    //             if ($stmtImage->execute()) {
    //                 $fileNames[] = $targetPath;
    //             } else {
    //                 // Handle execution error if needed
    //                 echo 'Error executing statement: ' . $stmtImage->error;
    //             }

    //             $stmtImage->close();
    //         } else {
    //             // Handle upload error if needed
    //             echo 'Error moving file to destination.';
    //         }
    //     }

    //     // Do something with $fileNames if needed
    // }



    // Close the database connection
    $conn->close();
}
?>