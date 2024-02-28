<?php
    $title = "Update Exchange Book";
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
            <form action="<?php echo URLROOT; ?>/customer/updateexchangebook/<?php echo $data['book_id'];?>" enctype="multipart/form-data" class="book-add" method="POST">

                <h1>Update the Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic">Book Name</label><br>
                    <input type="text" name="bookName"class="form-topic" value="<?php echo $data['book_name']; ?>" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Author of Book</label><br>
                    <input type="text" name="author" class="form-topic" value="<?php echo $data['author']; ?>" required>
                </div>
                

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Book Category</label><br>
                        <select id="category" name="category" required>
                            <option value="classics" <?php echo ($data['category'] == 'classics') ? 'selected' : ''; ?>>Classics</option>
                            <option value="Fantasy" <?php echo ($data['category'] == 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                            <option value="Novel" <?php echo ($data['category'] == 'Novel') ? 'selected' : ''; ?>>Novel</option>
                            <option value="Romance" <?php echo ($data['category'] == 'Romance') ? 'selected' : ''; ?>>Romance</option>
                            <option value="Science Fiction" <?php echo ($data['category'] == 'Science Fiction') ? 'selected' : ''; ?>>Science Fiction</option>
                            <!-- Add more categories as needed -->
                        </select>
                        <!-- <input type="text" class="form-topic"> -->
                    </div>
                
                    <div class="topic-book author">
                        <label class="label-topic">Condition</label><br>
                        <select id="category" name="bookCondition" required>
                            <option value="Used" <?php echo ($data['condition'] == 'Used') ? 'selected' : ''; ?>>Used</option>
                            <option value="Not Used" <?php echo ($data['condition'] == 'Not Used') ? 'selected' : ''; ?>>Not Used</option>
                            <option value="Good" <?php echo ($data['condition'] == 'Good') ? 'selected' : ''; ?>>Good</option>
                            <option value="Bad" <?php echo ($data['condition'] == 'Bad') ? 'selected' : ''; ?>>Bad</option>
                            <!-- <option value="health">Classics</option> -->
                            <!-- Add more categories as needed -->
                        </select>
                        <!-- <input type="text" class="form-topic"> -->
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Published Year</label><br>
                        <input type="Number"  id="publishedYear" name="publishedYear" class="form-topic" value="<?php echo $data['published_year']; ?>" min=1800 max="<?php echo date('Y'); ?>" required>
                        <span id="publishedYearError" style="color: red; display: none;">Please select a year.</span>
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author weight">
                        <label class="label-topic">Weight (grams)</label><br>
                        <input type="number"   name="weights" value="<?php echo $data['weight']; ?>" class="form-topic" min=0 required>
                    </div>
                    <div class="topic-book author weight2">
                        <a href="#"><button  class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1">ISBN Number</label><br>
                    <input type="text"    name="isbnNumber" class="form-topic" id="input1" value="<?php echo $data['ISBN_no']; ?>" required>
                </div>
        
                <div class="disc-book">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" name="description1" rows="12" class="form-topic" required><?php echo $data['descript']; ?></textarea>
                </div>

                <div class="disc-book">
                    <label class="label-topic">Which Books do you want</label><br>
                    <textarea id="description" name="description2" rows="12" class="form-topic" required><?php echo $data['booksIWant']; ?></textarea>
                </div>
        
                <div class="upload-pages">
                    <div class="img-cont">
                        <label class="label-topic">Upload Front Page</label><br>
                        <input type="file" id="picture" name="imgFront" accept="image/*" value="<?php echo $data['img1']; ?>" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" name="imgBack" accept="image/*" value="<?php echo $data['img2']; ?>" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" name="imgInside" accept="image/*" value="<?php echo $data['img3']; ?>" required>
                    </div>
                </div>
                <hr>

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Town</label><br>
                        <input type="text"  name="town" value="<?php echo $data['town']; ?>" class="form-topic" required>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic" required>District</label><br>
                        <select id="category" name="district" required>
                        <!-- <option value="">Select a type</option> -->
                            <option value="Ampara" <?php echo ($data['district'] == 'Ampara') ? 'selected' : ''; ?>>Ampara</option>
                            <option value="Anuradhapura" <?php echo ($data['district'] == 'Anuradhapura') ? 'selected' : ''; ?>>Anuradhapura</option>
                            <option value="Badulla" <?php echo ($data['district'] == 'Badulla') ? 'selected' : ''; ?>>Badulla</option>
                            <option value="Batticaloa" <?php echo ($data['district'] == 'Batticaloa') ? 'selected' : ''; ?>>Batticaloa</option>
                            <option value="Colombo" <?php echo ($data['district'] == 'Colombo') ? 'selected' : ''; ?>>Colombo</option>
                            <option value="Galle" <?php echo ($data['district'] == 'Galle') ? 'selected' : ''; ?>>Galle</option>
                            <option value="Gampaha" <?php echo ($data['district'] == 'Gampaha') ? 'selected' : ''; ?>>Gampaha</option>
                            <option value="Hambantota" <?php echo ($data['district'] == 'Hambantota') ? 'selected' : ''; ?>>Hambantota</option>
                            <option value="Jaffna" <?php echo ($data['district'] == 'Jaffna') ? 'selected' : ''; ?>>Jaffna</option>
                            <option value="Kalutara" <?php echo ($data['district'] == 'Kalutara') ? 'selected' : ''; ?>>Kalutara</option>
                            <option value="Kandy" <?php echo ($data['district'] == 'Kandy') ? 'selected' : ''; ?>>Kandy</option>
                            <option value="Kegalla" <?php echo ($data['district'] == 'Kegalla') ? 'selected' : ''; ?>>Kegalla</option>
                            <option value="Kilinochchi" <?php echo ($data['district'] == 'Kilinochchi') ? 'selected' : ''; ?>>Kilinochchi</option>
                            <option value="Kurunegala" <?php echo ($data['district'] == 'Kurunegala') ? 'selected' : ''; ?>>Kurunegala</option>
                            <option value="Mannar" <?php echo ($data['district'] == 'Mannar') ? 'selected' : ''; ?>>Mannar</option>
                            <option value="Matale" <?php echo ($data['district'] == 'Matale') ? 'selected' : ''; ?>>Matale</option>
                            <option value="Matara" <?php echo ($data['district'] == 'Matara') ? 'selected' : ''; ?>>Matara</option>
                            <option value="Moneragala" <?php echo ($data['district'] == 'Moneragala') ? 'selected' : ''; ?>>Moneragala</option>
                            <option value="Mullaitivu" <?php echo ($data['district'] == 'Mullaitivu') ? 'selected' : ''; ?>>Mullaitivu</option>
                            <option value="Nuwara Eliya" <?php echo ($data['district'] == 'Nuwara Eliya') ? 'selected' : ''; ?>>Nuwara Eliya</option>
                            <option value="Polonnaruwa" <?php echo ($data['district'] == 'Polonnaruwa') ? 'selected' : ''; ?>>Polonnaruwa</option>
                            <option value="Puttalam" <?php echo ($data['district'] == 'Puttalam') ? 'selected' : ''; ?>>Puttalam</option>
                            <option value="Ratnapura" <?php echo ($data['district'] == 'Ratnapura') ? 'selected' : ''; ?>>Ratnapura</option>
                            <option value="Trincomalee" <?php echo ($data['district'] == 'Trincomalee') ? 'selected' : ''; ?>>Trincomalee</option>
                            <option value="Vavuniya" <?php echo ($data['district'] == 'Vavuniya') ? 'selected' : ''; ?>>Vavuniya</option>
                            <!-- <option value="Colombo">Health</option> -->
                            <!-- Add more categories as needed -->
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Postal Code</label><br>
                        <input type="number" name="postalCode" class="form-topic" min=0 value="<?php echo $data['postal_code']; ?>"required>
                    </div>
                </div>

                <input type="submit" value="Submit">
            </form>
        </div>
        <?php
            include_once 'footer.php';
        ?>
    </div>

    <script>
        // JavaScript code for validating published year
        document.getElementById("publishedYear").addEventListener("input", function() {
            var year = this.value;
            // Validate if the year is within the allowed range
            var minYear = 1800; // Adjusted to 1800 based on typical use cases
            var maxYear = new Date().getFullYear(); // Get the current year
            if (year < minYear || year > maxYear) {
                document.getElementById("publishedYearError").style.display = "block";
            } else {
                document.getElementById("publishedYearError").style.display = "none";
            }
        });
    </script>