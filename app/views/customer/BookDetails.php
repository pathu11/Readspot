<?php
    $title = "Used Book Details";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-detail">
        <div class="book-img-des">
            <div class="book-img">
                <div class="sub1">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book3"> <!--path changed-->
                </div>
                <div class="sub2">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/back.jpeg" alt="Book3"> <!--path changed-->
                </div>
            </div>
            <div class="sub3">
                <h3>Description about the book</h3><br>
                <p>The Great Gatsby, third novel by F. Scott Fitzgerald, published in 1925 by Charles Scribner’s Sons. Set in Jazz Age New York, the novel tells the tragic story of Jay Gatsby, a self-made millionaire, and his pursuit of Daisy Buchanan, a wealthy young woman whom he loved in his youth. Unsuccessful upon publication, the book is now considered a classic of American fiction and has often been called the Great American Novel.
                </p>
            </div>
        </div>

        <div class="new-book-details">
            <div class="sub4">
                <h3>Book Name : <span>The Great Gatsby</span></h3><br>
                <h3>Author of Book : <span>F. Scott Fitzgerald</span></h3><br>
                <h3>Book Category : <span>Novel</span></h3><br>
                <h3>Condition : <span>Used</span></h3><br>
                <h3>Published Date : <span>November 17, 2020</span></h3><br>
                <h3>Price : <span>Rs.1500.00</span></h3><br>
                <h3>Price Type : <span>Fixed</span></h3><br>
                <h3>Weight (grams) : <span>181g</span></h3><br>
                <h3>ISBN Number : <span>ISBN 9780743273565 </span></h3><br>
            </div>
            <div class="sub5">
                <h3>Town : <span>Panadura</span></h3><br>
                <h3>District : <span>Kalutara</span></h3><br>
                <h3>Postal Code : <span>12500</span></h3><br>
            </div>
        </div>
        <div class="cart-item">
            <button class="quantity-button" onclick="decrement()">-</button>
            <span id="quantity">1</span>
            <button class="quantity-button" onclick="increment()">+</button>
            <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
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

                    <div class="row">
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

        <div class="sub8">
            <a href="#"><button class="chat-btn">Chat</button></a>
            <a href="<?php echo URLROOT; ?>/customer/purchase/79"><button class="chat-btn">Purchase</button></a>

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

        function addToCart() {
            // Add your logic to handle adding to cart
            alert('Item added to cart with quantity: ' + quantity);
        }
    </script>


<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
