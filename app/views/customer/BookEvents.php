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
            <?php foreach($data['eventDetails'] as $event): ?>
            <div class="B0-E">
                <img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $event->poster; ?>" alt="Book1" class="event-E">
                
                <a href="<?php echo URLROOT; ?>/customer/viewevents/<?php echo $event->id; ?>"><button class="dts-btn-E">View Event</button></a>
            </div>
            <?php endforeach; ?>
        </div>
        
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
