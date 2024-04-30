<?php
    $title = "Used Book Details";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                
                <h3>Price : <span>
                    <?php if ($books->discounts != 0.00): ?>
                        <span style="text-decoration: line-through;"><?php echo $books->price; ?></span> <!-- Display old price with underline -->
                        <?php 
                            $discountedPrice = $books->price - ($books->price * ($books->discounts / 100)); // Calculate discounted price
                            echo $discountedPrice; // Display discounted price
                        ?>
                    <?php else: ?>
                        <?php echo $books->price; ?>
                    <?php endif; ?>
                </span></h3><br>
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
                <div class="stock-div">
                    <!-- <h1>In Stock</h1> -->
                    <?php if ($books->quantity == 0): ?>
                        <h1 class="outStock">Out of Stock</h1>
                    <?php else: ?>
                        <h1>In Stock</h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="cart-item">
            <?php 
                $num = 0; // Initialize the variable before the loop
                if ($data['user_id']==0000){
                    $num = 0;
                }else{
                    foreach ($data['favoriteDetails'] as $favorite): 
                        if ($books->book_id == $favorite->item_id): 
                            $num = 1;
                            $fav_id = $favorite->fav_id;
                            break; // Assuming you want to stop the loop once a match is found
                        endif;
                    endforeach;
                }
            ?>
            <?php if ($num == 1): ?>
                <a href="<?php echo URLROOT; ?>/customer/deleteFavorite/<?php echo $fav_id; ?>">
                    <button class="book-button-after-fav before-cart">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </a>
            <?php else: ?>
                <a href="<?php echo URLROOT; ?>/customer/addToFavoriteNewBooks/<?php echo $books->book_id; ?>">
                    <button class="book-button before-cart">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </a>
            <?php endif; ?>
            <button class="quantity-button" onclick="decrement()">-</button>
            <span id="quantity">0</span>
            <button class="quantity-button" onclick="increment(<?php echo $books->quantity; ?>)">+</button>
            <?php if(($books->quantity>0)): ?>
                <button class="add-to-cart" onclick="addToCart(<?php echo $books->book_id; ?>)">Add to Cart</button>
            <?php else: ?>
                <button class="add-to-cart" onclick="error()" >Add to Cart</button>
            <?php endif; ?>

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
                                echo '<img src="' . URLROOT . '/assets/images/customer/ProfileImages/'.$reviews->profile_img.'">';
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
                    
                    <!-- <div class="helpful">
                        <h4>Was this review helpful?</h4>
                        <?php if(isset($data['user_id'])): ?>
                            <button class="helpful-button" data-review-id="<?php echo $reviews->review_id; ?>" data-action="helpful"<?php echo isset($_SESSION['review_clicksBooks'][$reviews->review_id][$data['user_id']]) ? ' disabled' : ''; ?>>Yes</button>
                            <button class="not-helpful-button" data-review-id="<?php echo $reviews->id; ?>" data-action="not-helpful"<?php echo isset($_SESSION['review_clicksBooks'][$reviews->review_id][$data['user_id']]) ? ' disabled' : ''; ?>>No</button>
                        <?php else: ?>
                            <button class="helpful-button" data-review-id="<?php echo $reviews->review_id; ?>" data-action="helpful" disabled>Yes</button>
                            <button class="not-helpful-button" data-review-id="<?php echo $reviews->id; ?>" data-action="not-helpful" disabled>No</button>
                        <?php endif; ?>
                    </div> -->
                    
                    <!-- <h5><?php echo $reviews->help; ?>  people found this helpful</h5>    -->
                    <?php if(isset($data['customer_id'])): ?>
                            <?php if ($reviews->customer_id == $data['customer_id']): ?>
                                <div>
                                <a class="reviewBtn" href="<?php echo URLROOT; ?>/customer/deleteReviewBook/<?php echo $books->book_id; ?>/<?php echo $reviews->review_id; ?>">Delete</a>
                                <!-- <a class="reviewBtn update-review-link" href="#" data-review-id="<?php echo $reviews->review_id; ?>" data-content-id="<?php echo $books->book_id; ?>">Update</a> -->
                            </div>
                           
                            <?php endif; ?>
                        <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="sub8">
            <?php if($books->quantity>0): ?>
                <a href="#" onclick="addToCart2(<?php echo $books->book_id; ?>)"><button class="chat-btn">Purchase</button></a>
            <?php else: ?>
                <a href="#" onclick="error()"><button class="chat-btn">Purchase</button></a>
            <?php endif ; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <div id="update-review-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Update Review</h2>
            <form id="update-review-form" action="" method="post">
                <input type="text" class="text" id="update-review-text" name="description" placeholder="Update your review..." rows="4">
                <div class="my-rate">
                    <label for="rate-5" class="fas fa-star"></label>
                    <label for="rate-4" class="fas fa-star"></label>
                    <label for="rate-3" class="fas fa-star"></label>
                    <label for="rate-2" class="fas fa-star"></label>
                    <label for="rate-1" class="fas fa-star"></label><br>
                </div>
                <div>
                    <input type="radio" class="radionBtn" name="rate" id="rate-5" value="5">
                    <input type="radio" class="radionBtn" name="rate" id="rate-4" value="4">
                    <input type="radio" class="radionBtn" name="rate" id="rate-3" value="3">
                    <input type="radio" class="radionBtn" name="rate" id="rate-2" value="2">
                    <input type="radio" class="radionBtn" name="rate" id="rate-1" value="1">
                </div>
                <input type="hidden" name="content_id" id="update-content-id" value="">
                <input type="hidden" name="review_id" id="update-review-id" value="">
                <input type="submit" class="confirm" value="Update">
            </form>
        </div>
