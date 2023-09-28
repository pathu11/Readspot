<?php 

include 'connect.php';
session_start();

if(isset($_POST['signup'])){
    $full_name = $_POST['full_name'];
    $company_name=$_POST['company_name'];
    $reg_no=$_POST['reg_no'];
    $contact_no=$_POST['contact_no'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Hash the password for security
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare the SQL query
    $insert_query = $conn->prepare("INSERT INTO `register` (full_name,company_name,reg_no,contact_no,email, pass) VALUES ( ?, ?, ?, ?, ?, ?)");

    // Execute the query
    $insert_query->execute([$full_name,$company_name,$reg_no,$contact_no,$email, $pass]);

    if($insert_query) {
        echo "Registration successful!";
        header('location:homepage.php');
      
    } else {
        echo "Registration failed.";
    }
}



if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $email=filter_var($email,FILTER_SANITIZE_STRING);
    $pass=$_POST['pass'];
    $pass=filter_var($pass,FILTER_SANITIZE_STRING);

    $select_admin=$conn->prepare("SELECT *FROM `register` WHERE email=? AND pass =?");
    $select_admin->execute([$email,$pass]);
    

    if($select_admin->rowcount() >0){
        $fetch_admin_id=$select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['id'];
        header('location:homepage.php');

    }else{
        $message[]='incorrect user name or password';
    }
}
?>

