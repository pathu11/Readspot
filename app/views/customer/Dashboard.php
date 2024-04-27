<?php
    $title = "Dashboard";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="prof-content">
            <div class="total-div">
                <div class="sub-total-div1">
                    <h3>Welcome Back,</h3>
                    <h1><?php echo $data['customer']; ?> &emsp;<img src="<?php echo URLROOT; ?>/assets/images/customer/hello.png"></h1>
                </div>
                <div class="total-income-point">
                    <div class="sub-total-div">
                        <h3>Total Income &emsp;<i class="fa fa-money" aria-hidden="true"></i></h3>
                        <h1>Rs <?php echo $data['paymentCount']; ?></h1>
                    </div>
                    <div class="sub-total-div">
                        <h3>Current Points &emsp;<i class="fa fa-star" aria-hidden="true"></i></h3>
                        <h1><?php echo $data['currentPoint']->redeem_points; ?></h1>
                    </div>
                </div>
            </div>
            <div class="point-div">
                <div class="add-book-div">
                    <h3>Points Earned in Last 30 Days</h3>
                    <div class="point-chart">
                        <canvas id="myLineChart"></canvas>
                    </div>
                    <!-- <div class="point-chart no-details">
                        <h1>No Details</h1>
                    </div> -->
                </div>
                <div class="add-book-div">
                    <h3>My Total points</h3>
                    <?php if (!empty($data['AddedCategories'])): ?>
                        <div class="point-chart">
                            <canvas id="myDoughnutChart"></canvas>
                            <div class="centered-text">
                                <h1><?php echo $data['totalPoints']; ?></h1>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="point-chart no-details">
                            <h1>No Details</h1>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="add-buy-book">
                <div class="add-book-div">
                    <div class="no-of-books">
                        <h3>Added Used Books</h3>
                        <h3><?php echo $data['used']; ?></h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Added Exchange Books</h3>
                        <h3><?php echo $data['exchange']; ?></h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Added Contents</h3>
                        <h3><?php echo $data['content']; ?></h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Added Events</h3>
                        <h3><?php echo $data['event']; ?></h3>
                    </div>
                </div>
                <div class="add-book-div">
                    <div class="no-of-books">
                        <h3>Bought New Books</h3>
                        <h3><?php echo $data['BuyNewBooks']; ?></h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Bought Used Books</h3>
                        <h3><?php echo $data['BuyUsedBooks']; ?></h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Saved Events</h3>
                        <h3><?php echo $data['saveEvents']; ?></h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Donated Books</h3>
                        <h3><?php echo $data['donateDetails']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="category-summary">
                <div class="add-book-div">
                    <h3>Summary based on book Category (Added)</h3>
                    <?php if (!empty($data['AddedCategories'])): ?>
                        <div class="buy-chart">
                            <canvas id="myPieChart1"></canvas>
                        </div>
                    <?php else: ?>
                        <div class="point-chart no-details">
                            <h1>No Details</h1>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="add-book-div">
                    <h3>Summary based on book Category (Bought)</h3>
                    <?php if (!empty($data['BoughtCategories'])): ?>
                        <div class="add-chart">
                            <canvas id="myPieChart2"></canvas>
                        </div>
                    <?php else: ?>
                        <div class="point-chart no-details">
                            <h1>No Details</h1>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>


    <?php
        // Convert PHP data to JavaScript-compatible format
        $categories2 = [];
        $bookCounts2 = [];
        foreach ($data['BoughtCategories'] as $category) {
            $categories2[] = $category->category;
            $bookCounts2[] = $category->book_count;
        }

        // Convert arrays to JSON format for JavaScript
        $categoriesJSON2 = json_encode($categories2);
        $bookCountsJSON2 = json_encode($bookCounts2);

        $categories1 = [];
        $bookCounts1 = [];
        foreach ($data['AddedCategories'] as $category) {
            $categories1[] = $category->category;
            $bookCounts1[] = $category->book_count;
        }

        // Convert arrays to JSON format for JavaScript
        $categoriesJSON1 = json_encode($categories1);
        $bookCountsJSON1 = json_encode($bookCounts1);

        $ChallengePoint = $data['challengePoints'];
        $ContentPoint = $data['contentPoints'];

        $ChallengePointJSON = json_encode($ChallengePoint);
        $ContentPointJSON = json_encode($ContentPoint);
    ?>

    <script>
        // Data for the Doughnut chart
        var ChallengePoint = <?php echo $ChallengePointJSON; ?>;
        var ContentPoint = <?php echo $ContentPointJSON; ?>;

        var data = {
            labels: ['Book Content', 'Quiz'],
            datasets: [{
                data: [ContentPoint, ChallengePoint], // Sample data, you can replace it with your actual data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Red color with opacity
                    'rgba(54, 162, 235, 0.5)', // Blue color with opacity
                ],
                borderWidth: 1
            }]
        };

        // Configuration options for the chart
        var options = {
            responsive: true,
            maintainAspectRatio: false
        };

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById('myDoughnutChart').getContext('2d');

        // Create the Doughnut chart
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
    </script>

    <script>
        function randomColor() {
            const r = Math.floor(Math.random() * 256); // Random red component
            const g = Math.floor(Math.random() * 256); // Random green component
            const b = Math.floor(Math.random() * 256); // Random blue component
            const a = 0.5; // Opacity (you can adjust this as needed)
            return `rgba(${r}, ${g}, ${b}, ${a})`;
        }

        // Sample data for book categories and number of books bought
        var categories1 = <?php echo $categoriesJSON1; ?>;
        var bookCounts1 = <?php echo $bookCountsJSON1; ?>;

        const backgroundColor1 = categories1.map(() => randomColor());
        var data1 = {
            labels: categories1,
            datasets: [{
                data: bookCounts1, // Sample data, replace it with actual data
                backgroundColor: backgroundColor1,
                borderWidth: 1
            }]
        };


        var categories2 = <?php echo $categoriesJSON2; ?>;
        var bookCounts2 = <?php echo $bookCountsJSON2; ?>;
       
        const backgroundColor2 = categories2.map(() => randomColor());
        var data2 = {
            labels: categories2,
            datasets: [{
                data: bookCounts2,
                backgroundColor: backgroundColor2,
                borderWidth: 1
            }]
        };

        // Configuration options for the charts
        var options = {
            responsive: true,
            maintainAspectRatio: false
        };

        // Get the context of the first canvas element
        var ctx1 = document.getElementById('myPieChart1').getContext('2d');

        // Create the first Pie chart
        var myPieChart1 = new Chart(ctx1, {
            type: 'pie',
            data: data1,
            options: options
        });

        // Get the context of the second canvas element
        var ctx2 = document.getElementById('myPieChart2').getContext('2d');

        // Create the second Pie chart
        var myPieChart2 = new Chart(ctx2, {
            type: 'pie',
            data: data2,
            options: options
        });

        // const colors = [
        //     'rgba(255, 99, 132, 0.5)', // Red color with opacity
        //     'rgba(54, 162, 235, 0.5)', // Blue color with opacity
        //     'rgba(255, 206, 86, 0.5)', // Yellow color with opacity
        //     'rgba(75, 192, 192, 0.5)', // Green color with opacity
        //     'rgba(153, 102, 255, 0.5)', // Purple color with opacity
        //     // Add more colors as needed
        // ];
    </script>

<script>
        // Sample data for points earned in the last 30 days
        var data = {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7', 'Day 8', 'Day 9', 'Day 10', 'Day 11', 'Day 12', 'Day 13', 'Day 14', 'Day 15', 'Day 16', 'Day 17', 'Day 18', 'Day 19', 'Day 20', 'Day 21', 'Day 22', 'Day 23', 'Day 24', 'Day 25', 'Day 26', 'Day 27', 'Day 28', 'Day 29', 'Day 30'],
            datasets: [{
                label: 'Points Earned',
                data: [50, 160, 55, 80, 100, 80, 75, 10, 125, 100, 95, 110, 205, 220, 245, 260, 125, 140, 135, 110, 90, 0, 0, 0, 15, 180, 175, 290, 300, 20], // Sample data, replace it with actual data
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        // Configuration options for the chart
        var options = {
            responsive: true,
            maintainAspectRatio: false
        };

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById('myLineChart').getContext('2d');

        // Create the Line chart
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>