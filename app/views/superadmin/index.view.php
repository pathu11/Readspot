<!DOCTYPE html>
<html>
<title>Admin landing page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/adminNav.css">
<link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/style.css">
<link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/footer.css">
<body>
<style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background: url(http://localhost/Group-27/public/assets/images/admin/images/bg.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            padding: 10px;
            margin-top: 200px;
            gap: 100px 200px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            font-size: 30px;
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .grid-item a {
            text-decoration: none;
            color: black;
            display: block; /* Make the link fill the grid item */
            height: 100%; 
            text-align: center;
        }

        .grid-item:hover {
            background-color: #01322F;
            /* color:white; */
            transform: scale(1.1);
        }
        .grid-item a:hover {
            background-color: #01322F;
            color:white;
            transform: scale(1.1);
        }
        
    </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userIcon = document.querySelector(".user");
      const subMenu = document.getElementById("subMenu");
  
      userIcon.addEventListener("click", function() {
        subMenu.classList.toggle("open-menu");
      });
    });
  </script>
  <?php require 'nav.view.php'?>
  <?php require 'subNav.view.php'?>
  


  <div class="grid-container">
    <div class="grid-item"><a href="#customers">Customers <br>18</a></div>
    <div class="grid-item"><a href="#publishers">Publishers<br>12</a></div>
    <div class="grid-item"><a href="#orders">Orders<br>5</a></div>
    <div class="grid-item"><a href="#payments">Payments<br>12</a></div>
    <div class="grid-item"><a href="#complains">Complains<br>5</a></div>
    <div class="grid-item"><a href="#charity organizations">Charity Organizations<br>8</a></div>
    <div class="grid-item"><a href="#pending requests">Pending Requests<br>6</a></div>
    <div class="grid-item"><a href="addadmin.view.php">Admins<br>6</a></div>
    <div class="grid-item"><a href="#delivary status">Cmmuniti Moderators<br>1</a></div>
  </div>


</body>
</html>