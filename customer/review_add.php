<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a function to sanitize user input
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

    // Check if any files are submitted
    if (!empty($_FILES["rv_img"]["name"][0])) {
        foreach ($_FILES["rv_img"]["tmp_name"] as $key => $tmp_name) {

            $file_name = $_FILES["rv_img"]["name"][$key];
            $file_type = $_FILES["rv_img"]["type"][$key];
            $file_size = $_FILES["rv_img"]["size"][$key];

            // Generate a unique identifier and append it to the original file name
            $new_file_name = $reviewId . '_' . $num . '_' . $file_name;

            $file_path = $uploadDirectory . $new_file_name;

            move_uploaded_file($tmp_name, $file_path);

            // Insert image path into 'image' table
            $sqlImage = "INSERT INTO image (ref_id, img_path) VALUES (?, ?)";
            $stmtImage = $conn->prepare($sqlImage);
            $stmtImage->bind_param("is", $reviewId, $file_path);
            $stmtImage->execute();
            $num = $num + 1;
        }
    }

    echo '<script>alert("Thank you for your review!"); window.location = "order_details.php?order_code='.$order_code.'";</script>';

    // Close the database connection
    $conn->close();
}
?>
