<?php
    $title = "Profile";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/purchase.css">
    
</head>
<div class="form-container">
    <div class="column">
        <h1>Billing Details</h1>      
        <label>
            <input type="radio" name="addressType" value="defaultAddress">
                Use default Address
        </label>
        <div class="default-address-form">
            <form> 
                <input type="hidden" name="form_type" value="default_address">  
                <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_name']; ?>" placeholder="Name" readonly><br>
                <span class="error"><?php echo $data['postal_name_err']; ?></span>

                <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street_name']; ?>" placeholder="Street Name" readonly>

                <input type="text" name="town" class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['town']; ?>" placeholder="City" readonly><br>
                <span class="error"><?php echo $data['town_err']; ?></span>

                <select class="select <?php echo (!empty($data['district_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['district']; ?>" name="district" disabled>                                
                <?php
                    $district = array(
                        "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", "Galle", "Gampaha","Hambantota", "Jaffna", "Kalutara", "Kandy", "Kegalla", "Kilinochchi", "Kurunegala","Mannar", "Matale", "Matara", "Moneragala", "Mullaitivu", "Nuwara Eliya", "Polonnaruwa","Puttalam", "Ratnapura", "Trincomalee", "Vavuniya");
                            foreach ($district as $district) {
                                $selected = ($data['district'] === $district) ? 'selected' : '';
                                echo "<option value=\"$district\" $selected >$district</option>";
                                            }
                                        ?>
                </select>
                <span class="error"><?php echo $data['district_err']; ?></span>

                <input type="text" name="postal_code" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_code']; ?>" placeholder="Postal Code" readonly><br>
                <span class="error"><?php echo $data['postal_code_err']; ?></span>
                <button class="submit" type="button" onclick="goBack()">Back</button>
                <input type="submit" value="Next" name="submit" class="submit">
            </form>
     </div>
        <br><br>
        <label>
            <input type="radio" name="addressType" value="newAddress">
                Add New Address
        </label>
        
     <div class="new-address-form">
            <form> 
                <input type="hidden" name="form_type" value="new_address">  
                <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>"  placeholder="Name" readonly><br>
                <span class="error"><?php echo $data['postal_name_err']; ?></span>

                <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>"  placeholder="Street Name" readonly>

                <input type="text" name="town" class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>"  placeholder="City" readonly><br>
                <span class="error"><?php echo $data['town_err']; ?></span>

                <select class="select <?php echo (!empty($data['district_err'])) ? 'is-invalid' : ''; ?>" name="district" required>                               
                    <option value="" selected disabled>Select Your district</option>
                    <option value="Ampara">Ampara</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Badulla">Badulla</option>
                                <option value="Batticaloa">Batticaloa</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Galle">Galle</option>
                                <option value="Gampaha">Gampaha</option>
                                <option value="Hambantota">Hambantota</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Kalutara">Kalutara</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kegalla">Kegalla</option>
                                <option value="Kilinochchi">Kilinochchi</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Mannar">Mannar</option>
                                <option value="Matale">Matale</option>
                                <option value="Matara">Matara</option>
                                <option value="Moneragala">Moneragala</option>
                                <option value="Mullaitivu">Mullaitivu</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Puttalam">Puttalam</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Vavuniya">Vavuniya</option>
                </select>
                <span class="error"><?php echo $data['district_err']; ?></span>
                <input type="text" name="postal_code" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>"  placeholder="Postal Code" readonly><br>
                <span class="error"><?php echo $data['postal_code_err']; ?></span>
                <button class="submit" type="button" onclick="goBack()">Back</button>
                <input type="submit" value="Next" name="submit" class="submit">
            </form>
        </div>       
    </div>
    <div class="column">
        <div class="upperCol">
            <?php foreach($data['bookDetails'] as $books): ?>
            <h1>Your Order</h1>
            <div class="order">
                <div class="col1">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book.jpg" alt="Bell Image" width="180px">
                </div>
                <div class="col2">
                    <div class="cost">
                        <div>
                            <h2><?php echo $books->book_name; ?></h2>
                            <p><em><?php echo $books->quantity; ?> books  in stock</em></p>
                            <p><em><?php echo $books->weight; ?>g per book</em></p>

                        </div>
                        <div>
                            
                            <input type="number" id="quantity" max="<?php echo $books->quantity; ?>" min="1" oninput="updatePrice(this.value, <?php echo $books->price; ?>)">
                        </div> 
                           
                          
                    </div><br><br><br>
                    <hr color="black" size="3" width="100%"> <br> 
                    <div class="cost">
                        <div class="subcost">
                            <p>Subtotal</p>
                            <p>Delivery Fee</p>
                            <p>Total</P>
                        </div>
                        <div  class="subcost2">
                            <p><span id="totalPrice"><?php echo $books->price; ?></span></p>
                            <p><span id="deliveryCharge"><?php echo $books->price; ?></span></p>
                            <p><span id="totalCost"><?php echo $books->price; ?></span></p>

                        </div> 
                        
                    </div>
                </div>
            </div>
            
            
           
            
        <?php endforeach; ?>
        </div>   
        <div class="upperCol">
                <h1>Select Your Payment Method></h1>
                <label>
                    <input type="radio" name="paymentType" value="cardPayment">
                        Card Payment
                </label>
                <div class="cardPayment-form">
                    
                   <button onClick="paymentGateway();">Pay here</button>
                   <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                   <!-- <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script> -->
                </div>
                <br><br>
                <label>
                    <input type="radio" name="paymentType" value="OnlineDeposit">
                        Online Deposit
                </label>
                <div class="onlineBanking-form">
                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.

                        Bank Name: Hatton National Bank - Hulftsdorp Branch
                        Acc. Name: M.D. Gunasena & Co. (Pvt.) Ltd.
                        Acc. No: 063010004901
                        BIC/Swift: HBLILKLX</p>
                        <span>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our Privacy Policy.</span>
                        <label>submit your bank recipt after the payment</label>
                        <input type="file" name="recipt">
                        <button type="submit" >place Order</button>
                </div>
                <br><br>
                <label>
                    <input type="radio" name="paymentType" value="COD">
                        Cash On Delivery
                </label>
                <div class="COD-form">
                    <p>Pay with cash upon delivery. (We will confirm the order by a phone call before accepting so make sure to enter a valid mobile number.)
                    </p>
                    <button type="submit" >place Order</button>
                </div>
                
                
               

        </div>                                   
        
   
    </div>
