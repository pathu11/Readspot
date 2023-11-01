<?php
session_start();

// Access the admin's name from the session
$moderatorName = $_SESSION["moderator_name"] ?? '';
$moderatoremail = $_SESSION["moderator_email"] ?? '';




?>
<head>
  <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/moderator/communityadminNav.css">
</head>

<nav>
    <img src="http://localhost/Group-27/public/assets/images/moderator/ReadSpot.png" class="logo">
    <ul>
      <li><a href="index.php">Dashboard</a></li>
      <li><a href="event.php">Book Events</a></li>
      <li><a href="#books">Book Challenges</a></li>
      <li><a href="#orders">Creative Contents</a></li>
      <li><a href="#settings">Settings</a></li>
    </ul>
    <div class="user-detail">
      <img src="http://localhost/Group-27/public/assets/images/moderator/user.png" class="user">
      <p class="nav-p">Hi, <?php echo $moderatorName; ?></p>
    </div>

    <div class="sub-menu-wrap" id="subMenu">
      <div class="sub-menu">
        <div class="user-info">
          <img src="http://localhost/Group-27/public/assets/images/moderator/user.png">
          <h2>Hi, <?php echo $moderatorName; ?></h2>
        </div>
        <hr>

        <a href="#profile-info" class="sub-menu-link">
          <img src="http://localhost/Group-27/public/assets/images/moderator/user1.png">
          <p class="sub-menu-p">profile info</p>
        </a>

        <a href="#notifications" class="sub-menu-link">
          <img src="http://localhost/Group-27/public/assets/images/moderator/notification.png">
          <p>notifications</p>
        </a>

        <a href="#settings" class="sub-menu-link">
          <img src="http://localhost/Group-27/public/assets/images/moderator/settings.png">
          <p>Settings</p>
        </a>

        <a  href="http://localhost/Group-27/app/controllers/Logout.php" class="sub-menu-link">
          <img src="http://localhost/Group-27/public/assets/images/moderator/logout.png">
          <p>Logout</p>
        </a>
      </div>
    </div>
  </nav>