<?php
    $title = "View Contents";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .radionBtn{
        display:none;
    }
</style>
</head>
<?php foreach($data['contentDetails'] as $content): ?>
<div class="main-content-div">
        <h1 class="cont-topic"><?php echo $content->topic; ?></h1>
    <div class="img-summary">
        <img src="<?php echo URLROOT; ?>/assets/images/landing/addcontents/<?php echo $content->img; ?>" alt="Book3" class="content-img-main"> <!--path changed
    <div class="text-summary">
        <h3>Article Summary</h3>
        <br>
        <hr>
        <br>
         <p><?php echo $content->text; ?></p>
    </div>
</div>
<div class="cont-details">
    <div class="pdf-view" style="overflow: auto;">
    
            <input id="pdf-url" style="display:none;" type="text" value="<?php echo URLROOT; ?>/assets/images/landing/addContents/<?php echo $content->doc; ?>">
            <div id="pdf-viewer"></div>
            <button class="prev-btn" id="prev-page">Previous</button>
            <button class="next-btn" id="next-page">Next </button>
    </div>

    <div class="sub-content-div">
        <h1 class="cont-topic"><?php echo $content->topic; ?></h1>
        <div class="img-summary">
            <img src="<?php echo URLROOT; ?>/assets/images/landing/addcontents/<?php echo $content->img; ?>" alt="Book3" class="content-img-main"> <!--path changed -->
            <div class="text-summary">
                <h3>Article Summary</h3>
                <br>
                <hr>
                <br>
                <p><?php echo $content->text; ?></p>
            </div>
        </div>
        <div class="cont-details">
            <div class="pdf-view" style="overflow: auto;">
            
                    <input id="pdf-url" style="display:none;" type="text" value="<?php echo URLROOT; ?>/assets/images/landing/addContents/<?php echo $content->doc; ?>">
                    <div id="pdf-viewer"></div>
                    <div class="next-prev-button-div">
                        <button class="prev-btn" id="prev-page">Previous</button>
                        <button class="next-btn" id="next-page">Next </button>
                    </div>
            </div>
            <div class="writer-details">
        
                <h3>Writer's Information </h3>
                <br>
                <hr>
                <br>
                <img src="<?php echo URLROOT; ?>/assets/images/customer/ProfileImages/<?php echo $content->profile_img; ?>"><br><br>
                <p style="font-size:18px;"><?php echo $content->name; ?> </p>
                <p style="font-size:15px;"><?php echo $content->email; ?></p>
                <br><br>
                <p class="down"><b>Download this Content as a PDF</b></p><br><br>
                    <a href="<?php echo URLROOT; ?>/assets/images/landing/addContents/<?php echo $content->doc; ?>" download>
                        <button class="btn-d">Click Here</button>
                    </a>

<!--     <div class="writer-details">
   
        <h3>Writer's Information </h3>
        <br>
        <hr>
        <br>
        <img src="<?php echo URLROOT; ?>/assets/images/customer/ProfileImages/<?php echo $content->profile_img; ?>"><br><br>
        <p style="font-size:18px;"><?php echo $content->name; ?> </p>
        <p style="font-size:15px;"><?php echo $content->email; ?></p>
        <br><br><br>
        <p class="down"><b>Download this Content as a PDF</b></p><br><br>
            <a href="<?php echo URLROOT; ?>/assets/images/landing/addContents/<?php echo $content->doc; ?>" download>
                <button class="btn-d">Click Here</button>
            </a> -->


</div>
</div>

