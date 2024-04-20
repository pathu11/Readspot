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
        <span class="user"><?php echo $data['superadminName']?></span>
        <!-- <i class="bx bxs-user-circle icon"></i>  -->

      
        <?php foreach($data['superadminDetails'] as $deliveryDetails): ?>
        <?php
                    $profileImage = empty($superadminDetails->profile_img) ? URLROOT . '/assets/images/publisher/person.jpg' : URLROOT . '/assets/images/landing/profile/' . $superadminDetails->profile_img ;
                ?>
        <?php endforeach; ?>
        <img style="width: 40px;height: 40px;border-radius: 50%;" src="<?php echo $profileImage; ?>" onclick="toggleMenu()">


        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <div class="user-info">
            <?php foreach($data['superadminDetails'] as $superadminDetails): ?>
                <?php
                      $profileImage = empty($superadminDetails->profile_img) ? URLROOT . '/assets/images/publisher/person.jpg' : URLROOT . '/assets/images/landing/profile/' . $superadminDetails->profile_img ;
                        ?>
                <?php endforeach; ?>
                <img  src="<?php echo $profileImage; ?>" >
                <h3><?php echo $data['superadminName']; ?></h3><!--NAME COMMENT-->
            </div>
            <hr>
            
            <a href="<?php echo URLROOT; ?>/superadmin/notifications" class="sub-menu-link"> <!--path changed-->
                <i class="bx bxs-bell-ring icon"></i> <!--path changed-->
                <p>Notifications</p>
                <span>></span>
            </a>
            
            <a href="<?php echo URLROOT; ?>/publisher/logout" class="sub-menu-link"> <!--path changed-->
            <i class="bx bxs-log-out icon"></i>  <!--path changed-->
                <p>Logout</p>
                <span>></span>
            </a>
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
              <a href="<?php echo URLROOT; ?>/superadmin/index" class="nav-link">
                <i class="bx bxs-dashboard icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT; ?>/superadmin/admins" class="nav-link">
                <i class="bx bxs-user-rectangle icon"></i>
                <span class="link">Users</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT; ?>/superadmin/removeList"" class="nav-link">
              <i class='bx bxs-user-x icon'></i>
                <span class="link">Removed Users</span>
              </a>
            </li>
            
            <li class="list">
              <a href="#" class="nav-link">
                <i class="bx bxs-credit-card icon"></i>
                <span class="link">Orders</span>
              </a>
            </li>
            
          <div class="bottom-cotent">
            <li class="list">
              <a href="<?php echo URLROOT; ?>/superadmin/notifications" class="nav-link">
                <i class="bx bxs-message-alt-dots icon"></i>
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
  <script>
    let subMenu = document.getElementById("subMenu");

function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}
</script>