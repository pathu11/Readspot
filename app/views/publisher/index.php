
<?php
    $title = "Index";  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher Home Page</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/homepage.css" />
</head>

<body>
    <?php require APPROOT . '/views/publisher/sidebar.php';?>
    <main class="dashboard">
        <section class="topic">
            <div class="head">
                <h2>Sales Analytics</h2>
                <p> &nbsp;&nbsp;&nbsp;Track your sales performance and discover trends</p>
            </div>
            <div class="drop">
                <label>Date range</label>
                <input type="date">
            </div>
        </section>
        <section class="summary">
            <div class="box total-orders">
                <p>Total Books</p>
                <h2 class="value">25 </span></h2>
            </div>
            <div class="box total-sales">
                <p>Total Orders</p>
                <h2 class="value">50</h2>
            </div>
            <div class="box books-added">
                <p>Total Income</p>
                <h2 class="value">LKR 12000</h2>
            </div>
        </section>
        <section class="charts">
            <div class="chart">
                <h4>Monthly Sales</h4>
                <canvas id="salesChart" ></canvas>
            </div>
            <div class="chart">
                <h4>Monthly Income</h4>
                <canvas id="incomeChart" ></canvas>
            </div>
        </section>
    </main>
    <script src="<?php echo URLROOT; ?>/assets/js/publisher/index.js"></script>
    
</body>

</html>

