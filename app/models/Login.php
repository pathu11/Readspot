<?php

$host="localhost";
$user="root";
$password="";
$db="readspots";

session_start();


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST["email"];
	$password=$_POST["pass"];


	$sql="select * from users where email='".$email."' AND pass='".$password."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row["user_role"]=="customer")
	{	

		$_SESSION["email"]=$email;

		header("location:http://localhost/Group-27/app/views/home.view.php");
	}

	elseif($row["user_role"]=="publisher")
	{

		$_SESSION["email"]=$email;


        $publisherQuery = "SELECT * FROM Publishers WHERE user_id = " . $row['user_id'];
        $publisherResult = mysqli_query($data, $publisherQuery);
        $publisher = mysqli_fetch_assoc($publisherResult);

        if ($publisher) {
            foreach ($publisher as $key => $value) {
                $_SESSION["publisher_" . $key] = $value;
            }

        }
		
		header("location:http://localhost/Group-27/app/views/publisher/home.view.php");
	}

	else
	{
		echo "username or password incorrect";
	}

}




?>