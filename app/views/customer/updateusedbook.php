<?php
    $title = "Dashboard";
    require APPROOT . '/views/customer/header.php';
?>
    <?php
        include_once 'sidebar.php';
    ?>
    <div class="container">

        <div class="add-content">
            <form action="<?php echo URLROOT; ?>/customer/updateusedbook/<?php echo $data['bookId'];?>" class="book-add" method="post">

                <h1>Update Used Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic">Book Name</label><br>
                    <input type="text" class="form-topic"  name="bookName" value="<?php echo $data['bookName']; ?>" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Author of Book</label><br>
                    <input type="text" class="form-topic"  name="author"value="<?php echo $data['author']; ?>" required>
                </div>
                

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Book Category</label><br>
                        <select id="category"  name="category"value="<?php echo $data['category']; ?>" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>
                
                    <div class="topic-book author">
                        <label class="label-topic">Condition</label><br>
                        <select id="category"  name="bookCondition"value="<?php echo $data['bookCondition']; ?>" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Published Year</label><br>
                        <input type="number" class="form-topic"  name="publishedYear"value="<?php echo $data['publishedYear']; ?>" required min=1800 max=2100>
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Price</label><br>
                        <input type="number" class="form-topic"  name="price" value="<?php echo $data['price']; ?>"required>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic">Price Type</label><br>
                        <select id="category"  name="priceType" value="<?php echo $data['priceType']; ?>"required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>
        
                    <div class="topic-book author weight">
                        <label class="label-topic">Weight (grams)</label><br>
                        <input type="number" class="form-topic"  name="weights" value="<?php echo $data['weights']; ?>"required>
                        <a href="#"><button class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1">ISBN Number</label><br>
                    <input type="text" class="form-topic" id="input1" value="<?php echo $data['isbnNumber']; ?>"name="isbnNumber">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input2">ISSN Number</label><br>
                    <input type="text" class="form-topic" id="input2" value="<?php echo $data['issnNumber']; ?>"name="issnNumber">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3">ISMN Number</label><br>
                    <input type="text" class="form-topic" id="input3" value="<?php echo $data['issmNumber']; ?>"name="issmNumber">
                </div>
        
                <div class="disc-book">
                    <label class="label-topic">Description</label><br>
                    <textarea id="descriptions" rows="12" class="form-topic"  value="<?php echo $data['descriptions']; ?>"name="descriptions" required></textarea>
                </div>
        
                <div class="upload-pages">
                    <div class="img-cont">
                        <label class="label-topic">Upload Front Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="<?php echo $data['imgFront']; ?>"name="imgFront" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="<?php echo $data['imgBack']; ?>"name="imgBack" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="<?php echo $data['imgInside']; ?>"name="imgInside" required>
                    </div>
                </div>
                <hr>
                <div class="topic-book">
                    <label class="label-topic">Account Holder's Name</label><br>
                    <input type="text" class="form-topic"  value="<?php echo $data['accName']; ?>"name="accName" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Account Number</label><br>
                    <input type="number" class="form-topic"  value="<?php echo $data['accNumber']; ?>"name="accNumber" required>
                </div>

                <div class="upload-pages">
                    <div class="topic-book author">
                        <label class="label-topic">Bank Name</label><br>
                        <input type="text" class="form-topic"  value="<?php echo $data['bankName']; ?>"name="bankName" required>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Branch Name</label><br>
                        <input type="text" class="form-topic"  value="<?php echo $data['branchName']; ?>"name="branchName" required>
                    </div>
                </div>
                <hr>

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Town</label><br>
                        <input type="text" class="form-topic"  value="<?php echo $data['town']; ?>"name="town" required>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic">District</label><br>
                        <select id="category"  name="district" value="<?php echo $data['district']; ?>"required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Postal Code</label><br>
                        <input type="number" class="form-topic"  name="postalCode" value="<?php echo $data['postalCode']; ?>"required>
                    </div>
                </div>

                <input type="submit" value="Update" name="submitusededit">
            </form>
        </div>
        <?php
            include_once 'footer.php';
        ?>
    </div>


