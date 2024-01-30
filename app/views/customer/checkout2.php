<?php
    $title = "My Favorite";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/checkoutform.css"> 
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
<!-- <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script> -->

    <!-- <div class="checkout-main">
        <div class="check-form">
        <form action="/action_page.php" class="check-form">
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
            </div>           
</div>  -->
<div class="flex-parent-element">
    <div class="flex-child-element magenta">
        <table>
            <tr>
                <td>Item</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
            <tr>
                <td>Item</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
    </table>
      
    </div>
    <div class="flex-child-element magenta">
        <div class="payment-details">
            <p>Customer Billing Details(Ship to this Address)<p>

           <div class="billing-details">
                <p>hi</p>
                <p>hi</p>
                <p>hi</p>

            </div>
            <div class="billing-details">
                <p>hi</p>
                <p>hi</p>
                <p>hi</p>

            </div>
        </div>
        <div class="billing-details">
            <div>
                
            </div>
            <hr>
            <div>
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
        </div>
        

                            
                            
                            </div>
    </div>
</div>
<div id="onlineDepositPopup" class="onlineBanking-form-popup">
                       
                       <div class="modal-content">
                       
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
                   </div>
                   <div id="cardPaymentPopup" class="cardPayment-form-popup">
                      
                       <div class="modal-content">
                       
                       <form action="<?php echo URLROOT; ?>/customer/checkout2/<?php echo $data['order_id']; ?>" method="POST">
                       <input type="hidden" name="form_type" value="cardPayment">
                       <button id="payhere" class="submit" >Pay here</button>
                       
                       <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                   </form>
                   
                   </div>
                   </div>

                   <div id="CODPopup" class="COD-form-popup">
                      
                       <div class="modal-content">
                       
                       <form action="<?php echo URLROOT; ?>/customer/checkout2/<?php echo $data['order_id']; ?>" method="POST">
                       <input type="hidden" name="form_type" value="COD">
                       <p>Pay with cash upon delivery. (We will confirm the order by a phone call before accepting so make sure to enter a valid mobile number.)
                       </p>
                       <button class="submit" type="submit" >Conform Order</button>
                   </form>
                   </div>
                   </div>
                      
    </div>
    <?php
        require APPROOT . '/views/customer/footer.php'; //path changed
    ?>
    
<script>
    let payHereButton=document.querySelector("#payhere");
    payHereButton.addEventListener("click",(e)=>{
        e.preventDefault();
        paymentGateway("cardPayment");
    })

   function paymentGateway(formType) {
    var xhttp = new XMLHttpRequest();
    var params = `form_type=${formType}`;

    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(xhttp.responseText);
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
                    "return_url": "<?php echo URLROOT; ?>/customer/Cart",
                    "cancel_url": "<?php echo URLROOT; ?>/customer/checkout2",
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
                console.log(payment) ;            // Start PayHere payment
                payhere.startPayment(payment);
            }
        };
        // AJAX request to retrieve payment details
        xhttp.open("POST", "<?php echo URLROOT; ?>/customer/checkout2/" + <?php echo $data['order_id']; ?>, true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        xhttp.send(params);
    }
    
    document.addEventListener('DOMContentLoaded', function () {
        var onlineBankingFormPopup = document.getElementById('onlineDepositPopup');
        var cardPaymentFormPopup = document.getElementById('cardPaymentPopup');
        var CODFormPopup = document.getElementById('CODPopup');

        document.querySelectorAll('input[name="paymentType"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === 'cardPayment') {
                    cardPaymentFormPopup.style.display = 'block';
                    onlineBankingFormPopup.style.display = 'none';
                    CODFormPopup.style.display = 'none';
                } else if (this.value === 'OnlineDeposit') {
                    onlineBankingFormPopup.style.display = 'block';
                    cardPaymentFormPopup.style.display = 'none';
                    CODFormPopup.style.display = 'none';
                } else if (this.value === 'COD') {
                    CODFormPopup.style.display = 'block';
                    cardPaymentFormPopup.style.display = 'none';
                    onlineBankingFormPopup.style.display = 'none';
                } else {
                    cardPaymentFormPopup.style.display = 'none';
                    onlineBankingFormPopup.style.display = 'none';
                    CODFormPopup.style.display = 'none';
                }
            });
        });
    });
</script>