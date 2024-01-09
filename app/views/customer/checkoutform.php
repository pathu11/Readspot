<?php
    $title = "My Favorite";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="checkout-main">
        <div class="check-form">
        <!-- <form action="/action_page.php" class="check-form"> -->
            <div class="check-form-main">
                <div class="billing-address">
                <label>
                    <input type="radio" name="paymentType" value="cardPayment">
                        Card Payment
                </label>
                <label>
                    <input type="radio" name="paymentType" value="OnlineDeposit">
                        Online Deposit
                </label>
                <label>
                    <input type="radio" name="paymentType" value="COD">
                        Cash On Delivery
                </label>
                   
                </div>
                <div class="payment">
                    <h3>Payment</h3>
                    <div class="cardPayment-form">
                    
                        <button onClick="paymentGateway();">Pay here</button>
                        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                  
                    </div>
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
                <div class="COD-form">
                    <p>Pay with cash upon delivery. (We will confirm the order by a phone call before accepting so make sure to enter a valid mobile number.)
                    </p>
                    <button type="submit" >place Order</button>
                </div>


                </div>
            </div>
            <input type="submit" value="Pay 1700.00" class="btn-checkout">
</div>
        <!-- </form> -->
    </div>
    <?php
        require APPROOT . '/views/customer/footer.php'; //path changed
    ?>
    
<script>
    function paymentGateway() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(xhttp.responseText);

                var obj = JSON.parse(xhttp.responseText);

                // PayHere initialization
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + obj["order_id"]);
                };

                payhere.onDismissed = function onDismissed() {
                    console.log("Payment dismissed");
                };

                payhere.onError = function onError(error) {
                    console.log("Error:" + error);
                };

                var payment = {
                    "sandbox": true,
                    "merchant_id": "1225428",
                    "return_url": "http://localhost/Readspot/customer/checkoutform",
                    "cancel_url": "http://localhost/Readspot/customer/checkoutform/",
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["order_id"],
                    "items": "Door bell wireles",
                    "amount": obj["amount"],
                    "currency": obj["currency"],
                    "hash": obj["hash"],
                    "first_name": obj["first_name"],
                    "last_name": obj["last_name"],
                    "email": obj["email"],
                    "phone": obj["phone"],
                    "address": obj["address"],
                    "city": obj["city"],

                    "country": "Sri Lanka",
                    "delivery_address": "No. 46, Galle road, Kalutara South",
                    "delivery_city": "Kalutara",
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Start PayHere payment
                payhere.startPayment(payment);
            }
        };

        // AJAX request to retrieve payment details
        xhttp.open("GET", "<?php echo URLROOT; ?>/customer/checkoutform", true);
        xhttp.send();
    }
    
    document.addEventListener('DOMContentLoaded', function () {
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
                } else if (this.value === 'COD') {
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
    });

</script>