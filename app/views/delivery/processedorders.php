<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/orders.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>All Orders</title>
    <script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</head>
<body>
<?php require APPROOT . '/views/delivery/sidebar.php';?>
<a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a>
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
                <th style="width:20%">Picked up</th>

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
                
                <th>
                    <div class="popup" onclick="myFunction(<?php echo $orderDetails->order_id; ?>)">
                            <i class='fas fa-check-circle' style='font-size:36px'></i>
                                <div class="popuptext" id="myPopup_<?php echo $orderDetails->order_id; ?>">
                                    <p>Are you sure the order is pickedup from sender's location ?</p><br>
                                    <a class="button" href='<?php echo URLROOT; ?>/delivery/pickedUp/<?php echo $orderDetails->order_id; ?>'>Yes</a>
                                    <a class="button" href='<?php echo URLROOT; ?>/delivery/processedorders'>No</a>
                                </div>
                             </div>
                </th>
               
                <th><a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $orderDetails->receiver_user_id; ?>"><i class='fas fa-comment-dots' style='font-size:36px'></i></a></th>

                <th><a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $orderDetails->receiver_user_id; ?>"><i class='fas fa-comment-dots' style='font-size:36px'></i></a></th>
            </tr>
            <?php endforeach; ?>

            

        </table>
    </div>
   
</body>

<script>

function myFunction(orderId) {
    var popup = document.getElementById("myPopup_" + orderId);
    popup.classList.toggle("show");
}
</script>
</html>