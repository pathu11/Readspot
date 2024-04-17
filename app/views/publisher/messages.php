
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Messages</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/notification.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
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
                <h4>Your Messages</h4>
                
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
                    <h4><?php echo $data['senderName']; ?></h5>
                </th>
                <td style="width:80%">
                    <p><?php
                    // Display only the first two lines of the message
                    $lines = explode("\n", $message->msg);
                    echo $lines[0] . '<br>' . (isset($lines[1]) ? $lines[1] : '');
                ?></p>    
                </td>
                <td style="width:10%">
                
                <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $message->chat_id; ?>" class="view">View</a>   
                
                </td>
                
            </tr></a>
<?php endforeach; ?>
            
        </table>
            
            
         </div> 
         <?php
            require APPROOT . '/views/publisher/footer.php'; //path changed
        ?>
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
