<?php 

include 'connect.php';
session_start();
//insert books
if(isset($_POST['submit'])){
    $book_name = $_POST['book_name '];
    $ISBN_no=$_POST['ISBN_no'];
    $author=$_POST['author'];
    $price=$_POST['price'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $descript = $_POST['descript'];
    $quantity = $_POST['quantity'];
    $street_name = $_POST['street_name'];
    $district = $_POST['district'];
    $town = $_POST['town'];
    $postal_code = $_POST['postal_code'];
    $account_no = $_POST['account_no'];
    $bank_name = $_POST['bank_name'];
    $account_name = $_POST['account_name'];
    $branch_name = $_POST['branch_name'];
    $img = $_POST['img'];
    // Prepare the SQL query
    $insert_query = $conn->prepare("INSERT INTO `addbook_publisher` (book_name, ISBN_no, author, price, category, weight, descript, quantity, street_name, district, town, postal_code, account_no, bank_name, account_name, branch_name, img) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Execute the query
    $insert_query->execute([$book_name, $ISBN_no, $author, $price, $category, $weight, $descript, $quantity, $street_name, $district, $town, $postal_code, $account_no, $bank_name, $account_name, $branch_name, $img]);

    if($insert_query) {
        echo "Added successful!";
        header('location:productGallery.php');
       
    } else {
        echo "Failed.";
    }
}
// delete books
if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    $sql = "DELETE FROM `addbook_publisher` WHERE id=$id";
    $conn->query($sql);
    header('location: productGallery.php');
}


?>