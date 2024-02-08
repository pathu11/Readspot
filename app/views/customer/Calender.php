<?php
    $title = "My Calender";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="my-calender">
            <div class="calender-container">
                <div class="cal-left">
                    <div class="calender-div">
                        <div class="cal-months">
                            <i class="fa fa-angle-left prev"></i>
                            <div class="cal-date">november 2022</div>
                            <i class="fa fa-angle-right next"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
