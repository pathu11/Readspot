
<?php
    $title = "Processing  Orders";
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Pending Orders</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/orders.css" />

</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
<a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a>
<?php   require APPROOT . '/views/publisher/subnav.php';?>
    <div class="div_table" style="width:90%">
    <p> Processing Orders >></p>
    
        <table>
            <tr>
                <th style="width:7%;background-color: #009D94;">Order ID</th>
                <th style="width:7%;background-color: #009D94;">Book ID</th>
                <th style="width:7%;background-color: #009D94;">No of Items</th>
                <th style="width:7%;background-color: #009D94;">Customer Details</th>
                <th style="width:7%;background-color: #009D94;">Total Price(Rs)</th>
               

            </tr>
            <?php foreach($data['orderDetails'] as $orderDetails): ?>
            <tr>
                <th style="width:7%"><?php echo $orderDetails->order_id; ?></th>
                <th style="width:7%"><?php echo $orderDetails->book_id; ?></th>
                <th style="width:7%"><?php echo $orderDetails->quantity; ?></th>
                <th style="width:7%"><?php echo $data['customerName']; ?></th>
                <th style="width:7%"><?php echo $orderDetails->total_price; ?></th>
                
                
            </tr>
            <?php endforeach; ?> 

        </table>
    </div>
    <div class="search-container1">
        <input type="text" id="live-search" autocomplete="off" placeholder="Track Number" class="search-bar"><button id="search-button" class="search-button">Search by Tracking Number</button>
    </div>
    <div id="searchresult"></div>
   





</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function () {
    // Attach an event listener to the search button
    $('#search-button').on('click', function () {
        // Get the tracking number from the input field
        var trackingNumber = $('#live-search').val();

        // Make an AJAX request
        $.ajax({
            url: '<?php echo URLROOT; ?>/publisher/FindOrdersByTracking',
            type: 'POST',
            data: { tracking_no: trackingNumber },
            dataType: 'json',
            success: function (response) {
                // Update the content of the searchresult div with the fetched order details
                if (response.error) {
                    // Handle errors if needed
                    console.log(response.error);
                } else {
                    // Update the content of the searchresult div with the order details
                    $('#searchresult').html(`
                        <table>
                            <tr>
                                <th style="width:7%;background-color: #009D94;">Order ID</th>
                                <th style="width:7%;background-color: #009D94;">Book ID</th>
                                <th style="width:7%;background-color: #009D94;">No of Items</th>
                                <th style="width:7%;background-color: #009D94;">Customer Details</th>
                                <th style="width:7%;background-color: #009D94;">Total Price(Rs)</th>
                            </tr>
                            <tr>
                                <th style="width:7%">${response[0].order_id}</th>
                                <th style="width:7%">${response[0].book_id}</th>
                                <th style="width:7%">${response[0].quantity}</th>
                                <th style="width:7%">${response[0].customer_name}</th>
                                <th style="width:7%">${response[0].total_price}</th>
                            </tr>
                        </table>
                    `);
                }
            },
            error: function () {
                // Handle errors if needed
                console.log('Error fetching order details.');
            }
        });
    });
});
</script>


</html>

