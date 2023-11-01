
<!DOCTYPE html>
<html>
<title>Admin landing page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/moderator/communityadminNav.css">
<link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/moderator/style1.css">
<link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/moderator/footer.css">
<body>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userIcon = document.querySelector(".user");
      const subMenu = document.getElementById("subMenu");
  
      userIcon.addEventListener("click", function() {
        subMenu.classList.toggle("open-menu");
      });
    });
  </script>
  <?php require 'communityadminNav.php'?>

  <div class="grid-container">
    <div class="grid-item"><a href="event.php">Events</a></div>
    <div class="grid-item"><a href="#publishers">Creative Contents</a></div>
    <div class="grid-item"><a href="#orders">Book Challenges</a></div>
    
  </div>


</body>
</html>