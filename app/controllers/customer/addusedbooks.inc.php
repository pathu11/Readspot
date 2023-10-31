<?php

session_start();
include_once 'dbh.inc.php';

if(isset($_POST['submitused'])){
    $bookName=$_POST['bookName'];
    $author=$_POST['author'];
    $category=$_POST['category'];
    $bookCondition=$_POST['bookCondition'];
    $publishedYear=$_POST['publishedYear'];
    $price=$_POST['price'];
    $priceType=$_POST['priceType'];
    $weight=$_POST['weight'];
    $isbnNumber=$_POST['isbnNumber'];
    $issnNumber=$_POST['issnNumber'];
    $issmNumber=$_POST['issmNumber'];
    $description=$_POST['description'];
    $imgFront=$_POST['imgFront'];
    $imgBack=$_POST['imgBack'];
    $imgInside=$_POST['imgInside'];
    $accName=$_POST['accName'];
    $accNumber=$_POST['accNumber'];
    $bankName=$_POST['bankName'];
    $branchName=$_POST['branchName'];
    $town=$_POST['town'];
    $district=$_POST['district'];
    $postalCode=$_POST['postalCode'];
    $customerId = $_SESSION['customer_id'];

    $sql = "INSERT INTO usedbooks (bookName,author,category,bookCondition,publishedYear,price,priceType,weights,isbnNumber,issnNumber,issmNumber,descriptions,imgFront,imgBack,imgInside,accName,accNumber,bankName,branchName,town,district,postalCode,customer_id) VALUES ('$bookName','$author','$category','$bookCondition',$publishedYear,$price,'$priceType',$weight,'$isbnNumber','$issnNumber','$issmNumber','$description','$imgFront','$imgBack','$imgInside','$accName',$accNumber,'$bankName','$branchName','$town','$district',$postalCode,$customerId);";

    $result = mysqli_query($conn,$sql);

    if($result){
        header("Location:http://localhost/Group-27/app/views/customer/UsedBooks.php?error=none");
    }else{
        die("Connection failed : " .mysqli_connect_error());
    }    
}
else {
    header('Location:http://localhost/Group-27/app/views/customer/AddUsedBook.php?error=none102354');
}



// include_once 'dbh.inc.php';

// if(isset($_POST['submitused'])){
//     $bookName=$_POST['bookName'];
//     $author=$_POST['author'];

//     $sql = "INSERT INTO addbook (BookName,AuthorName) VALUES ('$bName','$aur');";
    
//     $result = mysqli_query($conn,$sql);

//     header("Location:../AddUsedBook.php?error=none");
// }