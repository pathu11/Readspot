<?php
    $title = "My Favorite";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="checkout-main">
        <form action="/action_page.php" class="check-form">
            <div class="check-form-main">
                <div class="billing-address">
                    <h3>Billing Address</h3>
                    
                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="Ramath Perera">
                    
                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">

                    <label for="phone"><i class="fa fa-phone"></i> Telephone</label>
                    <input type="text" id="email" name="email" placeholder="07123456789">

                    <div class="row">
                        <div class="col-50">
                            <label for="district">District</label>
                            <input type="text" id="district" name="district" placeholder="Kaluthara">
                        </div>
                        <div class="col-50">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Panadura">
                        </div>
                        <div class="col-50">
                            <label for="zip">Zip</label>
                            <input type="text" id="zip" name="zip" placeholder="12500">
                        </div>
                    </div>
                </div>
                <div class="payment">
                    <h3>Payment</h3>
                    <label for="fname">Accepted Cards</label>
                    <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                    </div>
                    
                    <label for="cname">Name on Card</label>
                    <input type="text" id="cname" name="cardname" placeholder="Ramath Perera">
                    
                    <label for="ccnum">Credit card number</label>
                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                    
                    <div class="row">
                        <div class="col-50">
                            <label for="expire">Expire</label>
                            <input type="text" id="expire" name="expire" placeholder="MM/YY">
                        </div>
                        <div class="col-50">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="352">
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Pay 1700.00" class="btn-checkout">
        </form>
    </div>
    <?php
        require APPROOT . '/views/customer/footer.php'; //path changed
    ?>
    
