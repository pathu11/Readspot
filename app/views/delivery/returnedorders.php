<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">

    <title>Returned orders</title>
    <script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</head>

<body>
    <?php require APPROOT . '/views/delivery/sidebar.php';?>
    <!-- <a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a> -->
    <!-- <?php require APPROOT . '/views/delivery/subnav.php';?> -->
    <div class="container" >
    <div class="nav">
        <a href="<?php echo URLROOT; ?>/delivery/processedorders">Processing Orders</a>
        <a href="<?php echo URLROOT; ?>/delivery/shippingorders">Shipped Orders</a>
        <a href="<?php echo URLROOT; ?>/delivery/deliveredorders">Delivered Orders</a>
        <a href="<?php echo URLROOT; ?>/delivery/returnedorders">Returned Orders</a>
    </div>
    <p> Returned Orders >></p>
    <table id="eventTable">
    <thead>
            <tr>
                <th >Order ID</th>
                <th >No of Items</th>
                <th >Total Weight</th>
                <th >Sender's Address</th>
                <th >Reciever's Address</th>
                <th >Contact sender</th>
                <th >Contact reciever</th>
            </tr>
    </thead>
    <tbody>
            <?php foreach($data['orderDetails'] as $orderDetails): ?>
            <tr>
                <td ><?php echo $orderDetails->order_id; ?></td>
                <td ><?php echo $orderDetails->quantity; ?></td>
                <td><?php echo $orderDetails->total_weight; ?></td>
                <td ><?php echo $orderDetails->sender_postal_name . ', ' . $orderDetails->sender_street_name . ', ' . $orderDetails->sender_town . ', ' . $orderDetails->sender_district . ', ' .$orderDetails->sender_postal_code ; ?></td>
                <td ><?php echo $orderDetails->receiver_postal_name . ', ' . $orderDetails->receiver_street_name . ', ' . $orderDetails->receiver_town . ', ' . $orderDetails->receiver_district . ', ' .$orderDetails->receiver_postal_code; ?></td>

                <td><a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $orderDetails->sender_user_id; ?>"><i class='fas fa-comment-dots' style='font-size:26px;color:gray;'></i></a></td>

                <td><a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $orderDetails->receiver_user_id; ?>"><i class='fas fa-comment-dots' style='font-size:26px;color:gray;'></i></a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <ul class="pagination" id="pagination">
            <li id="prevButton">«</li>
            <li class="current">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>6</li>
            <li>7</li>
            <li>8</li>
            <li>9</li>
            <li>10</li>
            <li id="nextButton">»</li>
        </ul>
    </div>
    <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
</body>

</html>