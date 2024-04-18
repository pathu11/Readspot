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
                    <h1>Ramath Perera &emsp;<img src="<?php echo URLROOT; ?>/assets/images/customer/hello.png"></h1>
                </div>
                <div class="total-income-point">
                    <div class="sub-total-div">
                        <h3>Total Income &emsp;<i class="fa fa-money" aria-hidden="true"></i></h3>
                        <h1>Rs 5472.00</h1>
                    </div>
                    <div class="sub-total-div">
                        <h3>Total Points &emsp;<i class="fa fa-star" aria-hidden="true"></i></h3>
                        <h1>12785</h1>
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
                    <h3>My current points</h3>
                    <div class="point-chart">
                        <canvas id="myDoughnutChart"></canvas>
                        <div class="centered-text">
                            <h1>560</h1>
                        </div>
                    </div>
                    <!-- <div class="point-chart no-details">
                        <h1>No Details</h1>
                    </div> -->
                </div>
            </div>
            <div class="add-buy-book">
                <div class="add-book-div">
                    <div class="no-of-books">
                        <h3>Add Used Books</h3>
                        <h3>21</h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Add Exchange Books</h3>
                        <h3>11</h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Add Contents</h3>
                        <h3>17</h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Add Events</h3>
                        <h3>2</h3>
                    </div>
                </div>
                <div class="add-book-div">
                    <div class="no-of-books">
                        <h3>Buy New Books</h3>
                        <h3>1</h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Buy Used Books</h3>
                        <h3>29</h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Exchange Books</h3>
                        <h3>16</h3>
                    </div>
                    <div class="no-of-books">
                        <h3>Donate Books</h3>
                        <h3>42</h3>
                    </div>
                </div>
            </div>
            <div class="category-summary">
                <div class="add-book-div">
                    <h3>Summary based on book Category (Add)</h3>
                    <div class="buy-chart">
                        <canvas id="myPieChart1"></canvas>
                    </div>
                    <!-- <div class="point-chart no-details">
                        <h1>No Details</h1>
                    </div> -->
                </div>
                <div class="add-book-div">
                    <h3>Summary based on book Category (Buy)</h3>
                    <div class="add-chart">
                        <canvas id="myPieChart2"></canvas>
                    </div>
                    <!-- <div class="point-chart no-details">
                        <h1>No Details</h1>
                    </div> -->
                </div>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>


    <script>
        // Data for the Doughnut chart
        var data = {
            labels: ['Book Content', 'Quiz'],
            datasets: [{
                data: [320, 240], // Sample data, you can replace it with your actual data
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
        // Sample data for book categories and number of books bought
        var data1 = {
            labels: ['Fiction', 'Non-fiction', 'Fantasy', 'Mystery', 'Science Fiction'],
            datasets: [{
                data: [20, 15, 10, 8, 12], // Sample data, replace it with actual data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Red color with opacity
                    'rgba(54, 162, 235, 0.5)', // Blue color with opacity
                    'rgba(255, 206, 86, 0.5)', // Yellow color with opacity
                    'rgba(75, 192, 192, 0.5)', // Green color with opacity
                    'rgba(153, 102, 255, 0.5)', // Purple color with opacity
                ],
                borderWidth: 1
            }]
        };

        var data2 = {
            labels: ['Fiction', 'Non-fiction', 'Fantasy'],
            datasets: [{
                data: [30, 20, 15], // Sample data, replace it with actual data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Red color with opacity
                    'rgba(54, 162, 235, 0.5)', // Blue color with opacity
                    'rgba(255, 206, 86, 0.5)', // Yellow color with opacity
                ],
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