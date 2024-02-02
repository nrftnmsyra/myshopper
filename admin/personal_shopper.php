<?php


?>

<!-- wajib letak -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myShopper</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo1.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>

<?php include 'includes/navigation.php'; ?>

<body class="bg-gray-100">
    <div class="p-4 sm:ml-52 h-100">
        <!-- wajib letak -->
        <h1 class="text-4xl font-bold mb-4 mt-20">Personal Shopper</h1>
        <div class="relative overflow-x-auto shadow-md">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 bg-gray-900">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search-users" oninput="filterTable()"
                            class="block p-2 ps-10 text-sm border rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for Shopper">
                    </div>
                </div>
                <table id="user-table" class="w-full text-sm text-left rtl:text-right text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        session_start();

                        include 'includes/db.php';

                        // Select data from the table with the search condition
                        $selectQuery = "SELECT * FROM personalshopper";
                        $result = $conn->query($selectQuery);

                        // Check if there are rows in the result
                        if ($result->num_rows > 0) {
                            // Fetch data from each row
                            while ($row = $result->fetch_assoc()) {
                                // Process data or store it in an array for later use
                                $ps_email = $row['ps_email'];
                                $ps_username = $row['ps_username'];
                                $ps_first_name = $row['ps_first_name'];
                                $ps_last_name = $row['ps_last_name'];
                                $ps_phnum = $row['ps_phnum'];
                                $ps_expertise = $row['ps_expertise'];
                                $ps_img = $row['ps_img'];
                                ?>
                                <tr
                                    class="border-b bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 whitespace-nowrap text-white">
                                        <img class="w-10 h-10 rounded-full" src="<?php echo $ps_img; ?>" alt="image">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">
                                                <?php echo $ps_first_name . ' ' . $ps_last_name; ?>
                                            </div>
                                            <div class="font-normal text-gray-500">
                                                <?php echo $ps_email; ?>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $ps_username; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <?php echo $ps_phnum; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="personal_shopper_details.php?ps_email=<?php echo $ps_email; ?>"
                                            class="font-medium text-blue-500 hover:underline">View</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tbody>
                        <tr id='noReviewRow' class='border-b bg-gray-800 border-gray-700 hover:bg-gray-900'
                            style='display: none;'>
                            <td colspan='4' class='px-6 py-4 text-center'>No User Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <script>
                function filterTable() {
                    var input, filter, table, tr, td, i, txtValue, noReviewRow;
                    input = document.getElementById("table-search-users");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("user-table"); // Change this to the ID of your new table
                    tr = table.getElementsByTagName("tr");
                    noReviewRow = document.getElementById("noReviewRow");

                    var found = false;

                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[0]; // Adjust the index based on the column you want to filter

                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                found = true;
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }

                    // Show/hide the 'No Request Found' row
                    if (found) {
                        noReviewRow.style.display = "none";
                    } else {
                        noReviewRow.style.display = "";
                    }
                }
            </script>


        </div>
    </div>
</body>
<!-- wajib letak -->
</div>

</html>