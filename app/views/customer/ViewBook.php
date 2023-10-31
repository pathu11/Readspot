<?php
    $title = "Bookshelf";
    include_once 'header.php';
    // include_once 'http://localhost/Group-27/app/controllers/customer/dbh.inc.php';
?>

    <div class="main-detail">
        <?php
    
        
        $serverName = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "readspots";
        
        
        
        $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
        
        if (!$conn) {
            die("Connection failed : " .mysqli_connect_error());
        }
        if (isset($_GET['id'])){
            $bookId = $_GET['id'];
            
            $sql = "SELECT * FROM usedbooks WHERE bookId = $bookId;";
            $result = mysqli_query($conn, $sql);
            $checkResults = mysqli_num_rows($result);

            if ($checkResults > 0) {
            while ($row = mysqli_fetch_assoc($result)){
                $bookId = $row['bookId'];
                $bookName=$row['bookName'];
                $author=$row['author'];
                $category=$row['category'];
                $bookCondition=$row['bookCondition'];
                $publishedYear=$row['publishedYear'];
                $price=$row['price'];
                $priceType=$row['priceType'];
                $weight=$row['weights'];
                $isbnNumber=$row['isbnNumber'];
                $issnNumber=$row['issnNumber'];
                $issmNumber=$row['issmNumber'];
                $description=$row['descriptions'];
                $imgFront=$row['imgFront'];
                $imgBack=$row['imgBack'];
                $imgInside=$row['imgInside'];
                $town=$row['town'];
                $district=$row['district'];
                $postalCode=$row['postalCode'];



                    echo '<div class="sub1">
                    <img src="http://localhost/Group-27/public/assets/images/customer/'.$imgFront.'" alt="Book3" class="main-img">
                </div>
                <div class="sub2">
                    <h3>Book Name : <span>'.$bookName.'</span></h3><br>
                    <h3>Author of Book : <span>'.$author.'</span></h3><br>
                    <h3>Book Category : <span>'.$category.'</span></h3><br>
                    <h3>Condition : <span>'.$bookCondition.'</span></h3><br>
                    <h3>Published Year : <span>'.$publishedYear.'</span></h3><br>
                    <h3>Price : <span>'.$price.'</span></h3><br>
                    <h3>Price Type : <span>'.$priceType.'</span></h3><br>
                    <h3>Weight (grams) : <span>'.$weight.'</span></h3><br>
                    <h3>ISBN Number : <span>'.$isbnNumber.'</span></h3><br>
                    <h3>ISSN Number : <span>'.$issnNumber.'</span></h3><br>
                    <h3>ISMN Number : <span>'.$issmNumber.'</span></h3>
                </div>
                <div class="sub3">
                    <img src="http://localhost/Group-27/public/assets/images/customer/'.$imgFront.'" alt="Book3" class="sub-img">
                </div>
                <div class="sub4">
                    <img src="http://localhost/Group-27/public/assets/images/customer/'.$imgInside.'" alt="Book3" class="sub-img">
                </div>
                <div class="sub5">
                    <img src="http://localhost/Group-27/public/assets/images/customer/'.$imgBack.'" alt="Book3" class="sub-img">
                </div>
                <div class="sub6">
                    <h3>Description about the book</h3><br>
                    <p>'.$description.'</p>
        
                </div>
                <div class="sub7">
                    <h3>Town : <span>'.$town.'</span></h3><br>
                    <h3>District : <span>'.$district.'</span></h3><br>
                    <h3>Postal Code : <span>'.$postalCode.'</span></h3><br>
                </div>
                <div class="sub8">
                    <a href="http://localhost/Group-27/app/controllers/customer/deleteusedbook.inc.php?deleteid='.$bookId.'"><button class="chat-dlt-btn">Delete</button></a>
                    <a href="./updateusedbook.php?updateid='.$bookId.'"><button class="chat-btn">Edit</button></a>
                </div>';
                }
            }

        }
        ?>

        <!-- <div class="sub1">
            <img src="./assets/img/book.jpg" alt="Book3" class="main-img">
        </div>
        <div class="sub2">
            <h3>Book Name : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Author of Book : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Book Category : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Condition : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Published Date : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Price : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Price Type : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Weight (grams) : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>ISBN Number : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>ISSN Number : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>ISMN Number : <span>Lorem ipsum dolor sit amet.</span></h3>
        </div>
        <div class="sub3">
            <img src="./assets/img/book.jpg" alt="Book3" class="sub-img">
        </div>
        <div class="sub4">
            <img src="./assets/img/book.jpg" alt="Book3" class="sub-img">
        </div>
        <div class="sub5">
            <img src="./assets/img/book.jpg" alt="Book3" class="sub-img">
        </div>
        <div class="sub6">
            <h3>Description about the book</h3><br>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing 
                elit. Pariatur, culpa quam? Accusantium accusamus 
                deleniti ea dolor. At excepturi, pariatur quis 
                error aspernatur, eius delectus eveniet ut 
                expedita architecto ratione culpa. Illo a unde 
                nihil rerum culpa veniam veritatis nesciunt, fuga 
                dolorem. Debitis expedita, eaque fugiat harum 
                animi possimus explicabo natus nihil eum esse 
                rerum? Laborum doloribus eaque, autem earum 
                laudantium dignissimos nam itaque rerum quasi enim 
                sit nisi eligendi tempore. Vitae rem atque 
                distinctio, odit hic, cupiditate harum corporis 
                voluptatum repudiandae quaerat blanditiis quos 
                amet aut labore dicta qui cumque ab culpa omnis 
                earum optio nam? Consectetur commodi natus iste 
                eos, dicta illum? Suscipit eveniet ipsum tenetur? 
                Consectetur magnam sit dolorum aut voluptatum quia 
                maiores accusantium, consequatur soluta 
                dignissimos temporibus nam iusto cumque cum. 
                Repellendus repudiandae doloribus reiciendis iure 
                nihil sequi alias voluptates nesciunt at laborum 
                vero minus accusantium corporis ipsam debitis 
                impedit sit, ipsum delectus. Esse, est veniam sunt 
                rem commodi animi ullam laborum ab cumque placeat, 
                consectetur ipsam omnis! Similique animi aperiam 
                eum hic iusto harum in dolorum libero optio, nihil 
                culpa aspernatur labore repellat, pariatur ea. 
                Inventore minus aut, quos quod fuga ipsam 
                praesentium quasi vitae ab eius amet maxime 
                similique ex iste sit dolorum explicabo labore, 
                accusamus magni porro. Minus nulla veritatis totam 
                expedita corrupti a perspiciatis! Minus, ea 
                tempora dolor enim saepe tempore laboriosam 
                facilis atque repellat nisi sunt doloribus 
                deleniti suscipit iure dolore numquam inventore 
                debitis, cumque quod commodi quis et eligendi 
                reprehenderit pariatur? Impedit deserunt mollitia 
                nisi totam odio similique id hic vitae.
            </p>

        </div>
        <div class="sub7">
            <h3>Town : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>District : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>Postal Code : <span>Lorem ipsum dolor sit amet.</span></h3><br>
        </div> -->
    </div>

<?php
    include_once 'footer.php';
?>
