<?php
error_reporting(0);
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    include 'includes/db.php';

    // Prepare and execute the query to check user credentials
    $stmt = $conn->prepare("SELECT email, role FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned (authentication successful)
    if ($result->num_rows == 1) {
        // Fetch the user's role
        $row = $result->fetch_assoc();
        $user_role = $row['role'];

        // Store email in the session
        $_SESSION['email'] = $email;

        // Store user role in the session
        $_SESSION['role'] = $user_role;

        // Redirect based on user role
        if ($user_role == 'admin') {
            header("Location: dashboard.php");
        } else {
            // Handle other roles or scenarios
            // You can redirect to a default page or display an error message
            echo '<script>alert("Invalid User"); window.location = "../index.php";</script>';
        }
    } else {
        // Authentication failed; display an error message
        echo '<script>alert("Invalid username or password"); window.location = "login.php";</script>';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myShopper</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo1.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Add your CSS stylesheets or link to a framework like Tailwind CSS if not already included -->
</head>

<body class="flex items-center justify-center h-screen bg-gray-800">

    <div class="relative p-4 w-full max-w-md">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow bg-gray-700">
            <!-- Modal header -->
            <div class="flex flex-col items-center p-4 md:p-5 border-b rounded-t border-gray-600">
                <a href="../index.php" class="text-center">
                    <div class="flex items-center space-x-2">
                        <img src="../customer/assets/logo1.png" class="h-8" alt="Flowbite Logo" />
                        <span class="text-2xl font-bold text-white">myShopper</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-300">(Administrator Sign In)</span>
                </a>
            </div>


            <div class="p-4 md:p-5 ">
                <form class="space-y-4" action="login.php" method="post">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-white">Your
                            username</label>
                        <input type="text" name="email" id="email"
                            class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            placeholder="username" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-white">Your
                            password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Login
                        to your account</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>