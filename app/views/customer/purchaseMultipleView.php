<?php
    $title = "Profile";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/purchase.css">
    <style>
        .visible {
            visibility: hidden;
        }
    </style>
</head>

<body>
    
    <form method="POST" action="<?php echo URLROOT; ?>/PurchaseOrder/purchaseMultipleView">
        <div class="flex-parent-element">
            <div class="flex-child-element magenta">
                <h1>Billing Details</h1>
                <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_name']; ?>" placeholder="Name" required><br>
                <span class="error"><?php echo $data['postal_name_err']; ?></span>

                <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street_name']; ?>" placeholder="Street Name" required>

                <input type="text" name="town" class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['town']; ?>" placeholder="City" required><br>
                <span class="error"><?php echo $data['town_err']; ?></span>

                <select class="select <?php echo (!empty($data['district_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['district']; ?>" name="district">
                    <?php
                    $district = array(
                        "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", "Galle", "Gampaha", "Hambantota", "Jaffna", "Kalutara", "Kandy", "Kegalla", "Kilinochchi", "Kurunegala", "Mannar", "Matale", "Matara", "Moneragala", "Mullaitivu", "Nuwara Eliya", "Polonnaruwa", "Puttalam", "Ratnapura", "Trincomalee", "Vavuniya"
                    );
                    foreach ($district as $district) {
                        $selected = ($data['district'] === $district) ? 'selected' : '';
                        echo "<option value=\"$district\" $selected >$district</option>";
                    }
                    ?>
                </select>
                <span class="error"><?php echo $data['district_err']; ?></span>

                <input type="text" name="postal_code" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_code']; ?>" placeholder="Postal Code" required><br>
                <input type="text" name="contact_no" class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" placeholder="Contact Number" required><br>

                <span class="error"><?php echo $data['contact_no_err']; ?></span>
            </div>
            <div class="flex-child-element green">
                <h1>Your Order</h1>
               
                <table border="1">
                    <tr>
                        <th style="width:17%;">Item</th>
                        <th>Quantity</th>
                        <th>Subcost</th>
                    </tr>

                    <?php foreach ($data['bookDetails'] as $index => $book): ?>
                        <tr>
                            <td style="width:17%;">
                                <?php
                                if ($book[0]->type == "new") {
                                    echo '<img src="' . URLROOT . '/assets/images/publisher/addBooks/' . $book[0]->img1 . '" alt="Bell Image" width="100px">';
                                } elseif ($book[0]->type == "used") {
                                    echo '<img src="' . URLROOT . '/assets/images/customer/addUsedBook/' . $book[0]->img1 . '" alt="Bell Image" width="100px">';
                                } else {
                                    echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="100px">';
                                }
                                ?>
                            </td>
                            <td>
                                <div style="justify-content: flex-start;" class="cart-item">
                                    <a class="quantity-button" onclick="decrement(<?php echo $index; ?>)">-</a>
                                    <span id="quantity_<?php echo $index; ?>" onchange="updateQuantity(<?php echo $index; ?>)">
                                        <?php echo $book[0]->nowQuantity; ?>
                                    </span>
                                    <a class="quantity-button" onclick="increment(<?php echo $index; ?>)">+</a>
                                    <input id="book_quantity_<?php echo $index; ?>" name="book_quantities[]" class="visible" value="<?php echo $book[0]->nowQuantity; ?>">
                                </div>
                                <input type="hidden" id="maxQuantity_<?php echo $index; ?>" value="<?php echo $book[0]->maxQuantity; ?>">
                            </td>
                            <td>
                                <span id="subtotal_price_<?php echo $index; ?>"> Rs. <?php echo $book[0]->total_price; ?> </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br><hr><br>
                <div class="cost">
                    <div class="subcost">

                        <p>Subtotal</p>
                        <p>Delivery Fee</p>
                        <p>Total</P>
                    </div>
                    <div class="subcost2">
                        <p id="totalCostDisplay">Rs. <?php echo $book[0]->total_price; ?></p>
                        <p id="totalDeliveryDisplay">Rs. <?php echo $data['deliveryDetails']->priceperkilo; ?></p>
                        <p id="totalPriceDisplay">Rs. <?php echo $book[0]->total_price + $data['deliveryDetails']->priceperkilo; ?></p>

                    </div>

                </div>

                <input type="number" id="subtotalPriceInput" name="subTotalPrice" step="any" class="visible">
                <input class="visible" type="number" id="totalCostInput" name="totalCost" step="any">
                <input class="visible" type="number" id="totalWeightInput" name="totalWeight" step="any">
                <input class="visible" type="number" id="totalDeliveryInput" name="totalDelivery" step="any">
                <input type="submit" value="Place Order" name="submit" class="submit">

            </div>
        </div>
    </form>
