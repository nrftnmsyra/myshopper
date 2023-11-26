<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<?php
session_start();
include 'includes/header.php';
$email = $_SESSION['email'];
$username = $_SESSION['username'];

include 'includes/db.php';
// Select data from the table
if(isset($_GET['ps_email'])){
    // Get the product ID and customer email from the request
$ps_email = $_GET['ps_email'];
$selectQuery = "SELECT * FROM personalshopper WHERE ps_email = '$ps_email'";
$result = $conn->query($selectQuery);
?>
<!-- <div><?php echo $email; ?></div> -->
<div class="max-w-screen-xl pt-5 px-4 py-3 mx-auto flex flex-wrap gap-4 justify-start" id="filteredContent">
<?php
// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch data from each row
    $row = $result->fetch_assoc();
        // Process data or store it in an array for later use
    $ps_username = $row['ps_username'];
    $ps_first_name = $row['ps_first_name'];
    $ps_last_name = $row['ps_last_name'];
    $ps_phnum = $row['ps_phnum'];
    $ps_expertise = $row['ps_expertise'];
    $ps_rating = $row['ps_rating'];
    $ps_area = $row['ps_area'];
    $ps_order_count = $row['ps_order_count'];
    $ps_fee = $row['ps_fee'];
    $ps_availability = $row['ps_availability'];
    $ps_img = $row['ps_img'];
    $ps_desc = $row['ps_desc'];

        ?>
    <div class="container mx-auto p-4">
        <nav class="flex mb-2.5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                <a href="index.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Home
                </a>
                </li>
                <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Personal Shopper Detail</span>
                </div>
                </li>
            </ol>
        </nav>
        <div class="flex max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex w-48 h-full p-3">
                    <a href="#">
                        <img class="rounded" src="<?php echo $ps_img;?>" alt="product image" />
                    </a>
                </div>
                <div class="flex-grow px-5 py-5">
                    <a href="#" disabled>
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $ps_username;?></h5>
                    </a>
                    <p class="mt-2 text-sm text-gray-400"><?php echo $ps_expertise;?></p>
                    <div class="flex items-center mt-2.5 mb-5">
                        <?php
                            echo '<div class="flex items-center space-x-1 rtl:space-x-reverse">';
                            for ($i = 0; $i < $ps_rating; $i++) {
                                echo '<svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>';
                            }

                            if ($ps_rating < 5) {
                                for ($i = 0; $i < 5-$ps_rating; $i++) {
                                    echo '<svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>';
                                }
                                echo '</div>';
                            }
                            else {
                                echo '</div>';
                            }
                        ?>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3"><?php echo $ps_rating;?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">RM<?php echo number_format($ps_fee,2);?><span class="text-sm text-gray-500"> (service fee)</span></span>
                    </div>
                </div>
            </div>
<?php
    }
}
?>
            <div  class="mx-auto">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Description</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Request</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Review (5)</button>
                        </li>
                    </ul>
                </div>
                <div id="default-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo $ps_desc;?></p>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="p-4 md:p-5">
                            <form class="space-y-2" id="request-form" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $email; ?>" name="email">
                                <input type="hidden" value="<?php echo $ps_email; ?>" name="ps_email">
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What would you like to buy</label>
                                    <input type="text" name="pd_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Pants, Blouse, etc" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Attachment</label>
                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" name="files[]" multiple onchange="displaySelectedFiles(this.files)" id="file_input" accept=".pdf, .jpg, .jpeg, .png" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                                </div>
                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                                    <textarea id="description" name="desc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                                </div>
                                <button type="submit" class="text-white inline-flex items-center bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Send Shopping Request
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="w-screen py-10">
            <h1 class="mb-4 text-center font-sans text-4xl font-bold">Products</h1>
                <div class="flex overflow-x-auto p-5">
<?php
$selectProduct = "SELECT * FROM product WHERE pd_ps_email = '$ps_email'";
$resultProduct = $conn->query($selectProduct);

