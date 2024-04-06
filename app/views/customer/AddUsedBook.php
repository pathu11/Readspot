<?php
    $title = "Add Used Book";
    require APPROOT . '/views/customer/header.php';
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php';
    ?>
    <div class="container">

        <div class="add-content">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <form action="<?php echo URLROOT; ?>/customer/AddUsedBook" enctype="multipart/form-data" class="book-add" method="POST">

                <h1>Add a Used Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic">Book Name</label><br>
                    <input type="text" class="form-topic"  name="bookName"  required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Author of Book</label><br>
                    <input type="text" class="form-topic"  name="author" required>
                </div>
                

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Book Category</label><br>
                        <select id="category"  name="category" required>
                            <!-- <option value="" selected disabled>Select Book Category</option> -->
                            <?php foreach($data['bookCategoryDetails'] as $bookCategoryDetails): ?>
                                <option><?php echo $bookCategoryDetails->category; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                
                    <div class="topic-book author">
                        <label class="label-topic">Condition</label><br>
                        <select id="category"  name="bookCondition" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Published Year</label><br>
                        <input type="number" class="form-topic"  name="publishedYear" required min=1800>
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Price</label><br>
                        <input type="number" class="form-topic"  name="price" required min=0>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic">Price Type</label><br>
                        <select id="category"  name="priceType" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>
        
                    <div class="topic-book author weight">
                        <label class="label-topic">Weight (grams)</label><br>
                        <input type="number" class="form-topic"  name="weights" required min=0>
                        <a href="#"><button class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1">ISBN Number</label><br>
                    <input type="text" class="form-topic" id="input1" name="isbnNumber" required>
                </div>
        
                <!-- <div class="topic-book author">
                    <label class="label-topic" for="input2">ISSN Number</label><br>
                    <input type="text" class="form-topic" id="input2" name="issnNumber">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3">ISMN Number</label><br>
                    <input type="text" class="form-topic" id="input3" name="issmNumber">
                </div> -->
        
                <div class="disc-book">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" rows="12" class="form-topic"  name="descriptions" required></textarea>
                </div>
        
                <div class="upload-pages">
                    <div class="img-cont">
                        <label class="label-topic">Upload Front Page</label><br>
                        <input type="file" id="picture" accept="image/*"  name="imgFront" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" accept="image/*"  name="imgBack" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" accept="image/*"  name="imgInside" required>
                    </div>
                </div>
                <hr>
                <div class="topic-book">
                    <label class="label-topic">Account Holder's Name</label><br>
                    <input type="text" class="form-topic"  name="accName" value="<?php echo $data['account_name']; ?>" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Account Number</label><br>
                    <input type="number" class="form-topic"  name="accNumber" value="<?php echo $data['account_no']; ?>" required>
                </div>

                <div class="upload-pages">
                    <div class="topic-book author">
                        <label class="label-topic">Bank Name</label><br>
                        <input type="text" class="form-topic"  name="bankName" value="<?php echo $data['bank_name']; ?>" required>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Branch Name</label><br>
                        <input type="text" class="form-topic"  name="branchName" value="<?php echo $data['branch_name']; ?>" required>
                    </div>
                </div>
                <hr>

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Town</label><br>
                        <input type="text" class="form-topic"  name="town" value="<?php echo $data['town']; ?>" required>
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
                        <input type="number" class="form-topic"  name="postalCode" value="<?php echo $data['postal_code']; ?>" required>
                    </div>
                </div>

                <input type="submit" value="Submit" name="submitused">
            </form>
        </div>
    <?php
        require APPROOT . '/views/customer/footer.php';
    ?>    
    </div>
