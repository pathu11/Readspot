<?php
    $title = "Dashboard";
    include_once 'header.php';
?>

    <div class="container">
        <?php
            include_once 'sidebar.php';
        ?>

        <div class="add-content">
            <form action="http://localhost/Group-27/app/controllers/customer/AddExchangedbookController.php" class="book-add">

                <h1>Add a Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic" required>Book Name</label><br>
                    <input type="text" name="book_name"class="form-topic">
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic" required>Author of Book</label><br>
                    <input type="text" name="author_name" class="form-topic">
                </div>
                

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic" required>Book Category</label><br>
                        <select id="category" name="book_category" required>
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
                        <label class="label-topic" required>Condition</label><br>
                        <select id="category" name="book_condition" required>
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
                        <label class="label-topic" published_daterequired>Published Year</label><br>
                        <input type="Number"  name="book_condition" class="form-topic" min=1800 max=2023>
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author weight">
                        <label class="label-topic" required>Weight (grams)</label><br>
                        <input type="number"   name="weight_grams" class="form-topic" min=0 required>
                    </div>
                    <div class="topic-book author weight2">
                        <a href="#"><button  class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1" required>ISBN Number</label><br>
                    <input type="text"    name="isbn_number" class="form-topic" id="input1">
                </div>
        
                <!-- <div class="topic-book author">
                    <label class="label-topic" for="input2" required>ISSN Number</label><br>
                    <input type="text" name="issn_number"  class="form-topic" id="input2">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3" required>ISMN Number</label><br>
                    <input type="text" name="ismn_number" class="form-topic" id="input3">
                </div> -->
        
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
                        <input type="file" id="picture" name="front_page_img" accept="image/*" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" name="back_page_img" accept="image/*" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" name="inside_page_img" accept="image/*" required>
                    </div>
                </div>
                <hr>

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic" required>Town</label><br>
                        <input type="text"  name="town" class="form-topic">
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic" required>District</label><br>
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
                        <label class="label-topic" required>Postal Code</label><br>
                        <input type="number" name="postal_code" class="form-topic" min=0>
                    </div>
                </div>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    

<?php
    include_once 'footer.php';
?>
