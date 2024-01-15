<?php include 'includes/header.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>
<div class="max-w-screen-xl px-4 py-3 mx-auto flex flex-wrap gap-4 justify-start">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <main class="flex-grow p-4" id="filteredContent">
        <div id="ordersContent" class="rounded-lg p-4">
            <h1 class="text-4xl font-bold mb-4">Your Cart</h1>
            <form action="checkout.php" method="post">
                <?php
                session_start();
                $email = $_SESSION['email'];

                include 'includes/db.php';
                // Select data from the table
                $selectQuery = "SELECT
                        personalshopper.ps_username,
                        personalshopper.ps_email,
                        product.pd_name,
                        product.pd_img,
                        cart.cart_ct_email,
                        cart.cart_pd_id,
                        cart.cart_qty,
                        cart.cart_pd_price
                        FROM
                        cart
                        JOIN
                        product ON cart.cart_pd_id = product.pd_id
                        JOIN
                        personalshopper ON product.pd_ps_email = personalshopper.ps_email
                        WHERE
                        cart.cart_ct_email = ?";
                $stmt = $conn->prepare($selectQuery);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                // Create an array to store products grouped by personal shopper
                $groupedProducts = array();

                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    // Fetch data from each row and group by personal shopper
                    while ($row = $result->fetch_assoc()) {
                        $ps_email = $row['ps_email'];
                        $ps_username = $row['ps_username'];

                        // Store product details in the array with the personal shopper as the key
                        $groupedProducts[$ps_email][] = $row;
                    }

                    // Iterate through the grouped products
                    foreach ($groupedProducts as $ps_email => $products) {
                        $ps_username = $products[0]['ps_username']; // Assuming ps_username is the same for all products of the same personal shopper
                        $totalPrice = 0; // Initialize total price for the current personal shopper
                
                        ?>
                        <div
                            class="mb-5 w-full border rounded-lg shadow bg-gray-800 border-gray-900 px-6 py-4">
                            <div>
                                <h2
                                    class="text-2xl tracking-tight text-white font-bold border-b border-gray-600 p-3">
                                    <?php echo $ps_username; ?>
                                </h2>
                            </div>

                            <?php
                            // Iterate through products for the current personal shopper
                            foreach ($products as $product) {
                                $cart_ct_email = $product['cart_ct_email'];
                                $cart_pd_id = $product['cart_pd_id'];
                                $pd_name = $product['pd_name'];
                                $pd_img = $product['pd_img'];
                                $cart_qty = $product['cart_qty'];
                                $cart_pd_price = $product['cart_pd_price'];
                                $totalPrice += $cart_pd_price * $cart_qty; // Calculate total price for the current product
                                ?>
                                <!-- Display product details for the current personal shopper -->
                                <div class="flex items-center rounded-lg bg-gray-800 border-gray-700">
                                    <!-- Delete button for the current product -->
                                    <div>
                                        <!-- Delete button for the current product -->
                                        <button type="button" class="ml-2 text-gray-500 hover:text-red-500 focus:outline-none"
                                            onclick="deleteCart('<?php echo $cart_pd_id; ?>','<?php echo $cart_ct_email; ?>')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-3 flex justify-center items-center">
                                        <!-- Square Image with Rounded Corners -->
                                        <img class="w-24 h-24 object-cover rounded-md" src="<?php echo $pd_img; ?>" alt="" />
                                    </div>
                                    <!-- Product Details -->
                                    <div class="p-5 w-full">
                                        <!-- <a href="order_details.php"> -->
                                        <div class="mb-2">
                                            <h5
                                                class="text-2xl font-bold tracking-tight text-white transition duration-300 hover:text-gray-300">
                                                <?php echo $pd_name; ?>
                                            </h5>
                                        </div>
                                        </a>
                                        <!-- Quantity input for the current product -->
                                        <div>
                                            <label for="quantity" class="mb-2 font-normal text-gray-400">Quantity
                                                :</label>
                                            <!-- input number -->
                                            <div class="py-2 px-3 inline-block border rounded-lg bg-slate-900 border-gray-700"
                                                data-hs-input-number>
                                                <div class="flex items-center gap-x-1.5">
                                                    <button type="button"
                                                        class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border shadow-sm disabled:opacity-50 disabled:pointer-events-none bg-slate-900 border-gray-700 text-white hover:bg-gray-800 focus:outline-none focus:ring-1 focus:ring-gray-600"
                                                        data-hs-input-number-decrement
                                                        onclick="decrementValue('<?php echo $cart_pd_id; ?>')">
                                                        <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14" />
                                                        </svg>
                                                    </button>
                                                    <input
                                                        class="p-0 w-6 bg-transparent border-0 text-center focus:ring-0 text-white"
                                                        type="text" name="order_qty"
                                                        oninput="updateTotal('<?php echo $cart_pd_price; ?>','<?php echo $cart_pd_id; ?>','<?php echo $ps_email; ?>')"
                                                        value="<?php echo $cart_qty; ?>" data-hs-input-number-input
                                                        id="quantityInput_<?php echo $cart_pd_id; ?>">
                                                    <button type="button"
                                                        class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border shadow-sm disabled:opacity-50 disabled:pointer-events-none bg-slate-900 border-gray-700 text-white hover:bg-gray-800 focus:outline-none focus:ring-1 focus:ring-gray-600"
                                                        data-hs-input-number-increment
                                                        onclick="incrementValue('<?php echo $cart_pd_id; ?>')">
                                                        <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14" />
                                                            <path d="M12 5v14" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-center">
                                        <h1 id="totalText"
                                            class="text-xl font-semibold text-white whitespace-nowrap">Total : RM
                                        </h1>
                                        <p class="text-xl font-semibold text-white whitespace-nowrap"
                                            id="result_<?php echo $cart_pd_id; ?>">
                                            <?= number_format($cart_pd_price * $cart_qty, 2) ?>
                                        </p>
                                    </div>
                                    <div>
                                        <!-- Checkbox for the current product -->
                                        <input type="checkbox" name="checkout_product[]" value="<?php echo $cart_pd_id; ?>"
                                            class="w-6 h-6 ml-5 shrink-0 mt-0.5 rounded-md text-blue-600 disabled:opacity-50 disabled:pointer-events-none bg-gray-800 border-gray-700 checked:bg-blue-500 checked:border-blue-500 focus:ring-offset-gray-800"
                                            id="hs-default-checkbox">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <!-- Display total price and checkout button in a single div -->
                            <!-- Display total price and checkout button in a single div, sticking to the right -->
                            <div class="border-t border-gray-600 flex justify-between p-3">
                                <h1 id="totalPrice"
                                    class="text-xl font-semibold text-white whitespace-nowrap">Total : RM
                                </h1>
                                <p class="text-xl font-semibold text-white whitespace-nowrap"
                                    id="total_<?php echo $ps_email; ?>">
                                    <?= number_format($totalPrice, 2) ?>
                                </p>
                                <div class="flex items-center ml-auto">
                                    <!-- Checkout button on the right side -->
                                    <button type="submit"
                                        class="p-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                        Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Add an event listener to all checkboxes with name 'checkout_product[]'
                            document.querySelectorAll('input[name="checkout_product[]"]').forEach(function (checkbox) {
                                checkbox.addEventListener('change', function () {
                                    updateTotalAmount();
                                });
                            });

                            function updateTotalAmount() {
                                // Initialize total amount
                                var totalAmount = 0;

                                // Iterate through all checked checkboxes
                                document.querySelectorAll('input[name="checkout_product[]"]:checked').forEach(function (checkbox) {
                                    // Extract the product price and add it to the total
                                    var cartPdId = checkbox.value;
                                    var productPrice = parseFloat(document.getElementById('result_' + cartPdId).innerText);
                                    totalAmount += productPrice;
                                });

                                // Update the total element
                                document.getElementById('total_<?php echo $ps_email; ?>').innerText = totalAmount.toFixed(2);
                            }
                        </script>

                        <?php
                    }
                } else {
                    ?>
                    <div
                        class="w-full h-max rounded-lg shadow bg-gray-800 border-gray-900 px-6 py-4">
                        <div>
                            <h2 class="text-xl tracking-tight text-white border-gray-600 p-3">No item in
                                the cart.</h2>
                        </div>
                    </div>
                    <br><br><br>
                    <br><br><br>
                    <?php
                }
                ?>
            </form>
        </div>
    </main>

    <!-- BAWAH INI KENA ADA -->
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updateTotal(price, cartPdId, psEmail) {
        var quantity = document.getElementById('quantityInput_' + cartPdId).value;
        var productPrice = price;
        var newTotal = quantity * productPrice;
        document.getElementById('result_' + cartPdId).innerText = newTotal.toFixed(2);

        // Update the total for the personal shopper
        updatePersonalShopperTotal(psEmail);
    }

    function incrementValue(cartPdId, psEmail) {
        var input = document.getElementById('quantityInput_' + cartPdId);
        input.value = parseInt(input.value) + 1;
        updateQuantity('increment', cartPdId, psEmail);
    }

    function decrementValue(cartPdId, psEmail) {
        var input = document.getElementById('quantityInput_' + cartPdId);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
        updateQuantity('decrement', cartPdId, psEmail);
    }

    function updateQuantity(operation, cartPdId, psEmail) {
        var input = document.getElementById('quantityInput_' + cartPdId);
        var newQuantity = parseInt(input.value);

        // Update the input field with the new quantity
        input.value = newQuantity;

        // Send an AJAX request to update the quantity in the database
        $.ajax({
            type: 'POST',
            url: 'cart_update.php',
            data: { quantity: newQuantity, cartPdId: cartPdId },
            dataType: 'text',
            success: function (response) {
                console.log('New Quantity:', newQuantity);
                console.log('Cart Product ID:', cartPdId);
                console.log('Quantity updated successfully:', response);

                // After updating quantity, also update the total
                updateTotal(<?php echo $cart_pd_price; ?>, cartPdId, psEmail);
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }

    function updatePersonalShopperTotal(psEmail) {
        // Calculate the new total for the personal shopper
        var psTotal = 0;
        $('[id^=result_]').each(function () {
            var resultId = $(this).attr('id');
            var resultPsEmail = resultId.split('_')[1];
            if (resultPsEmail === psEmail) {
                psTotal += parseFloat($(this).text());
            }
        });

        // Log debug information to the console
        console.log('psEmail:', psEmail);
        console.log('Matching elements:', $('[id^=result_]').filter('[id$=' + psEmail + ']'));

        // Find and update the total element for the personal shopper
        $('#total_' + psEmail).text(psTotal.toFixed(2));
    }
</script>
<script>
    function deleteCart(cart_pd_id, email) {
        // Redirect to Page 2 with the ID as a URL parameter
        window.location.href = 'cart_delete.php?delete_id=' + cart_pd_id + '&delete_email=' + email;
    }
</script>