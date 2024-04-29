

<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Processing Orders</title>
   
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>

<div class="all">
    <div class="container">
        <div class="nav">
            <a href="<?php echo URLROOT; ?>/publisher/processingorders">Processing Orders</a>
            <a href="<?php echo URLROOT; ?>/publisher/shippedorders">Shipped Orders</a>
            <a href="<?php echo URLROOT; ?>/publisher/deliveredorders">Delivered Orders</a>
            <a href="<?php echo URLROOT; ?>/publisher/returnedorders">Returned Orders</a>
        </div>
    
        <p> Processing Orders >></p>
        
            <table id="eventTable">
            <?php if(empty($data['orderDetails'] )): ?>
                    <?php echo '<h3 style="text-align:center;">No Orders Found</h3>'; ?>
                        <?php else : ?>
            <div class="search-container1">
                <input type="text" id="live-search" autocomplete="off" placeholder="Tracking Number" class="search-bar"><button id="search-button" class="search-button">Search by Tracking Number</button>
            </div>
            <thead>
                <tr>
                    <th >Tracking Number</th>
                    <th >Book ID</th>
                    <th >No of Items</th>
                    <th >Customer Details</th>
                    <th >Total Cost(Rs)</th>
                    <th >Total Delivery Fee(Rs)</th>
                    <th >Total Income(Rs)</th>
                    <th class="view-details-column">View</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data['orderDetails'] as $orderDetails): ?>
                <tr>
                    <td ><?php echo $orderDetails->tracking_no; ?></td>
                    <td ><?php echo $orderDetails->book_id; ?></td>
                    <td ><?php echo $orderDetails->quantity; ?></td>
                    <td ><?php echo $data['customerName']; ?></td>
                    <td ><?php echo $orderDetails->total_price; ?></td>
                    <td ><?php echo $orderDetails->total_delivery; ?></td>
                    <td ><?php echo $orderDetails->total_price - $orderDetails->total_delivery; ?></td>               
                    <td class="view-details-column">
                    <button class="view-order-button" data-tracking="<?php echo $orderDetails->tracking_no; ?>">View </button>

                    </td>

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
            <?php endif;?>
            <div id="myModal" class="modal">
                <div class="modal-content-orders" style="width: 70%; height: 600px; overflow-y: auto;">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Order Details</h2>
                    <div id="searchresult"></div>
                </div>
            </div>
            
            <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
    </div>
    <?php
            require APPROOT . '/views/publisher/footer.php'; //path changed
        ?>
</div>     

</body>
<script>
        function goBack() {
            window.history.back();
        }
        
    </script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
        $(document).ready(function () {
    $('#search-button').on('click', function () {
        var trackingNumber = $('#live-search').val();
        $.ajax({
            url: '<?php echo URLROOT; ?>/publisher/FindOrdersByTracking',
            type: 'POST',
            data: { tracking_no: trackingNumber },
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (response.error) {
                    console.log(response.error);
                } else {
                    displaySearchResults(response);
                }
            },
            error: function () {
                console.log('Error fetching order details.');
            }
        });
    });
});
$(document).ready(function () {
    $('.view-order-button').on('click', function () {
        var trackingNumber = $(this).data('tracking');
        $.ajax({
            url: '<?php echo URLROOT; ?>/publisher/FindOrdersByTracking',
            type: 'POST',
            data: { tracking_no: trackingNumber },
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (response.error) {
                    console.log(response.error);
                } else {
                    displaySearchResults(response);
                }
            },
            error: function () {
                console.log('Error fetching order details.');
            }
        });
    });
});


function displaySearchResults(response) {
    var searchresult = $('#searchresult');
    searchresult.empty();

    if (response.length > 0) {
        for (var i = 0; i < response.length; i++) {
            searchresult.append(`
                <div class="order-container" >
                    
                    
                    <div class="order">
                    <div class="col1">
                            <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/${response[i].img1}" width="180px">
                            <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/${response[i].img2}" width="180px">
                        </div>
                        <div class="col2">
                        <br><br>
                            <table>
                                <tr>
                                    <td>Tracking Number</td>
                                    <td>${response[i].tracking_no}</td>
                                </tr>
                                <tr>
                                    <td>Book Name</td>
                                    <td>${response[i].book_name}</td>
                                </tr>
                                <tr>
                                    <td>No of books</td>
                                    <td>${response[i].quantity}</td>
                                </tr>
                                <tr>
                                    <td>Total Price</td>
                                    <td>${response[i].total_price}</td>
                                </tr>
                                <tr>
                                    <td>Payment Type</td>
                                    <td>${response[i].payment_type}</td>
                                </tr>
                                <tr>
                                    <td>Delivery Status</td>
                                    <td><b>${response[i].status}</b></td>
                                </tr>
                            </table>
                            <hr>
                            <p>This order was ordered by: ${response[i].receiver_postal_name}</p>
                            <div style="align-items: center;">
                               
                                <em>
                                    <p> from:${response[i].receiver_street_name},
                                    ${response[i].receiver_town},
                                    ${response[i].receiver_district},
                                    ${response[i].receiver_postal_code}</p>
                                </em>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        }
    } else {
        searchresult.append('<p>No matching orders found.</p>');
    }

    // Show the modal after updating the content
    document.getElementById("myModal").style.display = "block";
}


    </script>
</html>
