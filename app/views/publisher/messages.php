<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/event.css" />

    <title>Messages</title>
</head>

<body>
    <?php require APPROOT . '/views/publisher/sidebar.php'; ?>
    <div class="container">
    
        <table id="eventTable">
            <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
            <div class="head">
                <div class="head1">
                    <h4>Chat Details</h4>
                   
                </div>

            </div>
            <thead>
                <tr>

                   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['chatDetails'] as $message): ?>
                    <tr >
                        <td ><?php echo $data['senderName']; ?></td>
                       
                        <td  title="<?php echo $message->msg; ?>">
                            <?php
                    // Display only the first two lines of the message
                    $lines = explode("\n", $message->msg);
                    echo $lines[0] . '<br>' . (isset($lines[1]) ? $lines[1] : '');
                ?>
                        </td>
                        <td  class="action-buttons">
                            <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $message->chat_id; ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
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

    <script src="<?php echo URLROOT; ?>/assets/js/publisher/table.js"></script>
    <script>
    

</body>

</html>