</body>

<script>
    // Call updateTotalCost for each book when the page is loaded
    window.addEventListener('DOMContentLoaded', (event) => {
        <?php foreach ($data['bookDetails'] as $index => $book): ?>
            updateTotalCost(<?php echo $index; ?>, <?php echo $book[0]->nowQuantity; ?>);
        <?php endforeach; ?>
    });

    // Function to increment the quantity
    function increment(index) {
        let quantityElement = document.getElementById('quantity_' + index);
        let quantity = parseInt(quantityElement.innerText);
        let maxQuantityInput = document.getElementById('maxQuantity_' + index);
        let maxQuantity = parseInt(maxQuantityInput.value);

        if (quantity <= maxQuantity) {
            quantity++;
            quantityElement.innerText = quantity;
            updateTotalCost(index, quantity); // Pass the updated quantity to updateTotalCost function
            updateHiddenQuantity(index, quantity);
        }
    }

    // Function to decrement the quantity
    function decrement(index) {
        let quantityElement = document.getElementById('quantity_' + index);
        let quantity = parseInt(quantityElement.innerText);
        if (quantity > 1) {
            quantity--;
            quantityElement.innerText = quantity;
            updateTotalCost(index, quantity); // Pass the updated quantity to updateTotalCost function
            updateHiddenQuantity(index, quantity);
        }
    }

    // Function to update total cost, delivery fee, and total weight
    function updateTotalCost(index, quantity) {
        let totalCost = 0;
        let totalWeight = 0;
        let deliveryFee = 0;
        let bookDetails = <?php echo json_encode($data['bookDetails']); ?>;

        // Calculate total price and total weight
        for (let i = 0; i < bookDetails.length; i++) {
            let book = bookDetails[i][0];
            let bookQuantity = parseInt(document.getElementById('quantity_' + i).innerText); // Get the current quantity
            totalCost += book.perOnePrice * bookQuantity;
            totalWeight += book.perOneWeight * bookQuantity;

            let subtotalElement = document.getElementById('subtotal_price_' + i);
            subtotalElement.innerText = "Rs. " + (book.perOnePrice * bookQuantity);
        }

        // Update the displayed total cost
        document.getElementById('totalCostDisplay').innerText = "Rs. " + totalCost;
        document.getElementById('subtotalPriceInput').value = totalCost; // Update hidden input field for subtotal price

        // Calculate delivery fee based on total weight
        let firstKiloCharge = <?php echo $data['deliveryDetails']->priceperkilo; ?>;
        let additionalKiloCharge = <?php echo $data['deliveryDetails']->priceperadditional; ?>;
        if (totalWeight > 1000) {
            let additionalWeight = Math.ceil((totalWeight - 1000) / 1000);
            deliveryFee = firstKiloCharge + (additionalWeight * additionalKiloCharge);
        } else {
            deliveryFee = firstKiloCharge;
        }

        // Calculate total price including delivery fee
        let totalPrice = totalCost + deliveryFee;

        // Update the displayed delivery fee and total price
        document.getElementById('totalDeliveryDisplay').innerText = "Rs. " + deliveryFee;
        document.getElementById('totalPriceDisplay').innerText = "Rs. " + totalPrice;

        // Update the hidden input fields with the updated values
        document.getElementById('totalWeightInput').value = totalWeight;
        document.getElementById('totalDeliveryInput').value = deliveryFee;
        document.getElementById('totalCostInput').value = totalPrice;
    }

    // Function to update the hidden quantity input field
    function updateHiddenQuantity(index, quantity) {
        document.getElementById('book_quantity_' + index).value = quantity;
    }
</script>

<?php
require APPROOT . '/views/customer/footer.php'; //path changed
?>
