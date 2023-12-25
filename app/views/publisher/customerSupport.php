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
                <button id="markAllRead">Mark all as read</button>
            </div>
        </div>

       
       
         <div id="messagesContainer">
         <table>
         <?php foreach ($data['messageDetails'] as $message): ?>
    <tr>
        <th style="width:70%" >
            <h4><?php echo $message->topic; ?></h5>
            <p><?php echo $message->message; ?></p>
        </th>
        <td style="width:15%">
            <button class="view">View</button>
        </td>
        <td style="width:15%">
            <button class="delete">Delete</button>
        </td>
    </tr>
<?php endforeach; ?>
            
        </table>
            
            
         </div> 
    
    <script>var urlroot="<?php echo URLROOT; ?>"
        console.log(urlroot)</script>
    <script>
    <script>
        $(document).ready(function () {
          
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
