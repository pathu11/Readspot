<!--link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/-->
<nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <img src="<?php echo URLROOT?>/assets/images/admin/ReadSpot.png" class="readSpot-logo">
        <span class="logo-name">ReadSpot</span>
        
        <span class="user"><?php echo $data['moderatorName']?></span>
        <i class="bx bxs-user-circle icon" onclick="toggleMenu()"></i>
      </div>
      
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
              <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png"> <!--path changed-->
              <h3><?php echo $data['moderatorName']; ?></h3><!--NAME COMMENT-->
          </div>
          <hr>
          
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
      
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">ReadSpot</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="<?php echo URLROOT;?>/moderator/index" class="nav-link">
                <i class="bx bxs-dashboard icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT;?>/moderator/contents" class="nav-link">
                <i class="bx bxs-book-content icon"></i>
                <span class="link">Contents</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT;?>/moderator/challenges" class="nav-link">
                <i class="bx bxs-trophy icon"></i>
                <span class="link">Challenges</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT?>/moderator/events" class="nav-link">
                <i class="bx bxs-calendar-event icon"></i>
                <span class="link">Events</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT?>/moderator/BookReviews" class="nav-link">
                <i class='bx bxs-comment-error icon'></i>
                <span class="link">Book Reviews</span>
              </a>
            </li>
            <li class="list">
              <a href="<?php echo URLROOT?>/moderator/complains" class="nav-link">
                <i class="bx bxs-message-rounded-error icon"></i>
                <span class="link">Complains</span>
              </a>
            </li>
            <br><br>
          <div class="bottom-cotent">
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