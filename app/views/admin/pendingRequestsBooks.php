<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<body>
 
<?php require APPROOT . '/views/admin/nav.php';?>
  <div class="nav-container1">
    <a href="<?php echo URLROOT; ?>/admin/pendingRequestsPub">Pending Registration Requests > </a>
    <a href="<?php echo URLROOT; ?>/admin/pendingRequestsBooks" class="active1">Pending Books</a> 
  </div>

  <div class="table-container" >

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
           
    <?php foreach($data['pendingBookDetails'] as $book): ?>
    <tr>
        <td><?php echo $book->book_name; ?></td>
        <td><?php echo $book->author; ?></td>
        <td><?php echo $book->price; ?></td>
        <td><?php echo $book->price_type; ?></td>
        <td><?php echo $book->condition; ?></td>
        <td><?php echo $book->name; ?></td>
        <td><?php echo $book->email; ?></td>
        <td><img src="<?php echo URLROOT;?>/assets/images/customer/AddUsedBook/<?php echo $book->img1;?>" onclick="viewEvent(this.src)" width=30%></td>
        <td><img src="<?php echo URLROOT;?>/assets/images/customer/AddUsedBook/<?php echo $book->img2;?>" onclick="viewEvent(this.src)" width=30%></td>
        <td><img src="<?php echo URLROOT;?>/assets/images/customer/AddUsedBook/<?php echo $book->img3;?>" onclick="viewEvent(this.src)" width=30%></td>
        
        <td><button onclick="showAcceptPopup()">Accept</button>
        <button onclick="showRejectPopup()" style="background-color: rgb(200, 84, 84);">Reject</button></td>
        
    </tr>
<?php endforeach; ?>               
        </table>
        
    </div>

        <div id="acceptPopup" class="modal">
            <div class="modal-content">
                <span class="close" onclick="hidePopup('acceptPopup')">&times;</span>
                <p>Send approval email to the seller.</p>
                <a href="<?php echo URLROOT;?>/admin/approveBook"><button>Confirm</button></a>
            </div>
        </div>

        <div id="rejectPopup" class="modal">
            <div class="modal-content">
                <span class="close" onclick="hidePopup('rejectPopup')">&times;</span>
                <p>Reason for rejection:</p>
                <textarea id="rejectReason" rows="4" cols="50"></textarea>
                <button onclick="sendRejectionEmail()">Send Rejection Email</button>
            </div>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Poster Details</h2>
                <table id="eventDetailsTable">
                    <!-- Event details will go here -->
                </table>
            </div>
        </div>

    <script src="<?php echo URLROOT;?>/assets/js/admin/table.js"></script>
   
</body>

</html>
