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
                
                <table border="1" class="tb-cart1" id="eventTable">
                    <thead>
                        <tr>
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
                            <td><?php echo $cart->book_name; ?></td>
                            <td><?php echo $cart->price; ?></td>
                            <td><?php echo $cart->quantity; ?></td>
                            <td><?php echo $cart->price*$cart->quantity; ?></td>
                            <!-- <td><div class="cart-vd"><a href="<?php echo URLROOT; ?>/customer/purchase/<?php echo $cart->book_id; ?>" class="cart-view">Checkout</a><a href="#" class="cart-delete">Remove</a></div></td> -->
                            <td class="action-buttons">
                                <a href="<?php echo URLROOT; ?>/customer/purchase/<?php echo $cart->book_id; ?>" style="text-decoration: none;">
                                    <button class="view-button">
                                            <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </a>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


                <table border="1" class="tb-cart2" id="eventTable">
                    <tbody>
                        <?php foreach($data['cartDetails'] as $cart): ?>
                        <tr>
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
                                <a href="<?php echo URLROOT; ?>/customer/purchase/<?php echo $cart->book_id; ?>" style="text-decoration: none;">
                                    <button class="view-button">
                                            <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </a>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