<?php endforeach; ?>
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
                        echo '<p>' . $data['averageRatingCount']->average_rating . ' average based on '.$data['averageRatingCount']->total_reviews .'  reviews.</p>';
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
                  
            <?php foreach($data['contentDetails'] as $content): ?>
                <form action="<?php echo URLROOT; ?>/customer/addContentReview" method="post">
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
                        <input type="hidden" name="content_id" value="<?php echo $content->content_id; ?>"> 
                    </div>
                    <?php if(isset($data['customer_id'])): ?>
                        <?php if ($content->customer_id == $data['customer_id']): ?>
                                <button type="submit" class="submit-review" onclick="giveerr()" >Submit</button>
                            <?php else: ?>
                                <button type="submit" class="submit-review">Submit</button>
                            <?php endif; ?>
                            </form>
                            <?php endif; ?>
                        <?php endforeach; ?>
                   
                </div>
            </div>
            <!-- <div class="sort-by-star">
                <form id="filterForm" action="<?php echo URLROOT; ?>/customer/viewcontent" method="post">
                    <select id="searchBy" name="category">
                        <option value="recent">Most recent</option>
                        <option value="relevant">Most relevant</option>
                    </select>
                    <button id="filterButton" >Apply Filter</button>
                </form>
            </div> -->
            <div class="cus-rev">
            <?php foreach($data['reviewDetails'] as $reviews): ?>
                <div class="reviews">
                    <div class="cus-name-img">
                        <img src="<?php echo URLROOT; ?>/assets/images/customer/ProfileImages/<?php echo $reviews->profile_img; ?>">
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
                        <?php if(isset($data['customer_id'])): ?>
                            <?php if ($reviews->customer_id == $data['customer_id']): ?>
                                <div>
                                    <a class ="reviewBtn" href="<?php echo URLROOT; ?>/customer/deleteReview/<?php echo $content->content_id; ?>/<?php echo $reviews->review_id; ?>">Delete</a>
                                
                                    <!-- <a class ="reviewBtn" href="#" class="update-review-link" data-review-id="<?php echo $reviews->review_id; ?>" data-content-id="<?php echo $content->content_id; ?>" onclick="openModal(<?php echo $reviews->review_id; ?>, <?php echo $content->content_id; ?>)">Update</a> -->
                            </div>

                           
                            <?php endif; ?>
                        <?php endif; ?>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>
        <div id="update-review-modal" class="modal">
       
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Update Review</h2>
                <form id="update-review-form" action="<?php echo URLROOT; ?>/customer/updateReview" method="post">
                    <input type="text" class="text" id="update-review-text" name="description"  placeholder="Update your review..." rows="4">
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
                            <input type="radio" class="radionBtn"  name="rate" id="rate-3" value="3">
                            <input type="radio" class="radionBtn" name="rate" id="rate-2" value="2">
                            <input type="radio" class="radionBtn"  name="rate" id="rate-1" value="1">
                            </div>
                        <input type="hidden" name="content_id" value="<?php echo $content->content_id; ?>">
                        <input type="hidden" name="review_id" value="<?php echo $reviews->review_id; ?>">
                        <input type="submit" class="confirm" value="Update">
                    </form>
                </div>       
            </div>
        <script>

        function openModal(reviewId, contentId) {
            document.getElementById('update-review-form').action = "<?php echo URLROOT; ?>/customer/updateReview/" + contentId + "/" + reviewId;
            document.getElementById('update-review-modal').style.display = 'block';
        }
        document.querySelectorAll('.update-review-link').forEach(link => {
            link.addEventListener('click', function() {
                const reviewId = this.dataset.reviewId;
                const contentId = this.dataset.contentId;
                openModal(reviewId, contentId); 
            });
        });

        function closeModal() {
            document.getElementById('update-review-modal').style.display = 'none';
        }
        function giveerr(){
            sweetError();
            // alert(" You cannot add reviews or ratings for your own content.");
            document.querySelector('.submit-review').setAttribute('disabled', 'disabled');
        }
        document.querySelectorAll('.helpful-button').forEach(button => {
            button.addEventListener('click', function() {
                const reviewId = this.dataset.reviewId;
                const isHelpful = this.dataset.action === 'helpful';

                fetch(`<?php echo URLROOT; ?>/customer/updateReviewHelpful?reviewId=${reviewId}&isHelpful=${isHelpful}`)
                    .then(response => {
                        if (response.ok) { 
                            this.disabled = true; // 
                            this.classList.add('clicked'); 
                        } else {
                            console.error('Failed to update review helpfulness');
                        }
                    })
                    .catch(error => {
                        console.error('Error updating review helpfulness:', error);
                    });
            });
        });
        function sweetError() {
      
              Swal.fire({
                  title: 'Error',
                  text: 'You cannot add reviews or ratings for your own content.',
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

// Sample data representing count and percentage for each rating
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
    // Initialize variables
    let pdf = null;
    let currentPageNumber = 1;
    const pdfViewer = document.getElementById('pdf-viewer');
    const prevPageButton = document.getElementById('prev-page');
    const nextPageButton = document.getElementById('next-page');

    // PDF.js rendering
    const pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';

    // Function to render a specific page
    function renderPage(pageNumber) {
        pdf.getPage(pageNumber).then(function(page) {
            // Get the viewport and calculate the scale
            const viewport = page.getViewport({ scale: 1 });
            const desiredWidth = 800; // Set your desired width here
            const desiredHeight = 600; // Set your desired height here
            const scale = Math.min(desiredWidth / viewport.width, desiredHeight / viewport.height);

            // Get the scaled viewport and set canvas dimensions
            const scaledViewport = page.getViewport({ scale: scale });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = scaledViewport.width;
            canvas.height = scaledViewport.height;

            const renderContext = {
                canvasContext: context,
                viewport: scaledViewport
            };

            page.render(renderContext).promise.then(function() {
                pdfViewer.innerHTML = ''; // Clear previous page
                pdfViewer.appendChild(canvas);
            });
        });
    }
    function loadPdf() {
        const pdfUrl = document.getElementById('pdf-url').value;
        // const pdfUrl='<?php echo URLROOT; ?>/assets/images/landing/addContents/1708867735pdf.pdf';
        console.log('pdfUrl:', pdfUrl); // Check if the URL is retrieved correctly
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdfDocument) {
            pdf = pdfDocument;
            renderPage(currentPageNumber);
        }).catch(function(error) {
            console.error('Error loading PDF:', error); // Log any errors that occur during PDF loading
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        loadPdf();
    });

    // Event listener for previous page button
    prevPageButton.addEventListener('click', function() {
        if (pdf && currentPageNumber > 1) {
            currentPageNumber--;
            renderPage(currentPageNumber);
        }
    });
    nextPageButton.addEventListener('click', function() {
        if (pdf && currentPageNumber < pdf.numPages) {
            currentPageNumber++;
            renderPage(currentPageNumber);
        }
    });
   

</script>
</body>
</html>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
