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
                <!-- <form action="#.php" class="cart-search"> -->
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                <!-- </form> -->
                <br>
                <br>
                <form method="POST" action="<?php echo URLROOT; ?>/PurchaseOrder/purchaseMultiple">

                <table border="1" class="tb-cart1">
                    <tr>
                        <th>Select</th>
                        <th>Book Name</th>
                        <th>Price per book</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Checkout / Remove</th>
                    </tr>
                <?php foreach($data['cartDetails'] as $cart): ?>                   
                    <tr>
                        <td>
                            <input type="checkbox" name="selectedItems[]" value="<?php echo $cart->cart_id; ?>">
                        </td>
                      
                        <td><?php echo $cart->book_name; ?></td>
                        <td><?php echo $cart->price; ?></td>
                        <td><?php echo $cart->quantity; ?></td>
                        <td><?php echo $cart->quantity * $cart->price; ?></td>
                        <td>
                        <div class="cart-vd">
                        <a href="#" class="cart-view purchase-btn" data-cartid="<?php echo $cart->cart_id; ?>">checkout</a>
                            <a href="#" class="cart-delete">Remove</a>
                        </div>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    
                </table>

                <br>
                <button type="submit" class="cart-view">Purchase Selected  All Items</button>
                </form>
            </div>
            <a href="<?php echo URLROOT; ?>/PurchaseOrder/purchaseMultiple">select</a>
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

