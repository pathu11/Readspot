<?php 
    include_once 'dbh.inc.php';

    $Id = $_GET['updateid'];    

    if(isset($_POST['submitusededit'])){
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
    
        // $sql = "UPDATE usedbooks SET bookId=$bookId,bookName=$bookName,author=$author,category=$category,bookCondition=$bookCondition,publishedYear=$publishedYear,price=$price,priceType=$priceType,weights=$weight,isbnNumber=$isbnNumber,issnNumber=$issnNumber,issmNumber=$issmNumber,descriptions=$description,imgFront=$imgFront,imgBack=$imgBack,imgInside=$imgInside,accName=$accName,accNumber=$accNumber,bankName=$bankName,branchName=$branchName,town=$town,district=$district,postalCode=$postalCode WHERE bookId=$bookId;";
           $sql = "UPDATE usedbooks SET bookId=$Id,bookName='$bookName',author='$author',category='$category',bookCondition='$bookCondition',publishedYear=$publishedYear,price=$price,priceType='$priceType',weights=$weight,isbnNumber='$isbnNumber',issnNumber='$issnNumber',issmNumber='$issmNumber',descriptions='$description',imgFront='$imgFront',imgBack='$imgBack',imgInside='$imgInside',accName='$accName',accNumber=$accNumber,bankName='$bankName',branchName='$branchName',town='$town',district='$district',postalCode=$postalCode WHERE bookId=$Id;";

        $result = mysqli_query($conn,$sql);
    
        if($result){
            header("Location:http://localhost/Group-27/app/views/customer/UsedBooks.php?updateerror=none");
        }else{
            die("Connection failed : " .mysqli_connect_error());
        }    
    }
    else {
        header('Location:http://localhost/Group-27/app/views/customer/UsedBooks.php?error=none102354');
    }
?>