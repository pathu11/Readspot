<?php
    $title = "View Contents";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

</head>
<?php foreach($data['contentDetails'] as $content): ?>
    <div class="main-content-div">
    
        <h1 class="cont-topic"><?php echo $content->topic; ?></h1>
    <div class="img-summary">
        <img src="<?php echo URLROOT; ?>/assets/images/landing/addcontents/<?php echo $content->img; ?>" alt="Book3" class="content-img-main"> <!--path changed -->
       <div>
         <p><?php echo $content->text; ?></p>
       </div>
    </div>
        <div class="cont-details">
            
            <div id="pdf-viewer"></div>
            <button id="prev-page">Previous Page</button>
            <button id="next-page">Next Page</button>
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
                        echo '<p>' . $data['averageRatingCount']->average_rating . ' average based on 254 reviews.</p>';
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
                    <div class="post">
                        <div class="text">Thanks for rating us!</div>
                        <div class="edit">EDIT</div>
                    </div>
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
                        <input type="hidden" name="content_id" value="4"> <!-- Pass the content_id here -->
                       
                    </div>
                    <button type="submit" class="submit-review">Submit</button>
                    </form>
                </div>
               

            </div>
            
            <div class="sort-by-star">
                <select id="searchBy"  name="category">
                    <option value="technology">Most relevant</option>
                    <option value="travel">Most recent</option>
                </select>
            </div>
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
                        <!-- <img src="<?php echo URLROOT; ?>/assets/images/customer/starts.png"> -->
                        <h6><?php echo $reviews->time; ?></h6>
                    </div>
                    <p><?php echo $reviews->review; ?></p>
                    <div class="helpful">
                        <h4>Was this review helpful?</h4>
                        <div class="yes-no">
                            <h3>Yes</h3>
                            <h3>No</h3>
                        </div>
                    </div>
                    <h5>13 people found this helpful</h5>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>
    
    <script>
        // Sample data representing count and percentage for each rating
// Sample data representing count and percentage for each rating
const ratingData = [
    { rating: '1 Star', count: 10, percentage: 20 },
    { rating: '2 Star', count: 20, percentage: 40 },
    { rating: '3 Star', count: 15, percentage: 30 },
    { rating: '4 Star', count: 5, percentage: 10 },
    { rating: '5 Star', count: 2, percentage: 4 }
];

// Get the canvas element
const ctx = document.getElementById('ratingChart').getContext('2d');

// Generate labels, data, and colors from the rating data
const labels = ratingData.map(data => data.rating);
const counts = ratingData.map(data => data.count);
const percentages = ratingData.map(data => data.percentage);
const colors = ['#ff0000', '#ff6600', '#ffcc00', '#99ff00', '#00ff00']; // Customize colors as needed

// Create the chart
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Count',
            data: counts,
            backgroundColor: colors,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
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
        // PDF.js script
        // URL of the PDF file
        var pdfUrl = '<?php echo URLROOT; ?>/assets/images/customer/orderRecipt/my.pdf';
        var currentPage = 1; 
        function renderPage(pageNumber) {
            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                // Check if the page number is within the bounds
                if (pageNumber >= 1 && pageNumber <= pdf.numPages) {
                    pdf.getPage(pageNumber).then(function(page) {
                        var scale = 1.5;
                        var viewport = page.getViewport({ scale: scale });

                        // Prepare canvas using PDF page dimensions
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        // Render PDF page into canvas context
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext).promise.then(function() {
                            // Clear previous content before appending new page
                            document.getElementById('pdf-viewer').innerHTML = '';
                            document.getElementById('pdf-viewer').appendChild(canvas);
                        });
                    });
                }
            });
        }

        // Initial render of the first page
        renderPage(currentPage);

        // Event listener for next page button
        document.getElementById('next-page').addEventListener('click', function() {
            currentPage++; // Increment current page
            renderPage(currentPage); // Render the next page
        });

        // Event listener for previous page button
        document.getElementById('prev-page').addEventListener('click', function() {
            currentPage--; // Decrement current page
            renderPage(currentPage); // Render the previous page
        });
    </script>
</body>
</html>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
