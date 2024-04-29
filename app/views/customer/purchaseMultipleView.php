<?php
    $title = "Profile";
    require APPROOT . '/views/customer/header.php'; // Path changed
?>
<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/purchase.css">
    <style>
        .visible {
            visibility: hidden;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body> 
    <form method="POST" action="<?php echo URLROOT; ?>/PurchaseOrder/purchaseMultipleView">
        <div class="flex-parent-element">
            <div class="flex-child-element magenta">
                <h1>Billing Details</h1>
                <!-- Billing details inputs -->
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

                <input type="text" name="postal_code" pattern="^\d{5}$" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_code']; ?>" placeholder="Postal Code" required><br>

                <input type="text" name="contact_no" pattern="\+\d{11}" class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" placeholder="Contact Number(+94112323234)" required><br>

                <span class="error"><?php echo $data['contact_no_err']; ?></span>

                <img src="<?php echo URLROOT; ?>/assets/images/customer/purchase2.jpg" height="250px">
            </div>
            <div class="flex-child-element green">
                <h1>Your Order</h1>
                <table border="1">
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Subcost</th>
                    </tr>
                    <?php foreach ($data['bookDetails'] as $index => $book): ?>
                        <tr>
                            <td>
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
                                    <a class="quantity-button-p" onclick="decrement(<?php echo $index; ?>)"><i class="fas fa-minus"></i></a>
                                    <span class="span" id="quantity_<?php echo $index; ?>" onchange="updateQuantity(<?php echo $index; ?>)">
                                        <?php echo $book[0]->nowQuantity; ?>
                                    </span>
                                    <a class="quantity-button-p" onclick="increment(<?php echo $index; ?>)"><i class="fas fa-plus"></i></a>
                                </div>
                               
                            </td>
                            <td>
                                <?php if ($book[0]->discounts > 0): ?>
                                    <span id="subtotal_price_with_discounts_<?php echo $index; ?>"> Rs. <?php echo $book[0]->total_price_with_discounts; ?> </span>
                                    <span id="subtotal_price_<?php echo $index; ?>_undiscounted" style="text-decoration:line-through;color:red;"> Rs. <?php echo $book[0]->total_price; ?> </span>
                                <?php else: ?>
                                    <span id="subtotal_price_<?php echo $index; ?>"> Rs. <?php echo $book[0]->total_price; ?> </span>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <input id="book_quantity_<?php echo $index; ?>" name="book_quantities[]" class="visible" value="<?php echo $book[0]->nowQuantity; ?>">
                        <input type="hidden" id="maxQuantity_<?php echo $index; ?>" value="<?php echo $book[0]->maxQuantity; ?>">
                    <?php endforeach; ?>
                </table>
                <br><hr><br>
                <div class="cost">
                    <div class="subcost">
                        <p>Subtotal</p> 
                        <p>Delivery Fee</p>
                        <p> Redeem Points</p>
                    </div>
                    <div class="subcost2">
                        <p id="totalCostDisplay">Rs. <?php echo $book[0]->total_price; ?></p>
                        <p id="totalDeliveryDisplay">Rs. <?php echo $data['deliveryDetails']->priceperkilo; ?></p> 
                        <p id="addRedeemPoints" onclick="toggleRedeemPoints()">Add Your Redeem Points <i class="fas fa-chevron-down"></i></p>  
                    </div>
                </div>
                <div id="redeemPointsDetails" class="redeem" style="display: none;">
                    <span>You have  <?php echo $data['redeempoint']->redeem_points; ?> redeem points.Use them for buy this order</span><br><br>
                    <input type="number" name="totalRedeem"  id="redeemPointsInput" value="0" min="0" max="<?php echo $data['redeempoint']->redeem_points; ?>">
                    <a href="#" class="apply" onclick="applyRedeemPoints()">Apply</a>
                </div>
                <div class="cost">
                    <div class="subcost">
                        <p>Total</P>
                    </div>
                    <div class="subcost2">
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
    function toggleRedeemPoints() {
        var x = document.getElementById("redeemPointsDetails");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

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

        if (quantity < maxQuantity) {
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

    function updateTotalCost(index, quantity) {
        let totalCost = 0;
        let totalWeight = 0;
        let deliveryFee = 0;
        let bookDetails = <?php echo json_encode($data['bookDetails']); ?>;

        for (let i = 0; i < bookDetails.length; i++) {
            let book = bookDetails[i][0];
            let bookQuantity = parseInt(document.getElementById('quantity_' + i).innerText);
            let subtotalPrice = book.discounts > 0 ? (book.perOnePrice - (book.perOnePrice * book.discounts * 0.01)) * bookQuantity : book.perOnePrice * bookQuantity;

            totalCost += subtotalPrice;
            totalWeight += book.perOneWeight * bookQuantity;

            let subtotalElement;
            if (book.discounts > 0) {
                subtotalElement = document.getElementById('subtotal_price_with_discounts_' + i);

            } else {
                subtotalElement = document.getElementById('subtotal_price_' + i);
            }
            subtotalElement.innerText = "Rs. " + subtotalPrice;

            if (book.discounts > 0) {
                let undiscountedSubtotalElement = document.getElementById('subtotal_price_' + i + '_undiscounted');
                if (undiscountedSubtotalElement) {
                    undiscountedSubtotalElement.innerText = "Rs. " + (book.perOnePrice * bookQuantity);
                }
            }
        }
        document.getElementById('totalCostDisplay').innerText = "Rs. " + totalCost;
        document.getElementById('subtotalPriceInput').value = totalCost;
        let firstKiloCharge = <?php echo $data['deliveryDetails']->priceperkilo; ?>;
        let additionalKiloCharge = <?php echo $data['deliveryDetails']->priceperadditional; ?>;
        if (totalWeight > 1000) {
            let additionalWeight = Math.ceil((totalWeight - 1000) / 1000);
            deliveryFee = firstKiloCharge + (additionalWeight * additionalKiloCharge);
        } else {
            deliveryFee = firstKiloCharge;
        }

        // totalCost += deliveryFee;
        let totalPrice = totalCost + deliveryFee;
        // document.getElementById('totalCostDisplay').innerText = "Rs. " + totalCost;
        // document.getElementById('subtotalPriceInput').value = totalCost;
        document.getElementById('totalDeliveryDisplay').innerText = "Rs. " + deliveryFee;
        document.getElementById('totalPriceDisplay').innerText = "Rs. " + totalPrice;
        document.getElementById('totalCostInput').value = totalPrice;
        document.getElementById('totalWeightInput').value = totalWeight;
        document.getElementById('totalDeliveryInput').value = deliveryFee;
    }

    function applyRedeemPoints() {
        let redeemPoints = parseInt(document.getElementById('redeemPointsInput').value);
        let availableRedeemPoints = parseInt(document.getElementById('redeemPointsInput').max);
        let totalCost = parseFloat(document.getElementById('totalCostDisplay').innerText.split(' ')[1]);
        let deliveryFee = parseFloat(document.getElementById('totalDeliveryDisplay').innerText.split(' ')[1]);
        let newTotalPrice = totalCost + deliveryFee - redeemPoints;
        if (redeemPoints > availableRedeemPoints || redeemPoints < 0) {
            sweetAlert();
            return; 
        }
        document.getElementById('totalPriceDisplay').innerText = "Rs. " + newTotalPrice;
        document.getElementById('totalCostInput').value = newTotalPrice;
    }

    function sweetAlert() {
        Swal.fire({
            title: 'Error!',
            text: 'Entered redeem points exceed the maximum available redeem points.',
            icon: 'warning',
            confirmButtonText: 'OK',
            confirmButtonColor: "#70BFBA",
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to login page
                window.location.href = window.location.href;
            }
        });

        return false;
    }

    function updateHiddenQuantity(index, quantity) {
        document.getElementById('book_quantity_' + index).value = quantity;
    }
</script>

<?php
require APPROOT . '/views/customer/footer.php'; // Path changed
?>
