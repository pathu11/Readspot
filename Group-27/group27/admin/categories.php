<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>categories</title>
  <link rel="stylesheet" href="adminNav.css">
  <link rel="stylesheet" href="category.css">

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
  
  <?php require 'adminNav.php'?>
  <div class="navigation">
    <a href="index.php">Admin</a>
    <span> < Book Category </span>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th width="100px">No</th>
        <th>Category</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $servername = 'localhost';
      $username = 'root';
      $password = '';
      $database = 'admin';

      $connection = new mysqli($servername, $username, $password, $database);

      if($connection->connect_error){
        die("connection failed" .$connection->connect_error);
      }

      $sql = "SELECT * FROM category";
      $result = mysqli_query($connection,$sql);

      if(!$result){
        die("Invalid query: " .$connection->error);
      }

      //read data of each row
      while($row = $result->fetch_assoc()){
        echo"
        <tr>
        <td>$row[id]</td>
        <td>$row[category]</td>
        <td>$row[description]</td>
        <td>
          <a href='categoryUpdate.php? updateid=$row[id]'><button>Update</button></a>
          <a href='categoryDelete.php? deleteid=$row[id]'><button>Delete</button></a>
        </td>
      </tr>
      ";
      }
      ?>
    </tbody>
  </table>
  <div class="addButton">
    <a href="categoryAdd.php"><button>Add</button></a>
  </div>

  
</body>
</html>