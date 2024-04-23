<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/event.css" />

    <title>Notifications</title>
    <style>
        p{
            margin-bottom:0px;
            text-align:left;
        }
        #eventTable td:nth-child(2) {
            width: 70%; 
        }
        
        </style>
</head>

<body>
    <?php require APPROOT . '/views/publisher/sidebar.php'; ?>
    <div class="container">
    
        <table id="eventTable">
            <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
            <div class="head">
                <div class="head1">
                    <h4>Notifications</h4>
                    <span>You've <?php echo $data['unreadCount']; ?> unread notifications </span>
                </div>

            </div>
            <!-- <thead>
                <tr>

                    <th>Sender Name</th>
                    <th>Title</th>
                    <th>Notification</th>
                    <th>Action</th>
                </tr>
            </thead> -->
            <tbody>
                <?php foreach ($data['messageDetails'] as $message): ?>
                    <tr style="background-color: <?php echo $message->status === 'read' ? 'white' : '#ebede9'; ?>;">
                        <td><p><?php echo $message->sender_name; ?><p></td>
                        <td>
                                <p><b><?php echo $message->topic; ?></b></p>
                                <p><?php
                            $lines = explode("\n", $message->message);
                            echo $lines[0] . '<br>' . (isset($lines[1]) ? $lines[1] : '');
                            ?></p><p style=" font-style: italic;"><?php echo $message->timestamp; ?></p>

                    </td>
                      
                        <td class="action-buttons">
                            <a href="#" onclick="openPopup('<?php echo htmlspecialchars('<h3>'.$message->sender_name .'</h3>'. '<h4>'. $message->topic . '</h4>' .'<p>' .$message->message.'</p>'); ?>')">
                                <i style="color: <?php echo $message->status === 'read' ? 'gray' : '#70BFBA'; ?>;" class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <table id="messageContent">
                    <!-- Message details will be displayed here -->
                </table>
            </div>
        </div>

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
        function openPopup(messageContent) {
            document.getElementById('messageContent').innerHTML = messageContent;
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>

</body>

</html>
