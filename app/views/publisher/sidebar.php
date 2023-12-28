<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/sidebar.css" >


    <nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <img src="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png" class="readSpot-logo">
        <span class="logo-name">ReadSpot</span>
         <span class="user"><?php echo $data['publisherName']?></span>
         <?php foreach($data['publisherDetails'] as $publisherDetails): ?>
        <?php
                    $profileImage = empty($publisherDetails->profile_img) ? URLROOT . '/assets/images/publisher/person.jpg' : URLROOT . '/assets/images/publisher/addbooks/' . $publisherDetails->profile_img ;
                ?>
        <?php endforeach; ?>
        <img style="border-radius:60%;width:3%;height:3%;" src="<?php echo $profileImage; ?>">
        
    </div>
       
      </div>
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">ReadSpot</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="<?php echo URLROOT; ?>/publisher/index" class="nav-link">
                <i class="bx bxs-dashboard icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT; ?>/publisher/productGallery" class="nav-link">
                <i class="bx bxs-calendar-event icon"></i>
                <span class="link">Books</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT; ?>/publisher/processingorders" class="nav-link">
                <i class="bx bxs-note icon"></i>
                <span class="link">Orders</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT; ?>/publisher/events" class="nav-link">
                <i class="bx bxs-calendar-event icon"></i>
                <span class="link">Events</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT; ?>/publisher/setting" class="nav-link">
                <i class="bx bxs-book-heart icon"></i>
                <span class="link">My Profile</span>
              </a>
            </li>
          <div class="bottom-cotent">
            <li class="list">
              <a href="<?php echo URLROOT; ?>/publisher/customerSupport" class="nav-link">
                <i class="bx bxs-cog icon"></i>
                <span class="link">Notifications</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT; ?>/publisher/logout" class="nav-link">
                <i class="bx bxs-log-out icon"></i>
                <span class="link">Logout</span>
              </a>
            </li>
          </div>
        </div>
      </div>
    </nav>

    <section class="overlay"></section>

    <script src="<?php echo URLROOT; ?>/assets/js/publisher/sidebar.js"></script>
  </body>
  