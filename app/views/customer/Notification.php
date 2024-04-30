<?php
    $title = "Notification";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="notify-content">
            <div class="notify-topic">
                <h2>Notification</h2>
            </div>
            <?php if(empty($data['messageDetails'])): ?>
                <?php echo '
                    <br><br><h3 style="text-align:center;">No Notifications.</h3>'; ?>
            <?php else : ?>
            <div class="notification-main">
                <!-- <form action="#.php" class="notify-search" autocomplete="off">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button>
                </form> 
                <br>-->
                <br>
                <div class="notification">
                    <?php foreach($data['messageDetails'] as $msg) : ?>
                        <div class="notify <?php echo ($msg->status == 'read') ? 'read-message' : 'unread-message'; ?>">
                            <h4><?php echo $msg->sender_name ; ?></h4>
                            <p>
                                <?php echo $msg->message ; ?>
                                <br>
                                <span><em><?php echo $msg->timestamp ; ?></em></span>
                            </p>
                            <button class="view-button notify-view-btn" onclick='viewNotification(<?php echo json_encode($msg); ?>)'>
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <?php endif; ?>
        </div>

        <div id="myModal" class="modal0">
    <div class="modal-content0">
        <span class="close" id="closeModalBtn">&times;</span>
        <div class="form1" id="bookDetailsTable">
            <!-- Event details will go here -->
        </div>
    </div>
</div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>


    <script>
        function closeModal(msg) {
            document.getElementById("myModal").style.display = "none";
            window.location.href = "<?php echo URLROOT; ?>/customer/ViewNotification/"+ msg.message_id;; // Redirect to the event page
        }

        function viewNotification(msg) {
            var modal = document.getElementById("myModal");
            var bookDetailsTable = document.getElementById("bookDetailsTable");
            
            bookDetailsTable.innerHTML = `
                <h2>${msg.sender_name}</h2>
                <div class="ordertablediv">
                    <p>${msg.message}</p><br>
                    <span><em><?php echo $msg->timestamp ; ?></em></span>
                </div>
            `;
            modal.style.display = "block";

            // Pass the message to the closeModal function
            document.getElementById("closeModalBtn").addEventListener("click", function() {
                closeModal(msg);
            });
        }
    </script>