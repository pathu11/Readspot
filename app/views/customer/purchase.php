<?php
    $title = "Profile";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/purchase.css">
    <style>
  .visible {
    visibility: hidden;
    
  }
</style>
</head>
<body>
<!-- <div class="flex-parent-element"> -->
    <form method="POST" action="<?php echo URLROOT; ?>/customer/purchase/<?php echo $data['book_id']; ?>"> 
       
    <?php echo  $data['deliveryDetails']->priceperkilo; ?>
        <div class="flex-parent-element">
        <div class="flex-child-element magenta">
            <h1>Billing Details</h1>  
            <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_name']; ?>" placeholder="Name" ><br>
            <span class="error"><?php echo $data['postal_name_err']; ?></span>

            <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street_name']; ?>" placeholder="Street Name" >

            <input type="text" name="town" class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['town']; ?>" placeholder="City" ><br>
            <span class="error"><?php echo $data['town_err']; ?></span>

            <select class="select <?php echo (!empty($data['district_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['district']; ?>" name="district" >                                
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

            <input type="text" name="postal_code" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_code']; ?>" placeholder="Postal Code" ><br>
            <input type="text" name="contact_no" class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" placeholder="Contact Number" ><br>

            <span class="error"><?php echo $data['contact_no_err']; ?></span>
        </div>
        <div class="flex-child-element green">

            <h1>Your Order</h1>
            <?php foreach($data['bookDetails'] as $books): ?>
            <div class="order">
                <div class="col1">
                <?php 
                    if ($books->type == "new") {
                        echo '<img src="' . URLROOT . '/assets/images/publisher/addBooks/' . $books->img1 . '" alt="Bell Image" width="180px">';
                    } elseif ($books->type == "used") {
                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                    } else {
                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                    }
            ?>
                        
                </div>
                <div class="col2">
                    <div class="cost">
                        <div>
                                <h2><?php echo $books->book_name; ?></h2>
                                <p><em><?php echo $books->quantity; ?> books  in stock</em></p>
                                <p><em><?php echo $books->weight; ?>g per book</em></p>

                        </div>
                        
                        <div>
                                
                              
                                <!-- <input type="number" id="quantity" max="<?php echo $books->quantity; ?>" min="1" oninput="updatePrice(this.value, <?php echo $books->price; ?>)" name="quantity" value="1"> -->
                                <input type="number" id="quantity" max="<?php echo $books->quantity; ?>" min="1" oninput="updatePrice(this.value, <?php echo $books->price; ?>)" name="quantity" value="1">
                               
                                <input type="number" id="totalCostInput" name="totalCost" step="any" class="visible">
                                <input type="number" id="totalWeightInput" name="totalWeight" step="any" class="visible">                                

                        </div> 
                    </div>
                    <br><br><br>
                    <hr color="black" size="3" width="100%"> <br> 
                    <div class="cost">
                        <div class="subcost">
                            <p>Subtotal</p>
                            <p>Delivery Fee</p>
                            <p>Total</P>
                        </div>
                        <div  class="subcost2">
                            <p><span id="totalPrice"><?php echo $books->price; ?></span></p>
                            <p><span id="deliveryCharge"><?php echo $data['deliveryDetails']->priceperkilo; ?></span></p>
                            <p><span id="totalCostSpan"><?php echo $books->price; ?></span></p>

                        </div> 

                    </div>
                    <input type="submit" value="Place Order" name="submit" class="submit">


                    <?php endforeach; ?>
                </div>

            </div>
            

        </div>
        </div>
    </form>     
</body>
<script>

    function goBack() {
        window.history.back();
    }

    //Fix DeliveryDetails
    var priceperkilo = <?php echo $data['deliveryDetails']->priceperkilo; ?>;
    var priceperadditional = <?php echo $data['deliveryDetails']->priceperadditional; ?>;

    // var priceperkilo = 20;
    // var priceperadditional = 20;
    var maxQuantity = <?php echo $data['bookDetails'][0]->quantity; ?>;
    var weightPerBook = <?php echo $data['bookDetails'][0]->weight; ?>/1000;

    function updatePrice(quantity, unitPrice) {
        quantity = parseInt(quantity);
        unitPrice = parseFloat(unitPrice);

        if (quantity >= 1 && quantity <= maxQuantity) {
            var totalPrice = quantity * unitPrice;

            // Calculate delivery charges
            var totalWeight = quantity * weightPerBook;
            var totalWeightG = quantity * weightPerBook*1000;

            var deliveryCharge = calculateDeliveryCharge(totalWeight, priceperkilo, priceperadditional);

            // Calculate total cost
            var totalCost = totalPrice + deliveryCharge;

            // Update the total price, delivery charge, and total cost display elements
            console.log(totalPrice, deliveryCharge, totalCost);
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
            document.getElementById('deliveryCharge').innerText = deliveryCharge.toFixed(2);
            document.getElementById('totalCostInput').value = totalCost.toFixed(2);
            document.getElementById('totalCostSpan').innerText = totalCost.toFixed(2);
            document.getElementById('totalWeightInput').value = totalWeightG.toFixed(2); // Add this line
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




    
</script>