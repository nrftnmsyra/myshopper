<?php include 'includes/header.php'; ?>

<!-- NAVIGATION PAGE -->
<?php include 'includes/navigation.php'; ?>

<?php
session_start();
$email = $_SESSION['email'];
$username = $_SESSION['username'];

include 'includes/db.php';
// Select data from the table
$selectQuery = "SELECT * FROM customer JOIN user ON customer.ct_email = user.email WHERE ct_email = '$email'";
$result = $conn->query($selectQuery);
?>
<?php
// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data from each row
    while ($row = $result->fetch_assoc()) {
        // Process data or store it in an array for later use
        $ct_email = $row['ct_email'];
        $password = $row['password'];
        $ct_username = $row['ct_username'];
        $ct_first_name = $row['ct_first_name'];
        $ct_last_name = $row['ct_last_name'];
        $ct_phnum = $row['ct_phnum'];
        $ct_address = $row['ct_address'];
        $ct_img = $row['ct_img'];
        ?>
        <main class="flex-grow p-4">
            <div class="w-full">
                <div class="flex flex-col items-center pb-10">
                    <div class="mt-10 w-36 h-36 mb-3 rounded-full shadow-lg overflow-hidden">
                        <img src="<?php echo $ct_img; ?>" alt="Image" class="object-cover w-full h-full">
                    </div>
                    <h5 class="mb-1 text-xl font-medium text-gray-900">
                        <?php echo $ct_username; ?>
                    </h5>
                    <span class="text-sm text-gray-500">
                        <?php echo $ct_email; ?>
                    </span>
                    <div class="flex mt-4 md:mt-6">
                        <!-- Modal toggle -->
                        <button data-modal-target="select-modal" data-modal-toggle="select-modal"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            Edit Profile
                        </button>
                    </div>
                    <dl class="w-full p-20 text-gray-900 divide-y divide-gray-200">
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500 md:text-lg">Name</dt>
                            <dd class="text-lg font-semibold">
                                <?php echo $ct_first_name . ' ' . $ct_last_name; ?>
                            </dd>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500 md:text-lg">Phone Number</dt>
                            <dd class="text-lg font-semibold">
                                <?php echo $ct_phnum; ?>
                            </dd>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500 md:text-lg">Home address</dt>
                            <dd class="text-lg font-semibold">
                                <?php echo $ct_address; ?>
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg"></dt>
                        </div>
                    </dl>
                </div>
            </div>


            <!-- Main modal -->
            <div id="select-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md h-4/5">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Edit Profile
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="select-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="h-fit p-2 md:p-5">
                            <form method="post" action="dashboard_update.php" enctype="multipart/form-data" id="profileForm">
                                <div class="mb-6 flex flex-col items-center">
                                    <label for="profile_picture"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Profile Picture
                                    </label>
                                    <!-- Image Preview -->
                                    <div class="mb-2">
                                        <img id="image_preview2" src="<?php echo $ct_img; ?>" alt="Profile Preview"
                                            class="rounded-lg max-w-20 h-20">

                                    </div>
                                    <input type="hidden" name="current_image" value="<?php echo $ct_img; ?>">
                                    <!-- Upload Button -->
                                    <input
                                        class="mt-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="file_input_help" id="file_input2" type="file" name="files[]"
                                        accept="image/*" onchange="previewImage()">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG or
                                        JPG (MAX.
                                        800x400px).</p>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" name="first_name" id="floating_first_name"
                                            value="<?php echo $ct_first_name; ?>"
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label for="floating_first_name"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                                            name</label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" name="last_name" id="floating_last_name"
                                            value="<?php echo $ct_last_name; ?>"
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label for="floating_last_name"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                                            name</label>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <span class="absolute start-0 bottom-3 text-gray-500 dark:text-gray-400">
                                            <svg class="w-4 h-4 rtl:rotate-[270deg]" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                                <path
                                                    d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                                            </svg>
                                        </span>
                                        <input type="text" name="phnum" id="floating-phone-number"
                                            value="<?php echo $ct_phnum; ?>"
                                            class="block py-2.5 ps-6 pe-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " />
                                        <label for="floating-phone-number"
                                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:start-6 peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Phone
                                            number</label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" name="address" id="floating_repeat_password"
                                            value="<?php echo $ct_address; ?>"
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label for="floating_repeat_password"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Address</label>

                                    </div>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" name="username" id="floating_email" value="<?php echo $ct_username; ?>"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />
                                    <label for="floating_email"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                                </div>
                                <div class="relative z-0 w-full mb-2.5 group">
                                    <div class="flex items-center relative z-0 w-full group">
                                        <input type="password" name="password" id="floating_password"
                                            value="<?php echo $password; ?>"
                                            class="flex-grow py-2.5 px-0 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                                            placeholder=" " required />
                                        <button id="show_button" type="button" onclick="togglePasswordVisibility()"
                                            class="px-2 py-2 text-sm text-gray-500 cursor-pointer">
                                            Show
                                        </button>
                                    </div>
                                    <label for="floating_password"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                </div>
                                <div class="relative z-0 w-full group">
                                    <button type="submit"
                                        class="mx-auto mt-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('floating_password');
                    const showButton = document.getElementById('show_button');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        showButton.textContent = 'Hide';
                    } else {
                        passwordInput.type = 'password';
                        showButton.textContent = 'Show';
                    }
                }
            </script>



        </main>
        <script>
            function previewImage() {
                var preview = document.getElementById('image_preview2');
                var fileInput = document.getElementById('file_input2');
                console.log('File input:', fileInput);
                var file = fileInput.files[0];

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        console.log('Image source:', e.target.result);
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    // If no file is selected, display the current user profile photo
                    console.log('Using current image:', "<?php echo $ct_img; ?>");
                    preview.src = "<?php echo $ct_img; ?>";
                }
            }

        </script>
        <?php
    }
} else {
    echo "No records found";
}

// Close the database connection
$conn->close();

?>



<!-- BAWAH INI KENA ADA -->
</div>
</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>