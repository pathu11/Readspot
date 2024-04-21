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
                <form action="#.php" class="notify-search" autocomplete="off">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                </form>
                <br>
                <br>
                <div class="notification">
                <?php foreach($data['messageDetails'] as $msg) : ?>
                    <div class="notify">
                        
                        <input type="checkbox">
                        <h4><?php echo $msg->sender_name ; ?></h4>
                        <p><?php echo $msg->message ; ?>
                        <br><span><em><?php echo $msg->timestamp ; ?></em></span>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>


