<?php
    $title = "Dashboard";
    include_once 'header.php';
    include_once './includes/dbh.inc.php';
?>
    <div class="container">
        <?php
            include_once 'sidebar.php';
        ?>
        
        <?php 
        $bookId = $_GET['updateid'];    
        $sql="SELECT * FROM usedbooks WHERE bookId=$bookId;";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
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
        $accName=$row['accName'];
        $accNumber=$row['accNumber'];
        $bankName=$row['bankName'];
        $branchName=$row['branchName'];
        echo'
        <div class="add-content">
            <form action="./includes/updateusedbook.inc.php?updateid='.$bookId.'" class="book-add" method="post">

                <h1>Add a Used Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic">Book Name</label><br>
                    <input type="text" class="form-topic"  name="bookName" value="'.$bookName.'" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Author of Book</label><br>
                    <input type="text" class="form-topic"  name="author"value="'.$author.'" required>
                </div>
                

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Book Category</label><br>
                        <select id="category"  name="category"value="'.$category.'" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>
                
                    <div class="topic-book author">
                        <label class="label-topic">Condition</label><br>
                        <select id="category"  name="bookCondition"value="'.$bookCondition.'" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Published Year</label><br>
                        <input type="number" class="form-topic"  name="publishedYear"value="'.$publishedYear.'" required min=1800 max=2100>
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Price</label><br>
                        <input type="number" class="form-topic"  name="price" value="'.$price.'"required>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic">Price Type</label><br>
                        <select id="category"  name="priceType" value="'.$priceType.'"required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>
        
                    <div class="topic-book author weight">
                        <label class="label-topic">Weight (grams)</label><br>
                        <input type="number" class="form-topic"  name="weight" value="'.$weight.'"required>
                        <a href="#"><button class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1">ISBN Number</label><br>
                    <input type="text" class="form-topic" id="input1" value="'.$isbnNumber.'"name="isbnNumber">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input2">ISSN Number</label><br>
                    <input type="text" class="form-topic" id="input2" value="'.$issnNumber.'"name="issnNumber">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3">ISMN Number</label><br>
                    <input type="text" class="form-topic" id="input3" value="'.$issmNumber.'"name="issmNumber">
                </div>
        
                <div class="disc-book">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" rows="12" class="form-topic"  value="'.$description.'"name="description" required></textarea>
                </div>
        
                <div class="upload-pages">
                    <div class="img-cont">
                        <label class="label-topic">Upload Front Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="'.$imgFront.'"name="imgFront" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="'.$imgBack.'"name="imgBack" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="'.$imgInside.'"name="imgInside" required>
                    </div>
                </div>
                <hr>
                <div class="topic-book">
                    <label class="label-topic">Account Holder\'s Name</label><br>
                    <input type="text" class="form-topic"  value="'.$accName.'"name="accName" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Account Number</label><br>
                    <input type="number" class="form-topic"  value="'.$accNumber.'"name="accNumber" required>
                </div>

                <div class="upload-pages">
                    <div class="topic-book author">
                        <label class="label-topic">Bank Name</label><br>
                        <input type="text" class="form-topic"  value="'.$bankName.'"name="bankName" required>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Branch Name</label><br>
                        <input type="text" class="form-topic"  value="'.$branchName.'"name="branchName" required>
                    </div>
                </div>
                <hr>

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Town</label><br>
                        <input type="text" class="form-topic"  value="'.$town.'"name="town" required>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic">District</label><br>
                        <select id="category"  name="district" value="'.$district.'"required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Postal Code</label><br>
                        <input type="number" class="form-topic"  name="postalCode" value="'.$postalCode.'"required>
                    </div>
                </div>

                <input type="submit" value="Update" name="submitusededit">
            </form>
        </div>'
        ?>
    </div>

<?php
    include_once 'footer.php';
?>
