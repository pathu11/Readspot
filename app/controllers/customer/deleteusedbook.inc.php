<?php

include_once 'dbh.inc.php';

if (isset($_GET['deleteid'])){
    $bookId = $_GET['deleteid'];

    $sql="DELETE FROM usedbooks WHERE bookId=$bookId;";

    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location:http://localhost/Group-27/app/views/customer/UsedBooks.php?error=none");
    }else{
        die("Connection failed : " .mysqli_connect_error());
    }    
}