<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events</title>
  <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/moderator/communityadminNav.css">
  <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/moderator/event.css">

</head>
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
  <div class="navigation">
    <a href="index.php">Community moderator</a>
    <span> < Event List </span>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th width="100px">Event ID</th>
        <th>Organizer name</th>
        <th>Event Date</th>
        <th>Status</th>
        <th>Category</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>01</td>
        <td>Ichae Semos</td>
        <td>2023/12/01</td>
        <td>Ongoing</td>
        <td>Book Launch</td>
      </tr>
      <tr>
        <td>01</td>
        <td>Ichae Semos</td>
        <td>2023/12/01</td>
        <td>Ongoing</td>
        <td>Book Launch</td>
      </tr>
      <tr>
        <td>01</td>
        <td>Ichae Semos</td>
        <td>2023/12/01</td>
        <td>Ongoing</td>
        <td>Book Launch</td>
      </tr>
    </tbody>
  </table>
  

  
</body>
</html>