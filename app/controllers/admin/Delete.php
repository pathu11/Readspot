<?php
   $host = "localhost";
   $user = "root";
   $password = "";
   $db = "readspots";

  $connection = new mysqli($host, $user, $password, $db);
  if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM category WHERE id = $id"; 
    $result = mysqli_query($connection,$sql);
    
  }
  header("location: http://localhost/Group-27/app/views/admin/categories.view.php");
  exit;
?>


