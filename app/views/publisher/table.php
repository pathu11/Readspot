<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
    <script src="<?php echo URLROOT; ?>/assets/js/publisher/table.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
<?php require APPROOT . '/views/publisher/subnav.php'; ?>
    <div class="container">
        <h2>EVENTS INFO ></h2>

       
        <table id="eventTable">
            <input type="text" id="searchInput" placeholder="Search by ID or Name" oninput="searchEvents()">
            <thead>
                <tr>
                    <th>Tracking Number</th>
                    <th>Book ID</th>
                    <th>No of Items</th>
                    <th>Customer Details</th>
                    <th>Total Price(Rs)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['orderDetails'] as $orderDetails) : ?>
                    <tr>
                        <th ><?php echo $orderDetails->tracking_no; ?></th>
                        <th ><?php echo $orderDetails->book_id; ?></th>
                        <th ><?php echo $orderDetails->quantity; ?></th>
                        <th ><?php echo $data['customerName']; ?></th>
                        <th ><?php echo $orderDetails->total_price; ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <ul class="pagination" id="pagination">
            <li id="prevButton">«</li>
            <li class="current">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>6</li>
            <li>7</li>
            <li>8</li>
            <li>9</li>
            <li>10</li>
            <li id="nextButton">»</li>
        </ul>
        <div class="button-container">
            <button id="addEventBtn" onclick="redirectToAddEvent()">ADD</button>
        </div>
    </div>
    <script src="eventscript.js"></script>
</body>

</html>
