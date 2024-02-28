<?php
    $title = "My Cart";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<?php
    require APPROOT . '/views/customer/sidebar.php'; //path changed
?>
<div class="container">
    <div class="my-cart">
        <div class="cart-topic">
            <h2>My Cart</h2>
        </div>
        <div class="mycart">
            <div class="cart-search" id="searchForm" onsubmit="handleSearch()">
                <input type="text" placeholder="Search.." name="search" id="searchInput">
            </div>
            <br>
            <br>
            <form method="POST" action="<?php echo URLROOT; ?>/PurchaseOrder/purchaseMultiple">
                <table border="1" class="tb-cart1" id="eventTable">
                    <thead>
                        <tr> 
                            <th></th>
                            <th>Image</th>
                            <th>Book Name</th>
                            <th>Price per book</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Checkout / Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['cartDetails'] as $cart): ?>
                        <tr>
                            <td><input type="checkbox" name="selectedItems[]" value="<?php echo $cart->cart_id; ?>"></td>
                            <td><img src="<?php echo URLROOT; ?>/assets/images/publisher/addbooks/<?php echo $cart->img1; ?>" alt="Book" class="cart-image"></td>
                            <td><?php echo $cart->book_name; ?></td>
                            <td><?php echo $cart->price; ?></td>
                            <td><?php echo $cart->quantity; ?></td>
                            <td><?php echo $cart->price*$cart->quantity; ?></td>
                            <td class="action-buttons">
                                <a href="#" class="view-button" data-cartid="<?php echo $cart->cart_id; ?>">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>   
                                <a class="delete-button" href="<?php echo URLROOT; ?>/customer/deleteCart/<?php echo $cart->cart_id; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br><br>
                <!-- <div class="chk-btn-div">
                    <button type="submit" class="checkout-btn">Purchase Selected Items</button>
                </div> -->
            <!-- </form> -->

            <table border="1" class="tb-cart2" id="eventTable">
                <tbody>
                    <?php foreach($data['cartDetails'] as $cart): ?>
                    <tr>
                        <td rowspan="4" style="width:5%;"> 
                            <input type="checkbox" name="selectedItems[]" value="<?php echo $cart->cart_id; ?>">
                        </td>
                        <td rowspan="4"><?php echo $cart->book_name; ?></td>
                        <td><?php echo $cart->price; ?> (per book)</td>
                    </tr>
                    <tr>
                        <td><?php echo $cart->quantity; ?> (quantity)</td>
                    </tr>
                    <tr>
                        <td><?php echo $cart->price*$cart->quantity; ?> (total)</td>
                    </tr>
                    <tr>
                        <td class="action-buttons">
                            <a href="#" class="view-button" data-cartid="<?php echo $cart->cart_id; ?>">
                                <i class="fas fa-shopping-cart"></i>
                            </a>   
                            <a class="delete-button" href="<?php echo URLROOT; ?>/customer/deleteCart/<?php echo $cart->cart_id; ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <div class="chk-btn-div">
                <button id="checkoutBtn" class="checkout-btn">Purchase Selected Items</button>
                <button id="deleteBtn" class="delete-btn">Delete Selected Items</button>
                </div>
                    </form>
        </div>
        <ul class="pagination" id="pagination">
            <li id="prevButton">«</li>
            <li class="current">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>6</li>
            <li>7</li>
            <li>8</li>
            <li>9</li>
            <li>10</li>
            <li id="nextButton">»</li>
        </ul>
    </div>
    <?php
        require APPROOT . '/views/customer/footer.php'; //path changed
    ?>
</div>

<script>
     function handleCheckout() {
    document.querySelectorAll('.tb-cart1 input[type="checkbox"]:checked, .tb-cart2 input[type="checkbox"]:checked').forEach(input => {
        input.closest('form').submit();
    });
}

// Function to handle delete action
function handleDelete() {
    document.querySelectorAll('.tb-cart1 input[type="checkbox"]:checked, .tb-cart2 input[type="checkbox"]:checked').forEach(input => {
        const cartId = input.value;
        window.location.href = '<?php echo URLROOT; ?>/customer/deleteCart/' + cartId;
    });
}

// Attach event listeners to buttons
document.getElementById('checkoutBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default anchor tag behavior
    handleCheckout();
});

document.getElementById('deleteBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default anchor tag behavior
    handleDelete();
});




    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor tag behavior
            
            const cartId = this.getAttribute('data-cartid');  
            // Create a form element
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo URLROOT; ?>/PurchaseOrder/purchaseMultiple';
            
            // Create a hidden input field to hold the cart ID
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selectedItems[]';
            input.value = cartId;
            
            // Append the input field to the form
            form.appendChild(input);
            
            // Append the form to the document body
            document.body.appendChild(form);
            
            // Submit the form
            form.submit();
        });
    });
</script>
