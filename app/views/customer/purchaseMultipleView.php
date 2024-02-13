
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
    <form method="POST" action="<?php echo URLROOT; ?>/PurchaseOrder/purchaseMultipleView"> 
       
    <?php echo  $data['deliveryDetails']->priceperkilo; ?>
        <div class="flex-parent-element">
        <div class="flex-child-element magenta">
            <h1>Billing Details</h1>  
            <input type="text" name="postal_name" class="<?php echo (!empty($data['postal_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_name']; ?>" placeholder="Name" required><br>
            <span class="error"><?php echo $data['postal_name_err']; ?></span>

            <input type="text" name="street_name" class="<?php echo (!empty($data['street_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street_name']; ?>" placeholder="Street Name" required >

            <input type="text" name="town" class="<?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['town']; ?>" placeholder="City" required><br>
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

            <input type="text" name="postal_code" class="<?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_code']; ?>" placeholder="Postal Code" required><br>
            <input type="text" name="contact_no" class="<?php echo (!empty($data['contact_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_no']; ?>" placeholder="Contact Number" required><br>

            <span class="error"><?php echo $data['contact_no_err']; ?></span>
        </div>
        <div class="flex-child-element green">
>                   <table border="1">
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                        <?php foreach ($data['bookDetails'] as $book): ?>
                            <tr>
                                <td><?php echo $book[0]->book_id; ?></td>
                                <td><?php echo $book[0]->book_name; ?></td>
                                <td><?php echo $book[0]->price; ?></td>
                                <td><?php echo $book[0]->nowQuantity; ?></td>
                                <td><?php echo $book[0]->total_price; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    
                    <input type="submit" value="Place Order" name="submit" class="submit">
                    
        </div>
        </div>
    </form>     
</body>
