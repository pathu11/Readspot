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
        <!-- <a href="<?php echo URLROOT; ?>/admin/pendingRequestsPub">Pending Registration Requests > </a> -->
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
                    <?php if($book->type =='used'): ?>
                        <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddUsedBook/<?php echo $book->img1; ?>" onclick="viewEvent(this.src)" width=30%></td>
                        <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddUsedBook/<?php echo $book->img2; ?>" onclick="viewEvent(this.src)" width=30%></td>
                        <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddUsedBook/<?php echo $book->img3; ?>" onclick="viewEvent(this.src)" width=30%></td>
                    <?php endif;?>

                    <?php if($book->type =='exchanged'): ?>
                        <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddExchangeBook/<?php echo $book->img1; ?>" onclick="viewEvent(this.src)" width=30%></td>
                        <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddExchangeBook/<?php echo $book->img2; ?>" onclick="viewEvent(this.src)" width=30%></td>
                        <td><img src="<?php echo URLROOT; ?>/assets/images/customer/AddExchangeBook/<?php echo $book->img3; ?>" onclick="viewEvent(this.src)" width=30%></td>
                    <?php endif;?>


                    <td>
                        <button onclick="showAcceptPopup('<?php echo $book->book_id; ?>')">Accept</button>
                        <button onclick="showRejectPopup('<?php echo $book->customer_id; ?>','<?php echo $book->book_id;?>')" style="background-color: rgb(200, 84, 84);">Reject</button>
                    </td>


                </tr>
                <!-- <div id="acceptPopup_<?php echo $book->book_id; ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hidePopup('acceptPopup_<?php echo $book->book_id; ?>')">&times;</span>
                        <p>Send approval email to the seller.</p>
                        <a href="<?php echo URLROOT; ?>/admin/approveBook/<?php echo $book->book_id; ?>"><button>Confirm</button></a>
                    </div>
                </div> -->

                <!-- <div id="rejectPopup_<?php echo $book->customer_id; ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hidePopup('rejectPopup_<?php echo $book->customer_id; ?>')">&times;</span>
                        <p>Reason for rejection:</p>
                         
                            <textarea id="rejectReason" name="rejectReason" rows="4" cols="50" autocomplete="off"></textarea>
                            <button id="sendRejectEmail_<?php echo $book->customer_id; ?>" onclick="sendRejectEmail(<?php echo $book->customer_id;?>)">Send Rejection Email</button>

                    </div>
                </div> -->

            <?php endforeach; ?>
        </table>

    </div>

    <!--image div-->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Poster Details</h2>
            <img id="large-event-poster" width="60%"/>
        </div>
    </div>

    <div id="myModal1" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Approve Event</h2>
        <table id="eventApprovalTable">
            <!-- Event details will go here -->
        </table>
      </div>
    </div>

    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add Reject Reason</h2>
            <form action="<?php echo URLROOT;?>/admin/rejectBook" method="post">
                <textarea id="rejectReason" name="rejectReason" rows="4" cols="50" placeholder="Enter reject reason..."></textarea>
                <input type="hidden" id="customer_id" name="customer_id">
                <input type="hidden" id="book_id" name="book_id">
                <button type="submit">Send Rejection Email</button>
            </form>
        </div>
    </div>

    <script>
        function viewEvent(imgLink){
            document.getElementById("large-event-poster").src = imgLink;
            document.getElementById("myModal").style.display = "block";
        }

        function showRejectPopup(customer_id,book_id){
            document.getElementById("customer_id").value = customer_id;
            document.getElementById("book_id").value = book_id;
            document.getElementById("myModal2").style.display = "block";
        }

        function showAcceptPopup(book_id){
            var approval = '<p>Send approval email</p><br> <a href="<?php echo URLROOT;?>/admin/approveBook/'+`${book_id}`+'"</a><button>Send</button></a>';
            var eventApproval = document.getElementById("eventApprovalTable");
            eventApproval.innerHTML = approval;
            document.getElementById("myModal1").style.display = "block";
        }

        function closeModal(){
            document.getElementById("myModal").style.display = "none";
            document.getElementById("myModal1").style.display = "none";
            document.getElementById("myModal2").style.display = "none";
        }

    </script>


</body>
</html>