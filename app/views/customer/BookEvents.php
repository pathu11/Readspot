<?php
    $title = "Events";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-E1">
            <div class="Event-books">
                <h1>BOOK EVENTS</h2>
            </div>
        </div>
        <div class="sub-cont-E2">
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/event1.jpg" alt="Book1" class="event-E"> <!--path changed-->
                
                <a href="<?php echo URLROOT; ?>/customer/viewevents"><button class="dts-btn-E">View Event</button></a> <!--path changed-->
            </div>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/event2.jpg" alt="Book2" class="event-E"> <!--path changed-->
                
                <a href="<?php echo URLROOT; ?>/customer/viewevents"><button class="dts-btn-E">View Event</button></a> <!--path changed-->
            </div>
        </div>
        
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
