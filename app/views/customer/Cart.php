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
                            <a href="<?php echo URLROOT; ?>/PurchaseOrder/purchase/<?php echo $cart->book_id; ?>?quantity=<?php echo $cart->quantity; ?>" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a>
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
