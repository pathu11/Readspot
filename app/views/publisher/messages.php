<?php
    $title = "Notification";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Messages</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/notification.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <?php require APPROOT . '/views/publisher/sidebar.php';?>
    <div class="chat-container1">
        <input type="text" placeholder=" Search..." class="search-bar">
    </div>
    <div class="chat">
        <div class="head">
            <div class="head1">
                <h4>Notifications</h4>
                <span>You've <?php echo $data['unreadCount']; ?> unread notifications </span>
            </div>
            <div class="head1">
                <button id="markAllRead" class="markAllRead" >Mark all as read</button>
            </div>
        </div>      
         <div id="messagesContainer">
         <table>
         <?php foreach ($data['chatDetails'] as $message): ?>
            <tr >
            
            <a href="#"><th style="width:20%" >
                    
                    <!-- <h4><?php echo $message->sender_name; ?></h5> -->
                
                </th>
                <td style="width:80%">
                    <!-- <h4><?php echo $message->topic; ?>  </h4> -->

                    <p><?php echo $message->msg; ?></p>
                    <p><?php echo $message->msg_id; ?></p>
                    <p>incoming<?php echo $message->incoming_msg_id; ?></p>
                    <p>outgoing<?php echo $message->outgoing_msg_id; ?></p>
                    
                </td>
                <td style="width:10%">
                
                <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $message->chat_id; ?>">View</a>   
                
                </td>
                
            </tr></a>
<?php endforeach; ?>
            
        </table>
            
            
         </div> 
   
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
