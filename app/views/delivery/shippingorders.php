<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/orders.css">

    <title>All Orders</title>

</head>

<body>
    <?php require APPROOT . '/views/delivery/sidebar.php';?>

    <?php require APPROOT . '/views/delivery/subnav.php';?>
    <div class="div_table" style="width:90%">
    <p> Shipping  Orders >></p>
    <table>
            <tr>
                <th style="width:10%">Order ID</th>
                <th style="width:10%">No of Items</th>
                <th style="width:10%">Total Weight</th>
                <th style="width:15%">Sender's Address</th>
                <th style="width:15%">Reciever's Address</th>
                <th style="width:7%">Delivered </th>
                <th style="width:7%">Returned</th>

                <th style="width:5%">Contact sender</th>
                <th style="width:5%">Contact reciever</th>
            </tr>
            <?php foreach($data['orderDetails'] as $orderDetails): ?>
            <tr>
                <th style="width:7%"><?php echo $orderDetails->order_id; ?></th>
                <th style="width:7%"><?php echo $orderDetails->quantity; ?></th>
                <th style="width:7%"><?php echo $orderDetails->total_weight; ?></th>
                <th style="width:7%"><?php echo $orderDetails->sender_postal_name . ', ' . $orderDetails->sender_street_name . ', ' . $orderDetails->sender_town . ', ' . $orderDetails->sender_district . ', ' .$orderDetails->sender_postal_code ; ?></th>
                    <th style="width:7%"><?php echo $orderDetails->receiver_postal_name . ', ' . $orderDetails->receiver_street_name . ', ' . $orderDetails->receiver_town . ', ' . $orderDetails->receiver_district . ', ' .$orderDetails->receiver_postal_code; ?></th>
                <!-- Add other columns and data as needed -->
                <th>
                    <div class="popup" onclick="myFunctionDelivered(<?php echo $orderDetails->order_id; ?>)">
                        <i class='fas fa-check-circle' style='font-size:36px'></i>
                        <div class="popuptext" id="deliveredPopup_<?php echo $orderDetails->order_id; ?>">
                            <p>Are you sure the order is delivered to the receiver's location?</p><br>
                            <a class="button" href='<?php echo URLROOT; ?>/delivery/delivered/<?php echo $orderDetails->order_id; ?>'>Yes</a>
                            <a class="button" href='<?php echo URLROOT; ?>/delivery/shippingorders'>No</a>
                        </div>
                    </div>
                </th>
                <th>
                    <div class="popup" onclick="myFunctionReturned(<?php echo $orderDetails->order_id; ?>)">
                        <i class='fas fa-check-circle' style='font-size:36px'></i>
                        <div class="popuptext" id="returnedPopup_<?php echo $orderDetails->order_id; ?>">
                            <p>Are you sure the order is rejected and returned to the sender's location?</p><br>
                            <a class="button" href='<?php echo URLROOT; ?>/delivery/returned/<?php echo $orderDetails->order_id; ?>'>Yes</a>
                            <a class="button" href='<?php echo URLROOT; ?>/delivery/shippingorders'>No</a>
                        </div>
                    </div>
                </th>
                <th><a><i class='fas fa-comment-dots' style='font-size:36px'></i></a></th>
                <th><a><i class='fas fa-comment-dots' style='font-size:36px'></i></a></th>

            </tr>
            <?php endforeach; ?>

            

        </table>
    </div>
   
</body>

<script>
        function myFunctionDelivered(orderId) {
            var popup = document.getElementById("deliveredPopup_" + orderId);
            popup.classList.toggle("show");
        }

        function myFunctionReturned(orderId) {
            var popup = document.getElementById("returnedPopup_" + orderId);
            popup.classList.toggle("show");
        }
    </script>
</html>