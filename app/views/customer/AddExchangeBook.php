<?php
    $title = "Add Exchange Book";
    include_once 'header.php';
?>
    <?php
        include_once 'sidebar.php';
    ?>
    <div class="container">
        <div class="add-content">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <form action="<?php echo URLROOT; ?>/customer/AddExchangeBook" enctype="multipart/form-data" class="book-add" method="POST">

                <h1>Add a Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic">Book Name</label><br>
                    <input type="text" name="bookName"class="form-topic" required>
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic">Author of Book</label><br>
                    <input type="text" name="author" class="form-topic" required>
                </div>
                

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Book Category</label><br>
                        <select id="category" name="category" required>
                            <option value="technology">Classics</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Novel">Novel</option>
                            <option value="Romance">Romance</option>
                            <option value="Science Fiction">Science Fiction</option>
                            <!-- Add more categories as needed -->
                        </select>
                        <!-- <input type="text" class="form-topic"> -->
                    </div>
                
                    <div class="topic-book author">
                        <label class="label-topic">Condition</label><br>
                        <select id="category" name="bookCondition" required>
                            <option value="Used">Used</option>
                            <option value="Not Used">Not Used</option>
                            <option value="Good">Good</option>
                            <option value="Bad">Bad</option>
                            <!-- <option value="health">Classics</option> -->
                            <!-- Add more categories as needed -->
                        </select>
                        <!-- <input type="text" class="form-topic"> -->
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Published Year</label><br>
                        <input type="Number"  name="publishedYear" class="form-topic" min=1800 required>
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author weight">
                        <label class="label-topic">Weight (grams)</label><br>
                        <input type="number"   name="weights" class="form-topic" min=0 required>
                    </div>
                    <div class="topic-book author weight2">
                        <a href="#"><button  class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1">ISBN Number</label><br>
                    <input type="text"    name="isbnNumber" class="form-topic" id="input1" required>
                </div>
        
                <div class="disc-book">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" name="description1" rows="12" class="form-topic" required></textarea>
                </div>

                <div class="disc-book">
                    <label class="label-topic">Which Books do you want</label><br>
                    <textarea id="description" name="description2" rows="12" class="form-topic" required></textarea>
                </div>
        
                <div class="upload-pages">
                    <div class="img-cont">
                        <label class="label-topic">Upload Front Page</label><br>
                        <input type="file" id="picture" name="imgFront" accept="image/*" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" name="imgBack" accept="image/*" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" name="imgInside" accept="image/*" required>
                    </div>
                </div>
                <hr>

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic">Town</label><br>
                        <input type="text"  name="town" class="form-topic" required>
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic">District</label><br>
                        <select id="category" name="district" required>
                        <!-- <option value="">Select a type</option> -->
                            <option value="Ampara">Ampara</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Galle">Galle</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kalutara">Kalutara</option>
                            <option value="Kandy">Kandy</option>
                            <option value="Kegalla">Kegalla</option>
                            <option value="Kilinochchi">Kilinochchi</option>
                            <option value="Kurunegala">Kurunegala</option>
                            <option value="Mannar">Mannar</option>
                            <option value="Matale">Matale</option>
                            <option value="Matara">Matara</option>
                            <option value="Moneragala">Moneragala</option>
                            <option value="Mullaitivu">Mullaitivu</option>
                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                            <option value="Polonnaruwa">Polonnaruwa</option>
                            <option value="Puttalam">Puttalam</option>
                            <option value="Ratnapura">Ratnapura</option>
                            <option value="Trincomalee">Trincomalee</option>
                            <option value="Vavuniya">Vavuniya</option>
                            <!-- <option value="Colombo">Health</option> -->
                            <!-- Add more categories as needed -->
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic">Postal Code</label><br>
                        <input type="number" name="postalCode" class="form-topic" min=0 required>
                    </div>
                </div>

                <input type="submit" value="Submit">
            </form>
        </div>
        <?php
            include_once 'footer.php';
        ?>
    </div>
