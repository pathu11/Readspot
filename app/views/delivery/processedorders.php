<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/productgallery.css">
    <title>All Orders</title>
</head>
<body>
<?php require APPROOT . '/views/delivery/sidebar.php';?>

<?php require APPROOT . '/views/delivery/subnav.php';?>
    <div class="div_table" style="width:90%">
    <p> Processing Orders >></p>
        <table>
            <tr>
                <th style="width:15%">Order ID</th>
                <th style="width:15%">No of Items</th>
                <th style="width:15%">Total Weight</th>
                <th style="width:25%">Sender's Address</th>
                <th style="width:20%">Reciever's Address</th>
                <th style="width:5%">Contact sender</th>
                <th style="width:5%">Contact reciever</th>
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
   
</body>

</html>