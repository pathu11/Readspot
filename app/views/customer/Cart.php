<?php
    $title = "My Cart";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<?php
    require APPROOT . '/views/customer/sidebar.php'; //path changed
?>
<head>
<style>
        .action-buttons a {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color:#009D94 ;
            border-radius: 50%; 
            text-align: center;
            line-height: 30px;
            color: #fff; 
            margin-right: 5px;
            transition: background-color 0.3s ease; 
        }

        .action-buttons a:hover {
            background-color:#ccc;
        }
</style>
</head>
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
                            <td>
                                <!-- <img src="<?php echo URLROOT; ?>/assets/images/publisher/addbooks/<?php echo $cart->img1; ?>" alt="Book" class="cart-image"> -->
                                <?php
                                    if ($cart->type == "new") {
                                        echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/'. $cart->img1 . '" alt="Book" class="cart-image">';
                                    } elseif ($cart->type == "used") {
                                        echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/'. $cart->img1 . '" alt="Book" class="cart-image">';
                                    } else {
                                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                                    }
                                ?>
                            </td>
                            <td style=" width:6%;"><?php echo $cart->book_name; ?></td>
                            <td style=" width:20%;">
                                
                                <?php if ($cart->discounts > 0) {
                                    $discountedPrice = $cart->price - ($cart->price * $cart->discounts * 0.01);
                                    echo '<p>'. $discountedPrice .' <span style="text-decoration:line-through;color:red;">' . $cart->price . '</span> </p>';
                                } else{
                                    echo $cart->price;
                                }
                                ?>
                            </td>

                            <td><?php echo $cart->quantity; ?></td>
                            <td>
                                <?php if ($cart->discounts > 0) {
                                        $discountedPrice = $cart->price - ($cart->price * $cart->discounts * 0.01);
                                        echo '<p>'. $discountedPrice*$cart->quantity .' <span style="text-decoration:line-through;color:red;">' . $cart->price*$cart->quantity . '</span> </p>';
                                    } else{
                                        echo $cart->price*$cart->quantity;
                                    }
                                    ?>
                                
                        </td>
                            <td  class="action-buttons">
                                <a href="#" class="view-button-js" data-cartid="<?php echo $cart->cart_id; ?>">
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
            <?php if(empty($data['cartDetails'])): ?>
                    <?php echo '
                    <h3 style="text-align:center;">No Books in Your Cart.Continue Shopping </h3>'; ?>
                        <?php else : ?>
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
                            <a href="#" class="view-button-js" data-cartid="<?php echo $cart->cart_id; ?>">
                                <i class="fas fa-shopping-cart"></i>
                            </a>   
                            <a class="delete-button" href="<?php echo URLROOT; ?>/customer/deleteCart/<?php echo $cart->cart_id; ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif ; ?>
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
    document.querySelectorAll('.view-button-js').forEach(button => {
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