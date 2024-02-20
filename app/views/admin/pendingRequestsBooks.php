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
    <div class="nav-container1">
        <a href="<?php echo URLROOT; ?>/admin/pendingRequestsPub">Pending Registration Requests > </a>
        <a href="<?php echo URLROOT; ?>/admin/pendingRequestsBooks" class="active1">Pending Books</a>
    </div>

    <div class="table-container">

        <table>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Price</th>
                <th>Price Type</th>
                <th>Condition</th>
                <th>Seller name</th>
                <th>Seller Email</th>
                <th>Front Page</th>
                <th>Back Page</th>
                <th>Inside Page</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($data['pendingBookDetails'] as $book) : ?>
                <tr>
                    <td><?php echo $book->book_name; ?></td>
                    <td><?php echo $book->author; ?></td>
                    <td><?php echo $book->price; ?></td>
                    <td><?php echo $book->price_type; ?></td>
                    <td><?php echo $book->condition; ?></td>
                    <td><?php echo $book->name; ?></td>
                    <td><?php echo $book->email; ?></td>
                    <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddUsedBook/<?php echo $book->img1; ?>" onclick="viewEvent(this.src)" width=30%></td>
                    <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddUsedBook/<?php echo $book->img2; ?>" onclick="viewEvent(this.src)" width=30%></td>
                    <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddUsedBook/<?php echo $book->img3; ?>" onclick="viewEvent(this.src)" width=30%></td>

                    <td>
                        <button onclick="showAcceptPopup('<?php echo $book->customer_id; ?>')">Accept</button>
                        <button onclick="showRejectPopup('<?php echo $book->customer_id; ?>')" style="background-color: rgb(200, 84, 84);">Reject</button>
                    </td>


                </tr>
                <div id="acceptPopup_<?php echo $book->customer_id; ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hidePopup('acceptPopup_<?php echo $book->customer_id; ?>')">&times;</span>
                        <p>Send approval email to the seller.</p>
                        <a href="<?php echo URLROOT; ?>/admin/approveBook/<?php echo $book->customer_id; ?>"><button>Confirm</button></a>
                    </div>
                </div>

                <div id="rejectPopup_<?php echo $book->customer_id; ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hidePopup('rejectPopup_<?php echo $book->customer_id; ?>')">&times;</span>
                        <p>Reason for rejection:</p>
                         
                            <textarea id="rejectReason" name="rejectReason" rows="4" cols="50" autocomplete="off"></textarea>
                            <button id="sendRejectEmail_<?php echo $book->customer_id; ?>" onclick="sendRejectEmail(<?php echo $book->customer_id;?>)">Send Rejection Email</button>

                    </div>
                </div>

            <?php endforeach; ?>
        </table>

    </div>

    <!--image div-->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Poster Details</h2>
            <table id="eventDetailsTable">
                <!-- Event details will go here-->
            </table>
        </div>
    </div>

    <script src="<?php echo URLROOT; ?>/assets/js/admin/table.js"></script>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#rejectForm').submit(function(event) {
    //         // Prevent default form submission
    //         event.preventDefault();

    //         // Get the value of the textarea
    //         var rejectReason = $('#rejectReason').val();
    //         console.log(rejectReason);

    //         // Make AJAX request
    //         $.ajax({
    //             type: 'POST',
    //             url: 'http://localhost/readspot/admin/rejectBook/<?php echo $book->customer_id; ?>',
    //             data: {
    //                 rejectReason: rejectReason
    //             }, // Send the rejection reason as data
    //             success: function(response) {
    //                 // Handle successful response
    //                 console.log(response);
    //                 // Optionally, hide the modal or perform any other action
    //             },
    //             error: function(xhr, status, error) {
    //                 // Handle error
    //                 console.error('AJAX request failed: ' + status + ', ' + error);
    //             }
    //         });
    //     });
    // });


    function sendRejectEmail(customer_id) {
    // Get the value of the textarea relative to the button clicked
    var rejectReason = $('#rejectPopup_' + customer_id).find('#rejectReason').val();
    console.log(rejectReason);
    console.log(customer_id);

    // Make AJAX request
    $.ajax({
        url:'<?php echo URLROOT;?>/admin/rejectBook',
        method:'post',
        data: { rejectReason: rejectReason, customer_id:customer_id },
        success: function(response) {
            // Handle successful response
            console.log('Email sent successfully');
            // Optionally, perform any other action
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('AJAX request failed: ' + status + ', ' + error);
        }
    });
}


</script>

</html>