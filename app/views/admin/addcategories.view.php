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
  
  <?php require 'nav.view.php'?>

  <div class="navigation">
    <a href="index.view.php">Admin</a>
    <span><a href="categories.view.php"> < Book Category </a></span>
    <span> < Add </span>
  </div>

  <div class="form">
  <form method="post" class="categoryAddForm" action="http://localhost/Group-27/app/controllers/admin/Addcategories.php">
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