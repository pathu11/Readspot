<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "readspots";

  $connection = new mysqli($servername, $username, $password, $database);

  $id = $_GET['updateid'];
  $sql = "SELECT * FROM category WHERE id=$id";
  $result = mysqli_query($connection,$sql);
  $row = $result->fetch_assoc();

  if(!$row){
    header("location: http://localhost/Group-27/app/views/admin/categories.view.php");
    exit;
  }

  $category = $row['category'];
  $description = $row['description'];
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $category = $_POST['category'];
    $description = $_POST['description'];

     //add new category
    $sql = "UPDATE category SET category = '$category', description = '$description' WHERE id = $id";

    $result = mysqli_query($connection,$sql);
   

    header("location: http://localhost/Group-27/app/views/admin/categories.view.php");
    exit;

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Category</title>
  <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/adminNav.css">
  <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/admin/categoryAdd.css">
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

  <div class="navigation">
    <a href="index.view.php">Admin</a>
    <span><a href="categories.view.php"> < Book Category </a></span>
    <span> < Update </span>
  </div>

  <div class="form">
  <form method="post" class="categoryAddForm">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="grid-container">
      <label for="category">Category</label>
      <input type="text" name="category" id="category" value="<?php echo $category; ?>">
      
      <label for="description">Description</label>
      <input type="text" name="description" id="description" value="<?php echo $description;?>">

      <button type="submit" class="button">Update</button>
    </div>
  </form>
</div>
</body>
</html>