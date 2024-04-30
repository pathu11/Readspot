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
                <h2>Messages</h2>
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
                        <div class="notify unread-message">
                            <h4><?php echo $msg->name ; ?></h4>
                            <p>
                                <?php echo $msg->msg ; ?>
                                <!-- <span><em><?php echo $msg->timestamp ; ?></em></span> -->
                            </p>
                            <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $msg->chat_id; ?>"><button class="view-button notify-view-btn">
                                <i class="fas fa-comment-alt"></i>
                            </button></a>
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