</div>


    <script>
 
    function openModal(reviewId, contentId) {
        console.log('Opening modal for Review ID:', reviewId);
        console.log('Opening modal for Content ID:', contentId);
        const form = document.getElementById('update-review-form');
        form.action = "<?php echo URLROOT; ?>/customer/updateReviewBook/" + contentId + "/" + reviewId;
        document.getElementById('update-content-id').value = contentId;
        document.getElementById('update-review-id').value = reviewId;
        document.getElementById('update-review-modal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('update-review-modal').style.display = 'none';
    }
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Document loaded.');
        const updateReviewLinks = document.querySelectorAll('.update-review-link');
        console.log('Update review links found:', updateReviewLinks.length);
        
        updateReviewLinks.forEach(link => {
            console.log('Adding event listener to update review link:', link);
            link.addEventListener('click', function() {
                console.log('Update review link clicked.');
                const reviewId = this.dataset.reviewId;
                const contentId = this.dataset.contentId;
                console.log('Review ID:', reviewId);
                console.log('Content ID:', contentId);
                openModal(reviewId, contentId); 
            });
        });
});


 document.addEventListener('DOMContentLoaded', function() {
    const helpfulButtons = document.querySelectorAll('.helpful-button');
    helpfulButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const reviewId = button.dataset.reviewId;
            const isHelpful = button.dataset.action === 'helpful';

            // Check if the button has already been clicked
            const hasClicked = localStorage.getItem(`helpful_${reviewId}`);
            if (hasClicked) {
                console.log('You have already clicked this button.');
                return; // Exit function if already clicked
            }
            // Send AJAX request to update review helpfulness
            fetch(`${window.location.origin}/customer/updateReviewHelpfulBooks?reviewId=${reviewId}&isHelpful=${isHelpful}`)
                .then(response => {
                    if (response.ok) {
                        // Disable the button and mark it as clicked
                        button.disabled = true;
                        button.classList.add('clicked');
                        // Store in local storage that the user has clicked this button
                        localStorage.setItem(`helpful_${reviewId}`, true);
                    } else {
                        console.error('Failed to update review helpfulness');
                    }
                })
                .catch(error => {
                    console.error('Error updating review helpfulness:', error);
                });
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
            header.textContent = You rated it ${rating} stars.;
        });
    });

    </script>
    <script>
        
        let quantity = 0;

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
                                sweetAlertCart();
                                // window.location.href = '<?php echo URLROOT; ?>/customer/cart';
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
        function sweetAlertCart() {
      
              Swal.fire({
                  title: 'Success',
                  text: 'Your Book is added to the cart successfully',
                  icon: 'success',
                
                  confirmButtonText: 'Ok',
                  confirmButtonColor: "#70BFBA",
                
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Redirect to login page
                      window.location.href = '<?php echo URLROOT; ?>/customer/cart';
                  }
              });
  
              // Return false to prevent form submission
              return false;
         
          return true;
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
                                sweetAlertCart();
                                // window.location.href = '<?php echo URLROOT; ?>/customer/cart';
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

    function error() {
      
      Swal.fire({
          title: 'Error',
          text: 'This book is out of stock',
          icon: 'warning',
        
          confirmButtonText: 'Ok',
          confirmButtonColor: "#70BFBA",
        
      }).then((result) => {
          if (result.isConfirmed) {
              // Redirect to login page
              window.location.href = window.location.href;
          }
      });

      // Return false to prevent form submission
      return false;
 
  return true;
}


    </script>


<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>