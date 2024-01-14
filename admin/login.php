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
            exit();
        } else {
            // Handle other roles or scenarios
            // You can redirect to a default page or display an error message
            $_SESSION['message'] = "Invalid user role.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Authentication failed; display an error message
        $_SESSION['message'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }

    // Close the database connection
    $stmt->close();
    $stmt1->close();
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

<body class="flex items-center justify-center h-screen bg-gray-100 dark:bg-gray-800">

    <div class="relative p-4 w-full max-w-md">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex flex-col items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <img src="../customer/assets/logo1.png" class="h-8" alt="Flowbite Logo" />
                    <span class="text-2xl font-bold dark:text-white">myShopper</span>
                </div>
                <span class="text-sm font-semibold dark:text-gray-300">(Administrator Sign In)</span>
            </div>


            <div class="p-4 md:p-5 ">
                <form class="space-y-4" action="login.php" method="post">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                        to your account</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>