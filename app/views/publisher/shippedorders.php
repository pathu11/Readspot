
<?php
    $title = "Shipped  Orders";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Shipping Orders</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/orders.css" />

</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>

<?php   require APPROOT . '/views/publisher/subnav.php';?>
    <div class="div_table" style="width:90%">
    <p> Shipped Orders >></p>
        <table>
        <!-- <?php var_dump($data['publisherName']); ?>
        <?php var_dump($data['customerName']); ?> -->

            <tr>
                <th style="width:7%;background-color: #009D94;">Order ID</th>
                <th style="width:7%;background-color: #009D94;">Product ID</th>
                <th style="width:7%;background-color: #009D94;">No of Items</th>
                <th style="width:14%;background-color: #009D94;">Customer Details</th>
                <th style="width:10%;background-color: #009D94;">Total Price(Rs)</th>
                

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