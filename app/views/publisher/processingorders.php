
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
        <input type="text" id="live-search" autocomplete="off" placeholder="Tracking Number" class="search-bar"><button id="search-button" class="search-button">Search by Tracking Number</button>
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
            $('#search-button').on('click', function () {
                var trackingNumber = $('#live-search').val();
                $.ajax({
                    url: '<?php echo URLROOT; ?>/publisher/FindOrdersByTracking',
                    type: 'POST',
                    data: { tracking_no: trackingNumber },
                    dataType: 'json',
                    success: function (response) {
                    console.log(response);
                    console.log(response[0].order_id);

                        if (response.error) {
                            console.log(response.error);
                        } else {
                            $('#searchresult').html(`
                            <div class="order-container">
                            <h3>Order details</h3>
                                <div class="order">
                                    
                                    <div class="col1">
                                        <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/${response[0].img1}"  width="180px">
                                        <img src="<?php echo URLROOT; ?>/assets/images/publisher/addBooks/${response[0].img2}"  width="180px">
                                    </div>
                                    <div class="col2">
                                        <p>Tracking Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  ${response[0].tracking_no}</p>
                                        <p>Book Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  ${response[0].book_name}</p>
                                        <p>No of books &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  ${response[0].quantity}</p>
                                        <p>Total Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  ${response[0].total_price}</p>
                                        <p>Payment Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  ${response[0].payment_type}</p>
                                        <p>Delivery Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>${response[0].status}</b></p>
                                        <hr>
                                        <p>This order was ordered by &nbsp;&nbsp;:&nbsp;&nbsp;${response[0].receiver_postal_name}</p>
                                        <div style="align-items: center;"<p> from :</p>
                                        <em><p>${response[0].receiver_street_name},
                                        ${response[0].receiver_town},
                                        ${response[0].receiver_district},
                                        ${response[0].receiver_postal_code}<p></em></div>

                                    </div>
                                </div>
                            </div>
                            `);
                        }
                    },
                    error: function () {
                        console.log('Error fetching order details.');
                    }
                });
            });
        });
    </script>

</html>

