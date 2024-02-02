<!-- wajib letak -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myShopper</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo1.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>

<?php include 'includes/navigation.php'; ?>

<body class="bg-gray-900">
    <div class="p-4 sm:ml-52 bg-gray-900 h-100">
        <!-- wajib letak -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-20">
            <h1 class="text-4xl font-bold mb-4 text-white">Products</h1>
            <div
                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-gray-900">
                <div>
                    <button id="dropdownActionButton" data-modal-target="new-modal" data-modal-toggle="new-modal"
                        class="inline-flex items-center border focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-3 py-1.5 bg-gray-800 text-gray-400 border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700"
                        type="button">
                        + New Product
                    </button>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search-users"
                        class="block p-2 ps-10 text-sm border rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for products">
                </div>
            </div>
            <table id="product-table" class="w-full text-sm text-left rtl:text-right text-gray-400">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <!-- delete -->
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product Details
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    $email = $_SESSION['email'];

                    include 'includes/db.php';
                    // Select data from the table
                    $selectQuery = "SELECT * FROM product WHERE pd_ps_email = '$email'";
                    $result = $conn->query($selectQuery);
                    ?>
                    <?php
                    // Check if there are rows in the result
                    if ($result->num_rows > 0) {
                        // Fetch data from each row
                        while ($row = $result->fetch_assoc()) {

                            $pd_id = $row['pd_id'];
                            $pd_name = $row['pd_name'];
                            $pd_description = $row['pd_description'];
                            $pd_img = $row['pd_img'];
                            $status = $row['pd_availability'];
                            $pd_price = $row['pd_price'];
                            $pd_quantity = $row['pd_quantity'];

                            if ($status == 1) {
                                $pd_availability = "Available";
                            } elseif ($status == 0) {
                                $pd_availability = "Out of Stock";
                            }
                            ?>
                            <tr class="border-b bg-gray-800 border-gray-700">
                                <td class="w-4 p-4">
                                    <!-- delete button -->
                                    <button type="button" class="ml-2 text-gray-500 hover:text-red-500 focus:outline-none"
                                        onclick="deletePd('<?php echo $pd_id; ?>','<?php echo $email; ?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                                <th scope="row" class="flex items-center px-6 py-4 whitespace-nowrap text-white">
                                    <a href="#" id="openModal_<?php echo $pd_id; ?>"><img class="w-10 h-10 rounded-full"
                                            src="<?php echo $pd_img; ?>" alt="Jese image"></a>
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">
                                            <?php echo strlen($pd_name) > 70 ? substr($pd_name, 0, 70) . '...' : $pd_name; ?>
                                        </div>
                                        <div class="font-normal text-gray-500">
                                            <?php echo $pd_description; ?>
                                        </div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    RM
                                    <?php echo number_format($pd_price, 2); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $pd_quantity; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $pd_availability; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="crud-modal_<?php echo $pd_id; ?>"
                                        data-modal-toggle="crud-modal_<?php echo $pd_id; ?>"
                                        class="block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800"
                                        type="button">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal container -->
                            <div id="imageModal_<?php echo $pd_id; ?>"
                                class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                                <!-- Modal content -->
                                <div class="bg-white p-4 rounded-md shadow-md max-w-md w-full mx-auto relative">
                                    <!-- Close button (x icon) -->
                                    <span
                                        class="cursor-pointer absolute top-0.5 right-2 text-gray-800 hover:text-red-500 text-4xl"
                                        id="closeModal_<?php echo $pd_id; ?>">&times;</span>
                                    <!-- Image container -->
                                    <div id="modalContent_<?php echo $pd_id; ?>"><img class="pb-5 rounded-t-lg"
                                            src="<?php echo $pd_img; ?>" alt="product image" /></div>
                                </div>
                            </div>
                            <!-- edit modal -->
                            <div id="crud-modal_<?php echo $pd_id; ?>" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative rounded-lg shadow bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                            <h3 class="text-lg font-semibold text-white">
                                                Product Details
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                                data-modal-toggle="crud-modal_<?php echo $pd_id; ?>">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <form action="product_update.php" method="POST" enctype="multipart/form-data">
                                                <select id="status" name="pd_availability"
                                                    class="border text-xs h-fit rounded-lg block w-fit p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>
                                                        Available</option>
                                                    <option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>
                                                        Out of Stock
                                                    </option>
                                                </select>
                                                <div class="mb-3 flex flex-col items-center">
                                                    <label for="profile_picture"
                                                        class="block mb-2 text-sm font-medium text-white">
                                                        Product Image
                                                    </label>
                                                    <!-- Square container -->
                                                    <div class="mb-4 h-36 w-36 rounded-lg">
                                                        <!-- A rectangular picture -->
                                                        <img class="h-full w-full object-cover rounded-lg" id="image_preview2"
                                                            src="<?php echo $pd_img; ?>" alt="" />
                                                    </div>
                                                    <input type="hidden" name="current_image" value="<?php echo $pd_img; ?>">
                                                    <!-- Upload Button -->
                                                    <input
                                                        class="mt-2.5 block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                                                        aria-describedby="file_input_help" id="file_input2" type="file"
                                                        name="files[]" accept="image/*" onchange="previewImage2()">
                                                    <p class="mt-1 text-sm text-gray-300" id="file_input_help">
                                                        PNG or
                                                        JPG (MAX.
                                                        1080x1080px).</p>
                                                </div>
                                                <div class="grid gap-4 mb-2 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-white">Name</label>
                                                        <input type="text" name="pd_name" id="name"
                                                            value="<?php echo $pd_name; ?>"
                                                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                                            placeholder="Type product name" required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="price"
                                                            class="block mb-2 text-sm font-medium text-white">Price</label>
                                                        <input type="text" name="pd_price" id="price"
                                                            value="<?php echo $pd_price; ?>"
                                                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                                            placeholder="$2999" required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="price"
                                                            class="block mb-2 text-sm font-medium text-white">Quantity</label>
                                                        <input type="number" name="pd_quantity" id="price"
                                                            value="<?php echo $pd_quantity; ?>"
                                                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                                            placeholder="$2999" required="">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="description"
                                                            class="block mb-2 text-sm font-medium text-white">Product
                                                            Description</label>
                                                        <textarea id="description" name="pd_description" rows="4"
                                                            class="block p-2.5 w-full text-sm rounded-lg bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                                            placeholder="Write product description here"><?php echo $pd_description; ?></textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="pd_id" value="<?php echo $pd_id; ?>">
                                                <button type="hidden"
                                                    class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                                    Submit
                                                </button>
                                            </form>
                                            <script>
                                                function previewImage2() {
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
                                                        console.log('Using current image:', "<?php echo $pd_img; ?>");
                                                        preview.src = "<?php echo $pd_img; ?>";
                                                    }
                                                }

                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                // JavaScript to handle modal functionality for each row
                                document.getElementById('openModal_<?php echo $pd_id; ?>').addEventListener('click', function () {
                                    document.getElementById('imageModal_<?php echo $pd_id; ?>').classList.remove('hidden');
                                });

                                document.getElementById('closeModal_<?php echo $pd_id; ?>').addEventListener('click', function () {
                                    document.getElementById('imageModal_<?php echo $pd_id; ?>').classList.add('hidden');
                                });
                            </script>
                            <?php
                        }
                    } else {
                        echo "<tbody>";
                        echo "<tr class='border-b bg-gray-800 border-gray-700 hover:bg-gray-900'>";
                        echo "<td colspan='6' class='px-6 py-4 text-center'>No Product Found</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- create modal -->
        <div id="new-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                        <h3 class="text-lg font-semibold text-white">
                            New Product
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-toggle="new-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form action="product_add.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-6 flex flex-col items-center">
                                <label for="profile_picture" class="block mb-2 text-sm font-medium text-white">
                                    Product Image
                                </label>
                                <input type="hidden" name="current_image" value="../assets/default_pd.jpeg">
                                <!-- Image Preview -->
                                <!-- Square container -->
                                <div class="mb-4 h-36 w-36 rounded-lg">
                                    <!-- A rectangular picture -->
                                    <img class="h-full w-full object-cover rounded-lg" id="image_preview"
                                        src="../assets/default_pd.jpeg" alt="" />
                                </div>
                                <!-- Upload Button -->
                                <input
                                    class="mt-2.5 block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
                                    aria-describedby="file_input_help" id="file_input" type="file" name="files[]"
                                    accept="image/*" onchange="previewImage()">
                                <p class="mt-1 text-sm text-gray-300" id="file_input_help">
                                    PNG or
                                    JPG (MAX.
                                    1080x1080px).</p>
                            </div>
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                                    <input type="text" name="pd_name" id="name"
                                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Type product name" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="price" class="block mb-2 text-sm font-medium text-white">Price</label>
                                    <input type="text" name="pd_price" id="price"
                                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="299.99" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="price"
                                        class="block mb-2 text-sm font-medium text-white">Quantity</label>
                                    <input type="number" name="pd_quantity" id="price"
                                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="0" required="">
                                </div>
                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-white">Product
                                        Description</label>
                                    <textarea id="description" name="pd_description" rows="4"
                                        class="block p-2.5 w-full text-sm rounded-lg border bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Write product description here"></textarea>
                                </div>
                            </div>
                            <button type="hidden"
                                class="text-white inline-flex items-center focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                Submit
                            </button>
                        </form>
                        <script>
                            function previewImage() {
                                var preview = document.getElementById('image_preview');
                                var fileInput = document.getElementById('file_input');
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
                                    preview.src = "../assets/default_pd.jpg";
                                }
                            }

                        </script>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
<!-- wajib letak -->
</div>

</html>
<script>
    function deletePd(pd_id, email) {
        // Redirect to Page 2 with the ID as a URL parameter
        window.location.href = 'product_delete.php?delete_id=' + pd_id + '&delete_email=' + email;
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the search input and table
        var searchInput = document.getElementById('table-search-users');
        var table = document.getElementById('product-table');

        // Add an input event listener to the search input
        searchInput.addEventListener('input', function () {
            var filter = searchInput.value.toLowerCase();

            // Get all rows in the table body
            var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            // Iterate through each row and hide/show based on the search input
            for (var i = 0; i < rows.length; i++) {
                var nameColumn = rows[i].getElementsByTagName('th')[0];
                var name = nameColumn.textContent || nameColumn.innerText;

                if (name.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    });
</script>