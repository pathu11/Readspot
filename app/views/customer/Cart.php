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
                           
                            <!-- <td class="action-buttons">
                                <a href="#" class="cart-view purchase-btn" data-cartid="<?php echo $cart->cart_id; ?>" style="text-decoration: none;">
                                    <button class="view-button">
                                            <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </a>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td> -->
                            <!-- <td class="action-buttons">
                                <a href="#" class="cart-view purchase-btn" data-cartid="<?php echo $cart->cart_id; ?>" style="text-decoration: none;">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                                <a href="#" class="cart-view purchase-btn" data-cartid="<?php echo $cart->cart_id; ?>" style="text-decoration: none;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td> -->
                            <td class="action-buttons-cart">
                                <div class="view-button-c inline-block">
                                    <a href="#" class="cart-view purchase-btn" data-cartid="<?php echo $cart->cart_id; ?>" style="all: initial;">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                                <div class="delete-button-c inline-block" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="cart-view">Purchase Selected  All Items</button>
                

                
                <table border="1" class="tb-cart2" id="eventTable">
                    <tbody>
                        <?php foreach($data['cartDetails'] as $cart): ?>
                        <tr>
                            <td rowspan="5"><input type="checkbox"></td>
                            <td rowspan="5"><img src="<?php echo URLROOT; ?>/assets/images/publisher/addbooks/<?php echo $cart->img1; ?>" alt="Book" class="cart-image"></td>
                            <td><?php echo $cart->book_name; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $cart->price; ?> (per book)</td>
                        </tr>
                        <tr>
                            <td><?php echo $cart->quantity; ?> (quantity)</td>
                        </tr>
                        <tr>
                            <td><?php echo $cart->price*$cart->quantity; ?> (total)</td>
                        </tr>
                        <tr>
                            <!-- <td class="action-buttons">
                                <a href="<?php echo URLROOT; ?>/customer/purchase/<?php echo $cart->book_id; ?>" style="text-decoration: none;">
                                    <button class="view-button">
                                            <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </a>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td> -->
                            <td class="action-buttons-cart">
                                <div class="view-button-c inline-block">
                                    <a href="#" class="cart-view purchase-btn" data-cartid="<?php echo $cart->cart_id; ?>" style="all: initial;">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                                <div class="delete-button-c inline-block" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
                <div class="chk-btn-div">
                    <button class="checkout-btn">Checkout All</button>
                </div>
                <br>
                <br>
            </div>
            </form>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>


    <script>
    document.querySelectorAll('.purchase-btn').forEach(button => {
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

