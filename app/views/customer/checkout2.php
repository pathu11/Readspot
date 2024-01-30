<?php
    $title = "My Favorite";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/checkoutform.css"> 
    <style>
        .submit {
            width: 90%;
            height: 40px;
            background-color: #009D94;
            border-radius: 5px;
            margin-top: 0;
            border: none;
            color:white;
        }
        .submit:hover {
            background-color: white;
            border-radius: 5px;
            margin-top: 0;
            border: none;
        }
    </style>
</head>

<div class="flex-parent-element">
    <div class="flex-child-element magenta">
        <h1>
            Payment
    </h1>
    <br>
        <hr>
        <br>
        <table>
      
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach($data['orderDetails'] as $order): ?>
            <tr>
                <td> <?php 
                    if ($order->type == "new") {
                        echo '<img src="' . URLROOT . '/assets/images/publisher/addBooks/' . $order->img1 . '" alt="Bell Image" width="180px">';
                    } elseif ($order->type == "used") {
                        echo '<img src="' . URLROOT . '/assets/images/customer/addUsedBook/'. $order->img1 . '" alt="Bell Image" width="180px">';
                    } else {
                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                    }
            ?></td>
                <td><?php echo $order->total_price; ?></td>
                <td><?php echo $order->quantity; ?></td>
                <td><?php echo $order->total_price; ?></td>
            </tr>
            <?php endforeach; ?>
    </table>
      
    </div>
    <div class="flex-child-element magenta">
        <?php foreach($data['orderDetails'] as $order): ?>
        <div class="payment-details">
            <h2>Customer Billing Details(Ship to this Address)</h2>

            <div class="cost1">
                        <div class="subcost">
                            <p>Name</p>
                            <p>Address</p>
                            <p>Phone Number</P>
                        </div>
                        <div  class="subcost2">
                            <p><?php echo $order->c_postal_name; ?></p>
                            <p><?php echo $order->c_street_name; ?>,<?php echo $order->c_town; ?>,<?php echo $order->c_district; ?>,<?php echo $order->c_postal_code; ?></p>
                            <p><?php echo $order->contact_no; ?></p>

                        </div> 

                    </div>
        </div>
        <div class="billing-details">
            <div>
            <div class="cost">
                        <div class="subcost">
                            <p>Subtotal</p>
                            <p>Delivery Fee</p>
                            <p>Total</P>
                        </div>
                        <div  class="subcost2">
                            <p><?php echo $order->total_price; ?></p>
                            <p><?php echo $order->total_price; ?></p>
                            <p><?php echo $order->total_price; ?></p>

                        </div> 

                    </div>
            </div>
            <br><hr><br>
            <div>
                    <label>
                                <input type="radio" name="paymentType" value="cardPayment">
                                    Card Payment
                            </label><br>
                            <label>
                                <input type="radio" name="paymentType" value="OnlineDeposit">
                                    Online Deposit
                            </label><br>
                            <label>
                                <input type="radio" name="paymentType" value="COD">
                                    Cash On Delivery
                            </label>
            </div><br><br>
            <div id="cardPaymentButton"style="display: none;" >
                    
                       
                       <form action="<?php echo URLROOT; ?>/customer/checkout2/<?php echo $data['order_id']; ?>" method="POST">
                       <input type="hidden" name="form_type" value="cardPayment">
                       <button id="payhere" class="submit" >Pay here</button>
                       
                       <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                   </form>
                 
                   </div>

        </div>  
        <?php endforeach; ?>                 
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
                successOrder(obj["total_price"], obj["order_id"]);

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
    function successOrder(totalPrice, orderId) {
    // AJAX request to call the controller function
        var successXhttp = new XMLHttpRequest();
        var successParams = `total_price=${totalPrice}&order_id=${orderId}`;

        successXhttp.onreadystatechange = function () {
            if (successXhttp.readyState == 4 && successXhttp.status == 200) {
                console.log(successXhttp.responseText);
                // Handle any additional logic after successful order
            }
        };
        // AJAX request to handle successful order
        successXhttp.open("POST", "<?php echo URLROOT; ?>/customer/successCardPaymentOrder", true);
        successXhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        successXhttp.send(successParams);
    }
        
    document.addEventListener('DOMContentLoaded', function () {
        var onlineBankingFormPopup = document.getElementById('onlineDepositPopup');
        // var cardPaymentFormPopup = document.getElementById('cardPaymentPopup');
        var cardPaymentButton = document.getElementById('cardPaymentButton');
        var CODFormPopup = document.getElementById('CODPopup');

        document.querySelectorAll('input[name="paymentType"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === 'cardPayment') {
                    cardPaymentButton.style.display = 'block';
                } else if (this.value === 'OnlineDeposit') {
                    onlineBankingFormPopup.style.display = 'block';
                    cardPaymentFormPopup.style.display = 'none';
                    CODFormPopup.style.display = 'none';
                } else if (this.value === 'COD') {
                    CODFormPopup.style.display = 'block';
                    cardPaymentButton.style.display = 'none';
                    onlineBankingFormPopup.style.display = 'none';
                } else {
                    cardPaymentButton.style.display = 'none';
                    onlineBankingFormPopup.style.display = 'none';
                    CODFormPopup.style.display = 'none';
                }
            });
        });
    });
</script>