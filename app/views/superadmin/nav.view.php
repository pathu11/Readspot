<?php
session_start();

// Access the admin's name from the session
$superadminName = $_SESSION["super_admin_name"] ?? '';
$superadminemail = $_SESSION["super_admin_email"] ?? '';




?>
<!-- <head>
   <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/adminNav.css">
   <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/adminNav.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/style.css">
     <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/footer.css">
</head> -->


<nav>
    <img src="http://localhost/Group-27/public/assets/images/admin/ReadSpot.png" class="logo">
    <ul>
      <li><a href="#dashboard">Dashboard</a></li>
      <li><a href="customers.view.php">Users</a></li>
      <li><a href="#books">Books</a></li>
      <li><a href="#orders">Orders</a></li>
      <li><a href="#Reports">Reports</a></li>
      <li><a href="#settings">Settings</a></li>
    </ul>
    <div class="user-detail">
      <img src="http://localhost/Group-27/public/assets/images/admin/user.png" class="user">
      <p class="nav-p">Hi, <?php echo $superadminName; ?></p>
    </div>

    <div class="sub-menu-wrap" id="subMenu">
      <div class="sub-menu">
        <div class="user-info">
          <img src="http://localhost/Group-27/public/assets/css/admin/user.png">
          <h2><?php echo $superadminName; ?></h2>
        </div>
        <hr>

        <a href="#profile-info" class="sub-menu-link">
          <img src="http://localhost/Group-27/public/assets/images/admin/user1.png">
          <p class="sub-menu-p">profile info</p>
        </a>

        <a href="http://localhost/Group-27/app/views/superadmin/notification.view.php" class="sub-menu-link">
          <img src="http://localhost/Group-27/public/assets/images/admin/notification.png">
          <p>notifications</p>
        </a>

        <a href="#settings" class="sub-menu-link">
          <img src="http://localhost/Group-27/public/assets/images/admin/settings.png">
          <p>Settings</p>
        </a>

        <a href="http://localhost/Group-27/app/controllers/Logout.php"  style="text-decoration:none;" class="sub-menu-link">
         <img src="http://localhost/Group-27/public/assets/images/admin/logout.png">
          Logout</a>
        </a>
      </div>
    </div>
  </nav>