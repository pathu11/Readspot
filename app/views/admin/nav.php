<!--link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/-->
<nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <img src="<?php echo URLROOT?>/assets/images/admin/ReadSpot.png" class="readSpot-logo">
        <span class="logo-name">ReadSpot</span>
        
        <span class="user"><?php echo $data['adminName']?></span>
        <i class="bx bxs-user-circle icon"></i>
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
              <a href="#" class="nav-link">
                <i class="bx bxs-message-rounded-error icon"></i>
                <span class="link">Complains</span>
              </a>
            </li>
            <li class="list">
              <a href="#" class="nav-link">
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
            <br><br>
          <div class="bottom-cotent">
            <li class="list">
              <a href="#" class="nav-link">
                <i class="bx bxs-cog icon"></i>
                <span class="link">Settings</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT;?>/landing/logout" class="nav-link">
                <i class="bx bxs-log-out icon"></i>
                <span class="link">Logout</span>
              </a>
            </li>
          </div>
        </div>
      </div>
    </nav>

    <section class="overlay"></section>

    <script src="<?php echo URLROOT;?>/assets/js/admin/nav.js"></script>
  </body>