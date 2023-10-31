<?php
    $title = "Dashboard";
    include_once 'header.php';
?>

    <div class="container">
        <div class="sidebar">
        <!-- Sidebar content goes here -->
        <div class="profile-section">
            <img src="./assets/img/profile.png" alt="Profile Image" class="profile-image">
            <?php 
            if (isset($_SESSION["customerName"])){
                echo '<h2 class="profile-name1">'.$_SESSION["customerName"].'</h2>';
            } else {
                echo '<h2 class="profile-name1">Ramath Perera</h2>';
            }
            ?>
        </div>
        <br>
        <hr>

        <!-- Menu section -->
        <div class="menu-section">
            <ul class="menu-list">
                <li data-page="Dashboard"><a href="./Dashboard.php">Dashboard</a></li>
                <li data-page="Profile"><a href="./Profile.php">Profile</a></li>
                <li data-page="Notification"><a href="./Notification.php">Notification</a></li>
                <li data-page="Bookshelf"><a href="./Bookshelf.php">Bookshelf</a></li>
                <li data-page="Content"><a href="./Content.php">Content</a></li>
                <li data-page="Cart"><a href="./Cart.php">Cart</a></li>
            </ul>
        </div>
        </div>

        <div class="add-content">
            <form action="#" class="book-add">

                <h1>Add a Used Book</h1>
                
                <div class="topic-book">
                    <label class="label-topic" required>Book Name</label><br>
                    <input type="text" class="form-topic">
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic" required>Author of Book</label><br>
                    <input type="text" class="form-topic">
                </div>
                

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic" required>Book Category</label><br>
                        <select id="category" name="category" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                            <!-- Add more categories as needed -->
                        </select>
                        <!-- <input type="text" class="form-topic"> -->
                    </div>
                
                    <div class="topic-book author">
                        <label class="label-topic" required>Condition</label><br>
                        <select id="category" name="category" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                            <!-- Add more categories as needed -->
                        </select>
                        <!-- <input type="text" class="form-topic"> -->
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic" required>Published Date</label><br>
                        <input type="Date" class="form-topic">
                    </div>
                </div>


                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic" required>Price</label><br>
                        <input type="text" class="form-topic">
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic" required>Price Type</label><br>
                        <select id="category" name="category" required>
                        <!-- <option value="">Select a type</option> -->
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </div>
        
                    <div class="topic-book author weight">
                        <label class="label-topic" required>Weight (grams)</label><br>
                        <input type="text" class="form-topic" required>
                        <a href="#"><button class="weight-cal">Weight Calculator</button></a>
                    </div>
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input1" required>ISBN Number</label><br>
                    <input type="text" class="form-topic" id="input1">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input2" required>ISSN Number</label><br>
                    <input type="text" class="form-topic" id="input2">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3" required>ISMN Number</label><br>
                    <input type="text" class="form-topic" id="input3">
                </div>
        
                <div class="disc-book">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" name="description" rows="12" class="form-topic" required></textarea>
                </div>
        
                <div class="upload-pages">
                    <div class="img-cont">
                        <label class="label-topic">Upload Front Page</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload Back Page</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
        
                    <div class="img-cont">
                        <label class="label-topic">Upload a Inside Page</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                </div>
                <hr>
                <div class="topic-book">
                    <label class="label-topic" required>Account Holder's Name</label><br>
                    <input type="text" class="form-topic">
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic" required>Account Number</label><br>
                    <input type="number" class="form-topic">
                </div>

                <div class="upload-pages">
                    <div class="topic-book author">
                        <label class="label-topic" required>Bank Name</label><br>
                        <input type="text" class="form-topic">
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic" required>Branch Name</label><br>
                        <input type="text" class="form-topic">
                    </div>
                </div>
                <hr>

                <div class="upload-pages book-cate">
                    <div class="topic-book author">
                        <label class="label-topic" required>Town</label><br>
                        <input type="text" class="form-topic">
                    </div>
    
                    <div class="topic-book author">
                        <label class="label-topic" required>District</label><br>
                        <select id="category" name="category" required>
                        <!-- <option value="">Select a type</option> -->
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </div>

                    <div class="topic-book author">
                        <label class="label-topic" required>Postal Code</label><br>
                        <input type="number" class="form-topic">
                    </div>
                </div>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

<?php
    include_once 'footer.php';
?>
