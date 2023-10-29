<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "admin";

  $connection = new mysqli($servername, $username, $password, $database);
  if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM category WHERE id = $id"; 
    $result = mysqli_query($connection,$sql);
    
  }
  header("location: categories.php");
  exit;
?>


