<?php
    $title = "Used Book Details";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
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
                            echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' . $books->img1 . '" alt="Bell Image" width="180px">';
                        } else {
                            echo '<img src="' . URLROOT . '/assets/images/customer/book.jpg" alt="Bell Image" width="180px">';
                        }
                    ?> <!--path changed-->
                </div>
                <div class="sub2">
                    <?php 
                        if ($books->type == "new") {
                            echo '<img src="' . URLROOT . '/assets/images/publisher/addBooks/' . $books->img2 . '" alt="Bell Image" width="180px">';
                        } elseif ($books->type == "used") {
                            echo '<img src="' . URLROOT . '/assets/images/customer/AddUsedBook/' . $books->img2 . '" alt="Bell Image" width="180px">';
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
            <button class="quantity-button" onclick="increment(<?php echo $books->quantity; ?>)">+</button>
            <button class="add-to-cart" onclick="addToCart(<?php echo $books->book_id; ?>)">Add to Cart</button>
        </div>
        
        <div class="comment-newbooks">
            <h1> Reviews and Rating </h1>
            <div class="send-review">
                <div class="stars">
                    <?php 
                        if (isset($data['averageRatingCount']->average_rating)) {
                            $rating = ceil($data['averageRatingCount']->average_rating);
                            for ($i = 0; $i < $rating; $i++) {
                                echo '<span class="fas fa-star checked"></span>';
                            }
                            for ($i = $rating; $i < 5; $i++) {
                                echo '<span class="fas fa-star"></span>';
                            }
                            echo '<p>' . $data['averageRatingCount']->average_rating . ' average based on ' .$data['averageRatingCount']->total_reviews . ' reviews.</p>';
                        } else {
                            echo '<p>No reviews</p>';
                        }
                    ?>
                    <hr style="border:3px solid #f1f1f1">
                    
                    <div class="row-rating" id="rating_graph">
                        <canvas id="ratingChart" width="400" height="200"></canvas>
                    </div>
                </div>
                
                <div class="give-rate">
                    
                    <form action="<?php echo URLROOT; ?>/customer/addReview" method="post">
                    <div class="my-rate">
                        <span class="heading">Add your review</span>
                        <input type="radio" name="rate" id="rate-5" value="5">
                        <label for="rate-5" class="fas fa-star"></label>

                        <input type="radio" name="rate" id="rate-4" value="4">
                        <label for="rate-4" class="fas fa-star"></label>

                        <input type="radio" name="rate" id="rate-3" value="3">
                        <label for="rate-3" class="fas fa-star"></label>

                        <input type="radio" name="rate" id="rate-2" value="2">
                        <label for="rate-2" class="fas fa-star"></label>

                        <input type="radio" name="rate" id="rate-1" value="1">
                        <label for="rate-1" class="fas fa-star"></label>

                    </div>
               
                    <header></header>
                    <div class="my-review">
                        <textarea id="description" placeholder="Describe your experience.." rows="12"  name="descriptions"></textarea>
                        <input type="hidden" name="book_id" value="<?php echo $books->book_id; ?>">
                       
                    </div>
                    <button type="submit" class="submit-review">Submit</button>
                    </form>
                </div>

            </div>
            
            <!-- <div class="sort-by-star">
                <select id="searchBy"  name="category">
                    <option value="technology">Most relevant</option>
                    <option value="travel">Most recent</option>
                </select>
            </div> -->
            <div class="cus-rev">
                <?php foreach($data['reviewDetails'] as $reviews): ?>
                <div class="reviews">
                    
                    <div class="cus-name-img">
                        <?php
                            if ($reviews->profile_img) {
                                echo '<img src="' . URLROOT . '/assets/images/customer/ProfileImages/<?php echo $reviews->profile_img; ?>">';
                            } else {
                                echo '<img src="' . URLROOT . '/assets/images/customer/profile.png" alt="Profile Image" class="profile-image">';
                            }
                        ?>
                        <h3><?php echo $reviews->name; ?></h3>
                    </div>
                    <div class="rev-date">
                    <div class="rating-stars">
                        <?php 
                            $rating = $reviews->rate;
                            // Loop to generate the appropriate number of star icons based on the rating
                            for ($i = 0; $i < $rating; $i++) {
                                echo '<span class="fas fa-star checked"></span>';
                            }
                            // Fill the remaining stars with empty stars
                            for ($i = $rating; $i < 5; $i++) {
                                echo '<span class="fas fa-star"></span>';
                            }
                        ?>
                     </div>
                        <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/starts.png"> -->
                        <h6><?php echo $reviews->time; ?></h6>
                    </div>
                    <p><?php echo $reviews->review; ?></p>
                    
                    <div class="helpful">
                        <h4>Was this review helpful?</h4>
                        <?php if(isset($data['user_id'])): ?>
                            <button class="helpful-button" data-review-id="<?php echo $reviews->review_id; ?>" data-action="helpful"<?php echo isset($_SESSION['review_clicksBooks'][$reviews->review_id][$data['user_id']]) ? ' disabled' : ''; ?>>Yes</button>
                            <button class="not-helpful-button" data-review-id="<?php echo $reviews->id; ?>" data-action="not-helpful"<?php echo isset($_SESSION['review_clicksBooks'][$reviews->review_id][$data['user_id']]) ? ' disabled' : ''; ?>>No</button>
                        <?php else: ?>
                            <button class="helpful-button" data-review-id="<?php echo $reviews->review_id; ?>" data-action="helpful" disabled>Yes</button>
                            <button class="not-helpful-button" data-review-id="<?php echo $reviews->id; ?>" data-action="not-helpful" disabled>No</button>
                        <?php endif; ?>
</div>
                          
                <h5><?php echo $reviews->help; ?>  people found this helpful</h5>   
                    <!-- </div> -->
                 
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>

        <div class="sub8">
            <a href="#" onclick="addToCart2(<?php echo $books->book_id; ?>)"><button class="chat-btn">Purchase</button></a>
        </div>
        <?php endforeach; ?>
    </div>



    <script>
 
    
document.querySelectorAll('.helpful-button').forEach(button => {
    button.addEventListener('click', function() {
        const reviewId = this.dataset.reviewId;
        const isHelpful = this.dataset.action === 'helpful';

        fetch(`<?php echo URLROOT; ?>/customer/updateReviewHelpfulBooks?reviewId=${reviewId}&isHelpful=${isHelpful}`)
            .then(response => {
                if (response.ok) {
                   
                    this.disabled = true; // Disable the button after clicking
                    this.classList.add('clicked'); // Optionally, add a class to indicate the button was clicked
                } else {
                    console.error('Failed to update review helpfulness');
                }
            })
            .catch(error => {
                console.error('Error updating review helpfulness:', error);
            });
    });
});

    const btn = document.querySelector("button");
    const post = document.querySelector(".post");
    const widget = document.querySelector(".my-rate");
    const editBtn = document.querySelector(".edit");

    btn.onclick = () => {
        widget.style.display = "none";
        post.style.display = "block";
    }

    editBtn.onclick = () => {
        widget.style.display = "block";
        post.style.display = "none";
    }

    const starLabels = document.querySelectorAll('.my-rate label');

    starLabels.forEach((label, index) => {
        label.addEventListener('click', () => {
            const rating = index + 1;
            const header = document.querySelector('.give-rate .post .text');
            header.textContent = `You rated it ${rating} stars.`;
        });
    });

    </script>
    <script>
        
        let quantity = 1;

        function increment(maxQuantity) {
            if (quantity < maxQuantity) {
                quantity++;
                document.getElementById('quantity').innerText = quantity;
            }
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
                            } 
                            else {
                                console.error('Error adding to cart:', response.message);
                               
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                           
                        }
                    } else {
                        console.error('HTTP error:', this.status);
                       
                    }
                }
    };

    xhttp.open("GET", '<?php echo URLROOT; ?>/customer/addToCart/' + bookId + '?quantity=' + quantity, true);
    xhttp.send();
}
function addToCart2(bookId) {
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
                               
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                           
                        }
                    } else {
                        console.error('HTTP error:', this.status);
                       
                    }
                }
    };

    xhttp.open("GET", '<?php echo URLROOT; ?>/customer/addToCart/' + bookId + '?quantity=' + quantity, true);
    xhttp.send();
}

    const star_1=<?php echo $data['countStar_1']->total_1; ?>;
    const star_2=<?php echo $data['countStar_2']->total_2; ?>;
    const star_3=<?php echo $data['countStar_3']->total_3; ?>;
    const star_4=<?php echo $data['countStar_4']->total_4; ?>;
    const star_5=<?php echo $data['countStar_5']->total_5; ?>;
    

   
    const starCounts = [star_1,star_2, star_3,star_4,star_5]; // Counts for 1 star, 2 stars, 3 stars, 4 stars, and 5 stars respectively
    // Get the canvas element
    const ctx = document.getElementById('ratingChart').getContext('2d');
    // Create the chart
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
            datasets: [{
                label: 'Number of Reviews',
                data: starCounts,
               
                backgroundColor: [
                    '#ff0000', 
                    '#ff6600', 
                    '#ffcc00', 
                    '#99ff00',
                    '#00ff00' 
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1 // Ensure ticks are whole numbers
                    }
                }]
            }
        }
    });




    </script>


<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
