<?php
    $title = "My Favorite";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head>
    <style>
        .submit {
            width: 100px;
            height: 40px;
            background-color: #009D94;
            border-radius: 5px;
            margin-top: 0;
            border: none;
            color:white;
        }

        .submit:hover {
            background-color: #70BFBA;
            border-radius: 5px;
            margin-top: 0;
            border: none;
        }

    </style>
</head>
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
                    <form action="<?php echo URLROOT; ?>/customer/checkout2/<?php echo $data['order_id']; ?>" method="POST">
                        <input type="hidden" name="form_type" value="cardPayment">
                        <button class="submit" onClick="paymentGateway();">Pay here</button>
                        
                        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                    </form>
                    </div>
                    <div class="onlineBanking-form">
                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.<p>

                        <h4>Bank Name: Hatton National Bank - Hulftsdorp Branch</h4>
                        <h4>Acc. Name: M.D. Gunasena & Co. (Pvt.) Ltd.</h4>
                        <h4>Acc. No: 063010004901</h4>
                        <h4> BIC/Swift: HBLILKLX</h4>
                        <span>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our Privacy Policy.</span>
                        <label>submit your bank recipt after the payment</label>
                    <form action="<?php echo URLROOT; ?>/customer/checkout2/<?php echo $data['order_id']; ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="onlineDeposit">
                        <input type="file" name="recipt" required><br>
                        <button  class="submit" type="submit" >Conform Order</button>

                    </form>
                </div>
                <div class="COD-form">
                    <form action="<?php echo URLROOT; ?>/customer/checkout2/<?php echo $data['order_id']; ?>" method="POST">
                        <input type="hidden" name="form_type" value="COD">
                        <p>Pay with cash upon delivery. (We will confirm the order by a phone call before accepting so make sure to enter a valid mobile number.)
                        </p>
                        <button class="submit" type="submit" >Conform Order</button>
                    </form>
                </div>
                </div>
            </div>
            <!-- <input type="submit" value="Pay 1700.00" class="btn-checkout"> -->
</div>
        <!-- </form> -->
    </div>
    <?php
        require APPROOT . '/views/customer/footer.php'; //path changed
    ?>
    
<script>
    function paymentGateway() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var obj = JSON.parse(xhttp.responseText);

                // PayHere initialization
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID: " + obj["order_id"]);
                };

                payhere.onDismissed = function onDismissed() {
                    console.log("Payment dismissed");
                };

                payhere.onError = function onError(error) {
                    console.log("Error: " + error);
                };

                var payment = {
                    "sandbox": true,
                    "merchant_id": "1225428",
                    "return_url": "http://localhost/Readspot/",
                    "cancel_url": "http://localhost/Readspot/",
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["order_id"],
                    "items": obj["items"],
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
        xhttp.open("GET", "<?php echo URLROOT; ?>/customer/checkout2", true);
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