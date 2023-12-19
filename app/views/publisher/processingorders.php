
<?php
    $title = "Processing  Orders";
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Pending Orders</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/orders.css" />

</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>

<?php   require APPROOT . '/views/publisher/subnav.php';?>
    <div class="div_table" style="width:90%">
    <p> Processing Orders >></p>
    <!-- <?php var_dump($orderDetails); ?> -->
        <table>
            <tr>
                <th style="width:7%;background-color: #009D94;">Order ID</th>
                <th style="width:7%;background-color: #009D94;">Book ID</th>
                <th style="width:7%;background-color: #009D94;">No of Items</th>
                <th style="width:7%;background-color: #009D94;">Customer Details</th>
                <th style="width:7%;background-color: #009D94;">Total Price(Rs)</th>
                <th style="width:2%;background-color: #009D94;">Send to Delivery</th>
                <th style="width:2%;background-color: #009D94;">Contact Customer</th>

            </tr>
            <?php foreach($data['orderDetails'] as $orderDetails): ?>
            <tr>
                <th style="width:7%"><?php echo $orderDetails->order_id; ?></th>
                <th style="width:7%"><?php echo $orderDetails->book_id; ?></th>
                <th style="width:7%"><?php echo $orderDetails->quantity; ?></th>
                <th style="width:7%"><?php echo $data['customerName']; ?></th>
                <th style="width:7%"><?php echo $orderDetails->total_price; ?></th>
                
                
            </tr>
            <?php endforeach; ?> 

        </table>
    </div>
    <?php   require APPROOT . '/views/publisher/footer.php';?>





</body>


</html>