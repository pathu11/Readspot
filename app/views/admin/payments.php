<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php require APPROOT . '/views/admin/nav.php'; ?>
    <br><br><br>
    <div class="table-container">
        <table>
            <tr>
                <th>Order Id</th>
                <th>Book Id</th>
                <th>Tracking Number</th>
                <th>Publisher Details</th>
                <th>Total Price</th>
                <th>Tax</th>
                <th>Sending Price for Seller</th>
                <th>Actions</th>
            </tr>
            <?php foreach($data['paymentsDetails'] as $payment): ?>
                <tr>
                    <td><?php echo $payment->order_id; ?></td>
                    <td><?php echo $payment->book_id; ?></td>
                    <td><?php echo $payment->tracking_no; ?></td>
                    <td><?php echo $payment->user_name; ?></td>
                    <td><?php echo $payment->book_price; ?></td>
                    <td><?php echo $payment->tax; ?></td>
                    <td><?php echo $payment->paid_price; ?></td>
                    <td>
                        <button onclick="showConfirmation(<?php echo htmlentities(json_encode($payment)); ?>)">Send Payment</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="popup-overlay" style="display: none;">
            <div class="popup-content">
                <span class="close-icon" onclick="closePopup()">&times;</span>
                <p>Are you sure you want to send payment to the publisher?</p>
                <button onclick="sendPayment(paymentDetails)">Yes</button>
                <button onclick="closePopup()">No</button>
            </div>
        </div>
        <div class="success-popup" style="display: none;">
            <div class="popup-content">
                <span class="close-icon" onclick="closeSuccessPopup()">&times;</span>
                <p>Payment is successfully sent to the relevant seller</p>
                <button onclick="closeSuccessPopup()">OK</button>
            </div>
        </div>
    </div>
</body>
<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var paymentDetails;

    function showConfirmation(payment) {
        paymentDetails = payment;
        $('.popup-overlay').show();
    }

    function sendPayment(paymentDetails) {
        console.log(paymentDetails);
        $.ajax({
            url: '<?php echo URLROOT; ?>/admin/sendPayment',
            type: 'POST',
            dataType: 'json',
            data: { paymentDetails: paymentDetails },
            success: function(response) {
                console.log('Payment sent successfully');
                console.log(response); // Log response for debugging
                $('.popup-overlay').hide();
                $('.success-popup').show();
            },
            error: function(xhr, status, error) {
                console.error('Error sending payment:', error);
            }
        });
    }

    function closePopup() {
        $('.popup-overlay').hide();
    }

    function closeSuccessPopup() {
        $('.success-popup').hide();
    }
</script>
</html>
