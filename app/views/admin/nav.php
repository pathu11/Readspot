<!--link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/-->
<nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <img src="<?php echo URLROOT?>/assets/images/admin/ReadSpot.png" class="readSpot-logo">
        <span class="logo-name">ReadSpot</span>
        
        <span class="user"><?php echo $data['adminName']?></span>
        <i class="bx bxs-user-circle icon" onclick="toggleMenu()"></i>
        
        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <div class="user-info">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png"> <!--path changed-->
                <h3><?php echo $data['adminName']; ?></h3><!--NAME COMMENT-->
            </div>
            <hr>
            
            <a href="<?php echo URLROOT; ?>/customer/Notification" class="sub-menu-link"> <!--path changed-->
                <i class="bx bxs-bell-ring icon"></i> <!--path changed-->
                <p>Notifications</p>
                <span>></span>
            </a>
            
            <a href="<?php echo URLROOT; ?>/landing/logout" class="sub-menu-link"> <!--path changed-->
            <i class="bx bxs-log-out icon"></i>  <!--path changed-->
                <p>Logout</p>
                <span>></span>
            </a>
          </div>
        </div>

<script>
    let subMenu = document.getElementById("subMenu");

function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}
</script>
      
      
      </div>
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">ReadSpot</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="<?php echo URLROOT;?>/admin/index" class="nav-link">
                <i class="bx bxs-dashboard icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT;?>/admin/customers" class="nav-link">
                <i class="bx bxs-user icon"></i>
                <span class="link">Users</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT;?>/admin/orders" class="nav-link">
                <i class="bx bxs-note icon"></i>
                <span class="link">Orders</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT?>/admin/pendingRequestsCharity " class="nav-link">
                <i class="bx bxs-message-dots icon"></i>
                <span class="link">Pending requests</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT?>/admin/complains" class="nav-link">
                <i class="bx bxs-message-rounded-error icon"></i>
                <span class="link">Complains</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT?>/admin/pending_payments "" class="nav-link">
                <i class="bx bxs-dollar-circle icon"></i>
                <span class="link">Pending Payments</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT?>/admin/payments "" class="nav-link">
                <i class="bx bxs-dollar-circle icon"></i>
                <span class="link">Payments</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT;?>/admin/categories" class="nav-link">
                <i class="bx bxs-category-alt icon"></i>
                <span class="link">Categories</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT;?>/admin/reports" class="nav-link">
                <i class="bx bxs-report icon"></i>
                <span class="link">Reports</span>
              </a>
            </li>
            <br>
          <div class="bottom-cotent">
            <li class="list">
              <a href="#" class="nav-link">
                <i class="bx bxs-cog icon"></i>
                <span class="link">Settings</span>
              </a>
            </li>
          </div>
        </div>
      </div>
    </nav>

    <section class="overlay"></section>

    <script src="<?php echo URLROOT;?>/assets/js/admin/nav.js"></script>

  </body>