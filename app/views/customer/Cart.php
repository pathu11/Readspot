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
                <form action="#.php" class="cart-search">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                </form>
                <br>
                <br>
                
                <table border="1" class="tb-cart1">
                    <tr>
                        <th>Book Name</th>
                        <th>Price per book</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Checkout / Remove</th>
                    </tr>
                <?php foreach($data['cartDetails'] as $cart): ?>
                    
                    <tr>
                        <td><?php echo $cart->book_name; ?></td>
                        <td><?php echo $cart->price; ?></td>
                        <td><?php echo $cart->quantity; ?></td>
                        <td><?php echo $cart->cart_id; ?></td>
                        <td><div class="cart-vd"><a href="<?php echo URLROOT; ?>/customer/purchase/<?php echo $cart->book_id; ?>" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a></div></td>
                    </tr>
                    <?php endforeach; ?>
                    
                </table>
                <table border="1" class="tb-cart2">
                <tr><td rowspan="4">Lorem ipsum dolor sit amet</td>
                    <td>rs200.00 (per book)</td></tr>
                    <tr><td>3 (quantity)</td></tr>
                    <tr><td>rs600.00 (total)</td></tr>
                    <tr><td><div class="cart-vd"><a href="<?php echo URLROOT; ?>/customer/checkoutform" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a></div></td></tr>

                    <tr><td rowspan="4">Lorem ipsum dolor sit amet</td>
                    <td>rs200.00 (per book)</td></tr>
                    <tr><td>3 (quantity)</td></tr>
                    <tr><td>rs600.00 (total)</td></tr>
                    <tr><td><div class="cart-vd"><a href="<?php echo URLROOT; ?>/customer/checkoutform" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a></div></td></tr>

                    <tr><td rowspan="4">Lorem ipsum dolor sit amet</td>
                    <td>rs200.00 (per book)</td></tr>
                    <tr><td>3 (quantity)</td></tr>
                    <tr><td>rs600.00 (total)</td></tr>
                    <tr><td><div class="cart-vd"><a href="<?php echo URLROOT; ?>/customer/checkoutform" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a></div></td></tr>

                    <tr><td rowspan="4">Lorem ipsum dolor sit amet</td>
                    <td>rs200.00 (per book)</td></tr>
                    <tr><td>3 (quantity)</td></tr>
                    <tr><td>rs600.00 (total)</td></tr>
                    <tr><td><div class="cart-vd"><a href="<?php echo URLROOT; ?>/customer/checkoutform" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a></div></td></tr>

                    <tr><td rowspan="4">Lorem ipsum dolor sit amet</td>
                    <td>rs200.00 (per book)</td></tr>
                    <tr><td>3 (quantity)</td></tr>
                    <tr><td>rs600.00 (total)</td></tr>
                    <tr><td><div class="cart-vd"><a href="<?php echo URLROOT; ?>/customer/checkoutform" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a></div></td></tr>
                </table>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
