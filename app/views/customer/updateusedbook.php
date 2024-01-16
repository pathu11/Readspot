<?php
    $title = "Dashboard";
    require APPROOT . '/views/customer/header.php';
?>
    <?php
        include_once 'sidebar.php';
    ?>
    <div class="container">

        <div class="add-content">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <form action="<?php echo URLROOT; ?>/customer/updateusedbook/<?php echo $data['book_id'];?>" class="book-add" method="post">

                <h1>Update Used Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic">Book Name</label><br>
                    <input type="text" class="form-topic"  name="bookName" value="<?php echo $data['book_name']; ?>" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Author of Book</label><br>
                    <input type="text" class="form-topic"  name="author"value="<?php echo $data['author']; ?>" required>
                </div>
                

                <div class="upload-pages book-cate">
                <div class="topic-book author">
                        <label class="label-topic">Book Category</label><br>
                        <select id="category" name="category" required>
                            <option value="technology" <?php echo ($data['category'] == 'technology') ? 'selected' : ''; ?>>Technology</option>
                            <option value="travel" <?php echo ($data['category'] == 'travel') ? 'selected' : ''; ?>>Travel</option>
                            <option value="food" <?php echo ($data['category'] == 'food') ? 'selected' : ''; ?>>Food</option>
                            <option value="lifestyle" <?php echo ($data['category'] == 'lifestyle') ? 'selected' : ''; ?>>Lifestyle</option>
                            <option value="health" <?php echo ($data['category'] == 'health') ? 'selected' : ''; ?>>Health</option>
                        </select>
                    </div>
                
                    <div class="topic-book author">
                        <label class="label-topic">Condition</label><br>
                        <select id="category" name="bookCondition" required>
                            <option value="technology" <?php echo ($data['condition'] == 'technology') ? 'selected' : ''; ?>>Technology</option>
                            <option value="travel" <?php echo ($data['condition'] == 'travel') ? 'selected' : ''; ?>>Travel</option>
                            <option value="food" <?php echo ($data['condition'] == 'food') ? 'selected' : ''; ?>>Food</option>
                            <option value="lifestyle" <?php echo ($data['condition'] == 'lifestyle') ? 'selected' : ''; ?>>Lifestyle</option>
                            <option value="health" <?php echo ($data['condition'] == 'health') ? 'selected' : ''; ?>>Health</option>
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Published Year</label><br>
                        <input type="number" class="form-topic"  name="publishedYear"value="<?php echo $data['published_year']; ?>" required min=1800 max=2100>
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Price</label><br>
                        <input type="number" class="form-topic"  name="price" value="<?php echo $data['price']; ?>"required>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic">Price Type</label><br>
                        <select id="category"  name="priceType" required>
                            <option value="technology" <?php echo ($data['price_type'] == 'technology') ? 'selected' : ''; ?>>Technology</option>
                            <option value="travel" <?php echo ($data['price_type'] == 'travel') ? 'selected' : ''; ?>>Travel</option>
                            <option value="food" <?php echo ($data['price_type'] == 'food') ? 'selected' : ''; ?>>Food</option>
                            <option value="lifestyle" <?php echo ($data['price_type'] == 'lifestyle') ? 'selected' : ''; ?>>Lifestyle</option>
                            <option value="health" <?php echo ($data['price_type'] == 'health') ? 'selected' : ''; ?>>Health</option>
                        </select>
                    </div>
        
                    <div class="topic-book author weight">
                        <label class="label-topic">Weight (grams)</label><br>
                        <input type="number" class="form-topic"  name="weights" value="<?php echo $data['weight']; ?>"required>
                        <a href="#"><button class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1">ISBN Number</label><br>
                    <input type="text" class="form-topic" id="input1" value="<?php echo $data['ISBN_no']; ?>"name="isbnNumber" required>
                </div>
        
                <!-- <div class="topic-book author">
                    <label class="label-topic" for="input2">ISSN Number</label><br>
                    <input type="text" class="form-topic" id="input2" value=""name="issnNumber">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3">ISMN Number</label><br>
                    <input type="text" class="form-topic" id="input3" value=""name="issmNumber">
                </div> -->
        
                <div class="disc-book">
                    <label class="label-topic">Description</label><br>
                    <textarea id="descriptions" rows="12" class="form-topic" name="descriptions" required><?php echo $data['descript']; ?></textarea>
                </div>

        
                <div class="upload-pages">
                    <div class="img-cont">
                        <label class="label-topic">Upload Front Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="<?php echo $data['img1']; ?>"name="imgFront" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="<?php echo $data['img2']; ?>"name="imgBack" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" accept="image/*"  value="<?php echo $data['img3']; ?>"name="imgInside" required>
                    </div>
                </div>
                <hr>
                <div class="topic-book">
                    <label class="label-topic">Account Holder's Name</label><br>
                    <input type="text" class="form-topic"  value="<?php echo $data['account_name']; ?>"name="accName" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Account Number</label><br>
                    <input type="number" class="form-topic"  value="<?php echo $data['account_no']; ?>"name="accNumber" required>
                </div>

                <div class="upload-pages">
                    <div class="topic-book author">
                        <label class="label-topic">Bank Name</label><br>
                        <input type="text" class="form-topic"  value="<?php echo $data['bank_name']; ?>"name="bankName" required>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Branch Name</label><br>
                        <input type="text" class="form-topic"  value="<?php echo $data['branch_name']; ?>"name="branchName" required>
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
                        <select id="category" name="district" required>
                            <option value="technology" <?php echo ($data['district'] == 'technology') ? 'selected' : ''; ?>>Technology</option>
                            <option value="travel" <?php echo ($data['district'] == 'travel') ? 'selected' : ''; ?>>Travel</option>
                            <option value="food" <?php echo ($data['district'] == 'food') ? 'selected' : ''; ?>>Food</option>
                            <option value="lifestyle" <?php echo ($data['district'] == 'lifestyle') ? 'selected' : ''; ?>>Lifestyle</option>
                            <option value="health" <?php echo ($data['district'] == 'health') ? 'selected' : ''; ?>>Health</option>
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Postal Code</label><br>
                        <input type="number" class="form-topic"  name="postalCode" value="<?php echo $data['postal_code']; ?>"required>
                    </div>
                </div>

                <input type="submit" value="Update" name="submitusededit">
            </form>
        </div>
        <?php
            include_once 'footer.php';
        ?>
    </div>


