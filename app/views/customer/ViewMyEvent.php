<?php
    $title = "View Events";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="event-details">
        <div class="back-btn-div">
            <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="event-main">
            <div class="event-img-div">
                <img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $data['mainImg']; ?>" alt="Book3" class="event-img"> <!--path changed-->
            </div>
            <div class="req-books-details-E">
                <h2>Event Details</h2><br>
                <ul>
                    <li><hr><h3>Event Name : <span><?php echo $data['Name']; ?></span></h3><hr></li>
                    <li><h3>Event Category : <span><?php echo $data['Category']; ?></span></h3><hr></li>
                    <li><h3>Start Date : <span><?php echo $data['Start_date']; ?></span></h3><hr></li>
                    <li><h3>End Date : <span><?php echo $data['End_date']; ?></span></h3><hr></li>
                    <li><h3>Start Time : <span><?php echo $data['Start_time']; ?></span></h3><hr></li>
                    <li><h3>End Time : <span><?php echo $data['End_time']; ?></span></h3><hr></li>
                    <li><h3>Venue : <span><?php echo $data['Venue']; ?></span></h3><hr></li>
                </ul>
            </div>
            <div class="event-des-div">
                <p><?php echo $data['Description']; ?></P>
            </div>
        </div>
        <div class="event-img-div-sub">
            <img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $data['img1']; ?>" alt="Book3" class="event-img-sub"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $data['img2']; ?>" alt="Book3" class="event-img-sub"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $data['img3']; ?>" alt="Book3" class="event-img-sub"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $data['img4']; ?>" alt="Book3" class="event-img-sub"> <!--path changed-->
            <img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $data['img5']; ?>" alt="Book3" class="event-img-sub"> <!--path changed-->
        </div>
        
        <div class="event-btn-div">
            <a href="<?php echo URLROOT; ?>/customer/UpdateEvent/<?php echo $data['eventId']; ?>">
                <button id="addBtn" class="event-chat-btn">Edit Event</button>
            </a>
        </div>

    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