// Check if there are rows in the result
if ($resultProduct->num_rows > 0) {
    // Fetch data from each row
    while ($rowP = $resultProduct->fetch_assoc()) {
        // Process data or store it in an array for later use
        $pd_id = $rowP['pd_id']; 
        $pd_name = $rowP['pd_name'];
        $pd_price = $rowP['pd_price'];
        $pd_quantity= $rowP['pd_quantity'];
        $pd_desc = $rowP['pd_description'];
        $pd_img = $rowP['pd_img'];
        $pd_availability = $rowP['pd_availability'];

    if($pd_availability == 1){
        $status ="Available";
    } else {
        $status ="Out of stock";
    }
?>
                    <div class="flex-shrink-0 w-1/4 p-2">
                    <div class="group h-full overflow-hidden rounded-lg border-2 border-gray-200 border-opacity-60 shadow-lg">
                        <form action="cart_add.php" method="post">
                            <!-- Adjusted the styles for the image to make it square -->
                            <div class="w-full h-64">
                                <img class="w-full h-full object-cover object-center transition duration-500 ease-in-out group-hover:scale-105" src="<?php echo $pd_img; ?>" alt="blog" />
                            </div>

                            <h2 class="title-font inline-block cursor-pointer px-6 pt-4 pb-1 text-xs font-semibold uppercase tracking-widest text-blue-500 hover:font-bold"><?php echo $pd_status; ?></h2>
                            <div class="py-1 px-6">
                                <h1 class="title-font mb-3 inline-block cursor-pointer text-xl capitali font-extrabold tracking-wide text-gray-800"><?php echo $pd_name; ?></h1>
                                <p class="line-clamp-6 mb-3 cursor-pointer overflow-hidden leading-relaxed text-gray-500"><?php echo $pd_desc; ?></p>
                            </div>
                            <div class="flex flex-wrap items-center justify-between px-6 pt-1 pb-4">
                                <div class="flex flex-wrap text-gray-500">
                                    <span class="mr-1 text-md">RM<?php echo number_format($pd_price, 2); ?></span>
                                </div>
                                <div class="flex flex-wrap text-gray-500">
                                    <span class="text-sm"><?php echo $pd_quantity; ?> lefts</span>
                                </div>
                            </div>
                            <div class="flex justify-center items-center w-full px-6 pb-4">
                                <div>
                                    <label for="quantity" class="mb-2 text-md font-bold text-gray-800">Quantity :</label>
                                    <div class="py-2 px-3 inline-block bg-white border border-gray-200 rounded-lg" data-hs-input-number>
                                        <div class="flex items-center gap-x-1.5">
                                            <button type="button" class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none " data-hs-input-number-decrement onclick="decrementValue()">
                                                <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /></svg>
                                            </button>
                                            <input class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0" type="text" name="pd_qty" value="1" data-hs-input-number-input id="quantity">
                                            <button type="button" class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-increment onclick="incrementValue()">
                                                <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="M12 5v14" /></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 pb-4">
                                <input type="hidden" name="pd_id" value="<?php echo $pd_id; ?>">
                                <input type="hidden" name="pd_ps_email" value="<?php echo $ps_email; ?>">
                                <input type="hidden" name="pd_ct_email" value="<?php echo $email; ?>">
                                <input type="hidden" name="pd_price" value="<?php echo $pd_price; ?>">
                                <button type="submit" class="flex justify-center items-center w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
<?php
    }
}
else {

}
?>
            </div>
        </section>
    </div>
<!-- benda bawah ni kena bubuh dalam semua page content -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection and configuration
    include 'includes/db.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $response = array(
        'status' => 'success',
        'message' => 'Form submitted successfully!'
    );
    // Get form data
    $ps_email = $_POST['ps_email'];
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
    $insert_sql = "INSERT INTO request (rq_pd_name, rq_desc, rq_img, rq_ct_email, rq_ps_email) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sssss", $pd_name, $desc, $file_path, $email, $ps_email);

        if ($insert_stmt->execute()) {
            // Registration successful
            echo json_encode($response);
            echo '<script>alert("Request successfully added.")</script>';
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
</div>
<?php
include 'includes/footer.php';
?>
</body>

</html>