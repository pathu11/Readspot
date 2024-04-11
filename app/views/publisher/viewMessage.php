
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notification</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/notification.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <?php require APPROOT . '/views/publisher/sidebar.php';?>
    
    <div class="chat">
         <div id="messagesContainer">
         <?php foreach ($data['messageDetails2'] as $message): ?>
           <div class="msg"> 
            <h2><?php echo $message->topic; ?></h2>
            <br>
            <br>
            <h4>From <b><span style="font-size:20px;"><?php echo $message->sender_name; ?></span> </b><span>to me...</span></h4>
            <br>
            <p><?php echo $message->message; ?></p><br>
            <button class="submit" data-receiver-id="<?php echo $message->sender_id; ?>" data-parent-id="<?php echo $message->message_id; ?>">Reply</button>

            <button class="submit1" onclick="goBack()">Back</button>
        <?php endforeach; ?>
         </div> 
    
    <script>
        var urlroot = "<?php echo URLROOT; ?>";
       
        $(document).ready(function () {
            $('.submit').click(function (e) {
                e.preventDefault();
                var receiverId = $(this).data('receiver-id');
                var parentId = $(this).data('parent-id');
                $('#parentId').val(parentId);
                window.location.href = urlroot + '/publisher/message?parent_id=' + parentId + '&receiver_id=' + receiverId;
            });
        });
    </script>
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
