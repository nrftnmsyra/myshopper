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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $expertise = $_POST['expertise'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $ph_num = $_POST['phnum'];
    $fee = $_POST['fee'];
    $role = 'shopper';

    $uploadDirectory = '../img/';

    if (!empty($_FILES['files']['name'][0])) {
        // Process the uploaded file and update the profile photo path
        foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["files"]["name"][$key];
            $file_type = $_FILES["files"]["type"][$key];
            $file_size = $_FILES["files"]["size"][$key];

            // Generate a unique identifier and append it to the original file name
            $new_file_name = $email . '_' . $file_name;

            $file_path = $uploadDirectory . $new_file_name;

            move_uploaded_file($tmp_name, $file_path);
        }
    } else {
        // If no new file is selected, use the current user profile photo path
        $file_path = '../assets/default_pfp.png';
    }



    // Check if the email already exists in the 'customer' table
    $check_sql = "SELECT ps_email FROM personalshopper WHERE ps_email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Student ID already exists
        echo '<script>alert("Email already exists. Please use a different Email.")</script>';
    } else {
        // Perform the SQL queries to insert data into 'students' and 'user_accounts' tables
        $insert_account_sql = "INSERT INTO user (email, password, role) VALUES (?, ?, ?)";
        $insert_customer_sql = "INSERT INTO personalshopper (ps_email, ps_username, ps_first_name, ps_last_name, ps_phnum, ps_expertise, ps_img, ps_fee) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_account_stmt = $conn->prepare($insert_account_sql);
        $insert_customer_stmt = $conn->prepare($insert_customer_sql);

        $insert_account_stmt->bind_param("sss", $email, $password, $role);
        $insert_customer_stmt->bind_param("sssssssi", $email, $username, $first_name, $last_name, $ph_num, $expertise, $file_path, $fee);

        if ($insert_account_stmt->execute() && $insert_customer_stmt->execute()) {
            // Registration successful
            echo '<script>alert("Registration successful"); window.location = "../index.php";</script>';
        } else {
            // Registration failed
            echo '<script>alert("Registration failed. Please try again.")</script>';
        }

        // Close the prepared statements
        $insert_customer_stmt->close();
        $insert_account_stmt->close();
    }
    // Close the database connection
    $check_stmt->close();
    $conn->close();
}
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="assets/logo1.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>

    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <div
            class="w-full max-w-xl p-4 border rounded-lg shadow sm:p-6 md:p-8 bg-gray-800 border-gray-700">
            <form method="post" enctype="multipart/form-data">
                <h1
                    class="text-xl font-medium leading-tight tracking-tight md:text-2xl text-white mb-6">
                    Register
                </h1>
                <div class="mb-6 flex flex-col items-center">
                    <label for="profile_picture" class="block mb-2 text-sm font-medium text-white">
                        Profile Picture
                    </label>
                    <!-- Image Preview -->
                    <div class="mb-2">
                        <img id="image_preview" src="../assets/default_pfp.png" alt="Profile Preview"
                            class="rounded-lg max-w-20 h-20">
                    </div>

                    <!-- Upload Button -->
                    <input
                        class="mt-2.5 block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file" name="files[]" accept="image/*"
                        onchange="previewImage()">
                    <p class="mt-1 text-sm text-gray-300" id="file_input_help">PNG or
                                    JPG (MAX.
                                    1080x1080px).</p>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="first_name" id="floating_first_name"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder=" " required />
                        <label for="floating_first_name"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                            name</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="last_name" id="floating_last_name"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder=" " required />
                        <label for="floating_last_name"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                            name</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="email" name="email" id="floating_email"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder=" " required />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                            address</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <span class="absolute start-0 bottom-3 text-gray-400">
                            <svg class="w-4 h-4 rtl:rotate-[270deg]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                <path
                                    d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                            </svg>
                        </span>
                        <input type="name" name="phnum" id="floating-phone-number"
                            class="block py-2.5 ps-6 pe-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder="" />
                        <label for="floating-phone-number"
                            class="absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:start-6 peer-focus:start-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Phone
                            number</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="expertise" id="floating_repeat_password"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder=" " required />
                        <label for="floating_repeat_password"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Expertise</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="number" name="fee" id="floating_repeat_password"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder=" " required />
                        <label for="floating_repeat_password"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fee (RM)</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="username" id="floating_email"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder=" " required />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="password" name="password" id="floating_password"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                            placeholder=" " required />
                        <label for="floating_password"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    <div class="bborder w-full flex flex-col items-center">
                        <button type="submit"
                            class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Register
                        </button>
                    </div>

            </form>
            <div class="text-sm font-medium text-gray-300 w-full  flex items-center justify-center">
                Already registered? &nbsp;
                <a href="login.php" class="hover:underline text-blue-500"> Login Now</a>
            </div>

        </div>
    </div>
</body>

</html>

</div>
<script>
    function previewImage() {
        var preview = document.getElementById('image_preview');
        var fileInput = document.getElementById('file_input');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "default_profile_picture.jpg";
        }
    }
</script>