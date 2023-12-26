<?php
    $title = "Notification";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notification</title>
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
                <span>You've 3 unread notifications </span>
            </div>
            <div class="head1">
                <button id="markAllRead" class="markAllRead" >Mark all as read</button>
            </div>
        </div>

       
       
         <div id="messagesContainer">
         <table>
         <?php foreach ($data['messageDetails'] as $message): ?>
    <tr>
    <a href="#"><th style="width:20%" >
            
            <h4><?php echo $message->sender_name; ?></h5>
           
        </th>
        <td style="width:80%">
            <h4><?php echo $message->topic; ?>  </h4>
            <!-- <p><?php echo $message->message; ?></p> -->
            <p>
                <?php
                    // Display only the first two lines of the message
                    $lines = explode("\n", $message->message);
                    echo $lines[0] . '<br>' . (isset($lines[1]) ? $lines[1] : '');
                ?>
            </p>
            
        </td>
        <td style="width:10%">
        <a href="<?php echo URLROOT; ?>/publisher/viewMessage/<?php echo $message->message_id; ?>" class="view" data-message-id="<?php echo $message->message_id; ?>"  data-user-id="<?php echo $message->user_id; ?>">View</a>   
        
        </td>
        
    </tr></a>
<?php endforeach; ?>
            
        </table>
            
            
         </div> 
    
    <script>var urlroot="<?php echo URLROOT; ?>"
        console.log(urlroot)</script>
    <script>
    <script>
        $(document).ready(function () {
            $('#markAllRead').click(function (e) {
            e.preventDefault();

            // Collect all user IDs
            var userIds = $('.view').map(function () {
                return $(this).data('user-id');
            }).get();

            // Assuming you have a backend endpoint to mark selected messages as read
            $.ajax({
                type: 'POST',
                url: urlroot + '/publisher/markSelectedAsRead',
                data: { userIds: userIds },
                success: function () {
                    // After marking selected as read, reload the messages
                    loadMessages();
                }
            });
        });

            $('.m').click(function (e) {
                e.preventDefault();
                var messageId = $(this).data('message-id');
                window.location.href = urlroot + '/publisher/viewMessage/' + messageId;
            });

            function loadMessages() {
                // Assuming you have a backend endpoint to fetch messages
                $.ajax({
                    type: 'GET',
                    url: urlroot + '/publisher/customerSupport',
                    success: function (data) {
                        // Update the messagesContainer with the fetched messages
                        $('#messagesContainer').html(data);
                    }
                });
            }
           


            
            loadMessages();
        });
    </script>
</body>

</html>
