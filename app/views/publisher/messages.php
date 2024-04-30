<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/customerSupport.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/event.css" />

    <title>Messages</title>
</head>

<body>
    <?php require APPROOT . '/views/publisher/sidebar.php'; ?>
    <div class="body">
        <input type="text" class="search-bar" id="searchInput" placeholder="Search" oninput="searchMessages()">
        <div class="container">
            <div class="head">
                <div class="head1">
                    <h4>Chat Details</h4>
                </div>
            </div>
            <!-- <?php foreach($data['chatDetails'] as $chat): ?>
                      <?php  $senderId = $chat->incoming_msg_id; ?>
                 <?php endforeach; ?>    -->

            <?php foreach ($data['chatDetails'] as $message): ?>
                <div class="chat-pub">
                    <div>
                        <p> <?php echo $data['senderDetails'][$senderId]->name; ?></p>
                        <p>
                            <?php
                            // Display only the first two lines of the message
                            $lines = explode("\n", $message->msg);
                            echo $lines[0] . '<br>' . (isset($lines[1]) ? $lines[1] : '');
                            ?>
                        </p>
                    </div>
                    <div>
                        <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $message->chat_id; ?>">
                            <i class="fa fa-arrow-right back-icon"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
        require APPROOT . '/views/publisher/footer.php'; //path changed
    ?>
    <script src="<?php echo URLROOT; ?>/assets/js/publisher/table.js"></script>
    
    <script>
        function searchMessages() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toLowerCase();
            var messages = document.getElementsByClassName("chat-pub");

            for (var i = 0; i < messages.length; i++) {
                var senderName = messages[i].getElementsByTagName("p")[0].innerText.toLowerCase();
                var messageText = messages[i].getElementsByTagName("p")[1].innerText.toLowerCase();

                if (senderName.indexOf(filter) > -1 || messageText.indexOf(filter) > -1) {
                    // Bold the matched parts in sender name
                    messages[i].getElementsByTagName("p")[0].innerHTML = senderName.replace(new RegExp(filter, 'gi'), match => `<strong>${match}</strong>`);
                    // Bold the matched parts in message text
                    messages[i].getElementsByTagName("p")[1].innerHTML = messageText.replace(new RegExp(filter, 'gi'), match => `<strong>${match}</strong>`);
                    messages[i].style.display = "";
                } else {
                    // Reset sender name to original
                    messages[i].getElementsByTagName("p")[0].innerHTML = senderName;
                    // Reset message text to original
                    messages[i].getElementsByTagName("p")[1].innerHTML = messageText;
                    messages[i].style.display = "none";
                }
            }
        }
    </script>
   
</body>

</html>
