<?php
    $title = "Used Book Details";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-detail">

        <div class="back-btn-div">
            <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>

    <?php foreach($data['bookDetails'] as $books): ?>

        <div class="book-img-des">
            <div class="book-img">
                <div class="sub1">
                <?php 
                    if ($books->type == "new") {
                        echo '<img src="' . URLROOT . '/assets/images/publisher/addBooks/' . $books->img1 . '" alt="Bell Image" width="180px">';
                    } elseif ($books->type == "used") {
                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                    } else {
                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                    }
            ?> <!--path changed-->
                </div>
                <div class="sub2">
                <?php 
                    if ($books->type == "new") {
                        echo '<img src="' . URLROOT . '/assets/images/publisher/addBooks/' . $books->img1 . '" alt="Bell Image" width="180px">';
                    } elseif ($books->type == "used") {
                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                    } else {
                        echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                    }
            ?>
                </div>
            </div>
            <div class="sub3">
                <h3>Description about the book</h3><br>
                <p><?php echo $books->descript; ?>
                </p>
            </div>
        </div>

        <div class="new-book-details">
            <div class="sub4">
                <h3>Book Name : <span><?php echo $books->book_name; ?></span></h3><br>
                <h3>Author of Book : <span><?php echo $books->author; ?></span></h3><br>
                <h3>Book Category : <span><?php echo $books->category; ?></span></h3><br>
                
                <h3>Price : <span><?php echo $books->price; ?></span></h3><br>
                <!-- <h3>Price Type : <span>Fixed</span></h3><br> -->
                <h3>Weight (grams) : <span><?php echo $books->weight; ?></span></h3><br>
                <h3>ISBN Number : <span><?php echo $books->ISBN_no; ?> </span></h3><br>
                <?php 
                    if ($books->type == "used" || $books->type == "exchanged" ) {
                        echo '<h3>Condition : <span>'. $books->condition .'</span></h3><br>
                        <h3>Published Date : <span>'. $books->published_date .'</span></h3><br><h3>'. $books->price_type .'<span>Fixed</span></h3><br>';
                    } 
            ?>
            </div>
            <div class="sub5">
                <h3>Town : <span><?php echo $books->town; ?></span></h3><br>
                <h3>District : <span><?php echo $books->district; ?></span></h3><br>
                <h3>Postal Code : <span><?php echo $books->postal_code; ?></span></h3><br>
            </div>
        </div>
        
            <div class="cart-item">
                <button class="quantity-button" onclick="decrement()">-</button>
                <span id="quantity">1</span>
                <button class="quantity-button" onclick="increment()">+</button>
                <button class="add-to-cart" onclick="addToCart(<?php echo $books->book_id; ?>)">Add to Cart</button>

    </div>

      

        <div class="comment-newbooks">
            <h1> Reviews and Rating </h1>
            <div class="send-review">
                <div class="stars">
                    <span class="heading">User Rating</span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <p>4.1 average based on 254 reviews.</p>
                    <hr style="border:3px solid #f1f1f1">

                    <div class="row-rating">
                        <div class="side">
                            <div>5 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                                <div class="bar-5"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>150</div>
                        </div>
                        
                        <div class="side">
                            <div>4 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                                <div class="bar-4"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>63</div>
                        </div>
                        
                        <div class="side">
                            <div>3 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                                <div class="bar-3"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>15</div>
                        </div>
                        
                        <div class="side">
                            <div>2 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                                <div class="bar-2"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>6</div>
                        </div>
                        
                        <div class="side">
                            <div>1 star</div>
                        </div>
                        <div class="middle">
                            <div class="bar-container">
                                <div class="bar-1"></div>
                            </div>
                        </div>
                        <div class="side right">
                            <div>20</div>
                        </div>
                    </div>
                </div>
                <div class="give-rate">
                    <div class="my-rate">
                        <span class="heading">Add your review</span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <div class="my-review">
                        <textarea id="description" rows="12"  name="descriptions"></textarea>
                    </div>
                    <button class="submit-review">Submit</button>
                </div>
            </div>
            <div class="filter-by">
                <h3>5 star</h3>
                <h3>4 star</h3>
                <h3>3 star</h3>
                <h3>2 star</h3>
                <h3>1 star</h3>
            </div>
            <div class="sort-by-star">
                <select id="searchBy"  name="category">
                    <option value="technology">Most relevant</option>
                    <option value="travel">Most recent</option>
                </select>
            </div>
            <div class="cus-rev">
                <div class="reviews">
                    <div class="cus-name-img">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png">
                        <h3>Ramath Perera</h3>
                    </div>
                    <div class="rev-date">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/starts.png">
                        <h6>01/01/2024</h6>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda saepe obcaecati ratione nostrum neque exercitationem aliquam dignissimos accusantium numquam esse.</p>
                    <div class="helpful">
                        <h4>Was this review helpful?</h4>
                        <div class="yes-no">
                            <h3>Yes</h3>
                            <h3>No</h3>
                        </div>
                    </div>
                    <h5>13 people found this helpful</h5>
                </div>
                <div class="reviews">
                    <div class="cus-name-img">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/profile.png">
                        <h3>Ramath Perera</h3>
                    </div>
                    <div class="rev-date">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/starts.png">
                        <h6>01/01/2024</h6>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda saepe obcaecati ratione nostrum neque exercitationem aliquam dignissimos accusantium numquam esse.</p>
                    <div class="helpful">
                        <h4>Was this review helpful?</h4>
                        <div class="yes-no">
                            <h3>Yes</h3>
                            <h3>No</h3>
                        </div>
                    </div>
                    <h5>13 people found this helpful</h5>
                </div>
            </div>
        </div>

        <div class="sub8">
            <a href="#"><button class="chat-btn">Chat</button></a>
          
            <a href="<?php echo URLROOT; ?>/customer/purchase/<?php echo $books->book_id; ?>"><button class="chat-btn">Purchase</button></a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script>
        let quantity = 1;

        function increment() {
            quantity++;
            document.getElementById('quantity').innerText = quantity;
        }

        function decrement() {
            if (quantity > 1) {
                quantity--;
                document.getElementById('quantity').innerText = quantity;
            }
        }

        function addToCart(bookId) {
            var quantity = document.getElementById('quantity').innerText;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        console.log('Response:', this.responseText);
                        console.log('Response Type:', typeof this.responseText);

                        try {
                            var response = JSON.parse(this.responseText);
                            if (response.status === 'success') {
                                window.location.href = '<?php echo URLROOT; ?>/customer/cart';
                                // ... (rest of the code)
                            } else {
                                console.error('Error adding to cart:', response.message);
                                // Display an error message to the user
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                            // Display a generic error message to the user
                        }
                    } else {
                        console.error('HTTP error:', this.status);
                        // Handle HTTP errors (e.g., display a generic error message)
                    }
                }
    };

    xhttp.open("GET", '<?php echo URLROOT; ?>/customer/addToCart/' + bookId + '?quantity=' + quantity, true);
    xhttp.send();
}





    </script>


<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
