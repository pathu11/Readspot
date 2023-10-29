<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'admin';

  $connection = new mysqli($servername, $username, $password, $database);

  $category = '';
  $description = '';

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $category = $_POST['category'];
    $description = $_POST['description'];

     //add new category
    $sql = "INSERT INTO category(category, description) VALUES ('$category', '$description')";
    $result = mysqli_query($connection,$sql);
    
    $category = '';
    $description = '';

    header("location: categories.php");
    exit;

  }


  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Category</title>
  <link rel="stylesheet" href="adminNav.css">
  <link rel="stylesheet" href="categoryAdd.css">
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
    <span><a href="categories.php"> < Book Category </a></span>
    <span> < Add </span>
  </div>

  <div class="form">
  <form method="post" class="categoryAddForm">
    <div class="grid-container">
      <label for="category">Category</label>
      <input type="text" name="category" id="category" value="<?php echo $category; ?>">
      
      <label for="description">Description</label>
      <input type="text" name="description" id="description" value="<?php echo $description;?>">

      <button type="submit" class="button">Add</button>
    </div>
  </form>
</div>
</body>
</html>