</div>

    
    <script>
   
function paymentGateway(){
    var xhttp =new XMLHttpRequest();
    xhttp.onreadystatechange=()=>{
        console.log(xhttp.readyState);
        console.log(xhttp.status);
        if(xhttp.readyState==4 && xhttp.status ==200){
            alert(xhttp.responseText);
            console.log(xhttp.responseText);
            var obj=JSON.parse(xhttp.responseText);
            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + obj["order_id"]);
                
            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
              
                console.log("Payment dismissed");
            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                console.log("Error:"  + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1225428",    
                "return_url": "http:localhost/Readspot/customer/purchase/79",     
                "cancel_url": "http:localhost/Readspot/customer/purchase/79",   
                
                "notify_url": "http://sample.com/notify",
                "order_id": obj["order_id"],
                "items": "Door bell wireles",
                "amount": obj["amount"],
                "currency":obj["currency"],
                "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                "first_name": "Saman",
                "last_name": "Perera",
                "email": "samanp@gmail.com",
                "phone": "0771234567",
                "address": "No.1, Galle Road",
                "city": "Colombo",
                "country": "Sri Lanka",
                "delivery_address": "No. 46, Galle road, Kalutara South",
                "delivery_city": "Kalutara",
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };
            payhere.startPayment(payment);
        }
    };
    xhttp.open("GET","<?php echo URLROOT; ?>/customer/payhereProcess",true);
    xhttp.send();
}
    var cardPaymentForm = document.querySelector('.cardPayment-form');
    var onlineBankingForm = document.querySelector('.onlineBanking-form');
    var codForm = document.querySelector('.COD-form');

    document.querySelectorAll('input[name="paymentType"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            if (this.value === 'cardPayment') {
                cardPaymentForm.style.display = 'block';
                onlineBankingForm.style.display = 'none';
                codForm.style.display = 'none';

            } else if (this.value === 'OnlineDeposit') {
                cardPaymentForm.style.display = 'none';
                onlineBankingForm.style.display = 'block';
                codForm.style.display = 'none';
            }else if (this.value === 'COD') {
                cardPaymentForm.style.display = 'none';
                onlineBankingForm.style.display = 'none';
                codForm.style.display = 'block';
            } else {
                cardPaymentForm.style.display = 'none';
                onlineBankingForm.style.display = 'none';
                codForm.style.display = 'none';
            }
        });
    });

    var newAddressForm = document.querySelector('.new-address-form');
    var defaultAddressForm = document.querySelector('.default-address-form');

    document.querySelectorAll('input[name="addressType"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            if (this.value === 'newAddress') {
                newAddressForm.style.display = 'block';
                defaultAddressForm.style.display = 'none';
            } else if (this.value === 'defaultAddress') {
                newAddressForm.style.display = 'none';
                defaultAddressForm.style.display = 'block';
            } else {
                newAddressForm.style.display = 'none';
                defaultAddressForm.style.display = 'block';
            }
        });
    });

    function goBack() {
        window.history.back();
    }
   
    var priceperkilo = <?php echo $data['deliveryDetails']->priceperkilo; ?>;
    var priceperadditional = <?php echo $data['deliveryDetails']->priceperadditional; ?>;
    var maxQuantity = <?php echo $data['bookDetails'][0]->quantity; ?>;
    var weightPerBook = <?php echo $data['bookDetails'][0]->weight; ?>/1000;
    
    function updatePrice(quantity, unitPrice) {
        quantity = parseInt(quantity);
        unitPrice = parseFloat(unitPrice);

        if (quantity >= 1 && quantity <= maxQuantity) {
            var totalPrice = quantity * unitPrice;

            // Calculate delivery charges
            var totalWeight = quantity * weightPerBook;
            var deliveryCharge = calculateDeliveryCharge(totalWeight, priceperkilo, priceperadditional);

            // Calculate total cost
            var totalCost = totalPrice + deliveryCharge;

            // Update the total price, delivery charge, and total cost display elements
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
            document.getElementById('deliveryCharge').innerText = deliveryCharge.toFixed(2);
            document.getElementById('totalCost').innerText = totalCost.toFixed(2);
        } 
    }

    function calculateDeliveryCharge(totalWeight, weightPerKiloCharge, additionalWeightCharge) {
        // Assuming weightPerKiloCharge is for the first kilogram
        var firstKiloCharge = weightPerKiloCharge;

        // Subtracting 1 from totalWeight to account for the first kilogram
        var additionalWeightChargeTotal = Math.max(0, totalWeight - 1) * additionalWeightCharge;

        // Calculate total delivery charge
        var totalDeliveryCharge = firstKiloCharge + additionalWeightChargeTotal;

        return totalDeliveryCharge;
    }

    function goBack() {
        window.history.back();
    }
</script>

