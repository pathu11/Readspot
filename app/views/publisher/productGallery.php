
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
  <title>Books</title>
</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
<!-- <a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a> -->
    <div class="container">

        <table id="eventTable" class="responsive-table">
            <h2>Books Details</h2>
        <thead>
            <tr>
                
                <th >Book Name</th>
               
                <th >Author</th>
                <th >Price</th>
                <th >Category</th>
               
                <th >No of Books</th>
                <th >Description</th>
                <th >Cover Image</th>
                <th >Inside Image</th>
                
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach($data['bookDetails'] as $bookDetails): ?>
            <tr>
                <!-- <th style="width:7%"><?php echo $bookDetails->book_id; ?></th> -->
                <td ><?php echo $bookDetails->book_name; ?></td>
                <!-- <th style="width:7%"><?php echo $bookDetails->ISBN_no; ?></th> -->
                <td ><?php echo $bookDetails->author; ?></td>
                <td ><?php echo $bookDetails->price; ?></td>
                <td ><?php echo $bookDetails->category; ?></td>
                
                <td ><?php echo $bookDetails->quantity; ?></td>
                <td ><?php echo $bookDetails->descript; ?></td>

                <td ><?php echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $bookDetails->img1 . '" alt="img1" style="width:30%;" onclick="viewImage(this.src)"> ';?></th>
                <td ><?php echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $bookDetails->img2 . '" alt="img2" style="width:30%;" onclick="viewImage(this.src)"> ';?></th>
                <td >
                    <a href='#' onclick='viewBookOnly(<?php echo htmlspecialchars(json_encode($bookDetails)); ?>)'>
                    <i class="fas fa-eye"></i>
                    </a>
                    <a  href='<?php echo URLROOT; ?>/NewBooks/update/<?php echo $bookDetails->book_id; ?>'><i class='fa fa-edit' style='color:#09514C;'></i></a>
                    
                    <a  href='#' onclick='confirmDelete(<?php echo $bookDetails->book_id; ?>)'  ><i class='fa fa-trash'></i></a>

            </td>
                
            </tr>
                <?php endforeach; ?>
            </tbody>         
        </table><br>
        
        <div id="myModalImage" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModalImage()">&times;</span>
                <h2>Image</h2>
                <table id="eventDetailsTable">
                    <!-- Event details will go here -->
                </table>
            </div>
        </div>
        <div id="confirmationModal" class="bookDetails">
            <div class="modal-content">
            <span class="close" onclick="closeConfirmationModal()">&times;</span>
            <h2>Confirmation</h2>
            <p>Are you sure you want to delete this store?</p>
            <button onclick="proceedDelete(<?php echo $bookDetails->book_id; ?>)">Yes</button>
            <button onclick="closeConfirmationModal()">No</button>
            </div>
        </div>
            

        <!-- view details -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Book Details</h2>
                <table id="bookDetailsTable">
                    <!-- Event details will go here -->
                </table>
            </div>
        </div>
        
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
            <a href="<?php echo URLROOT; ?>/NewBooks/addbooks"><button>Add a Books</button></a>

            
        </div>
        </div>
        <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
    </div>
    <?php
            require APPROOT . '/views/publisher/footer.php'; //path changed
        ?>

    </body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        function confirmDelete(storeId) {
          var confirmationModal = document.getElementById("confirmationModal");
          confirmationModal.style.display = "block";
        }

        function closeConfirmationModal() {
          var confirmationModal = document.getElementById("confirmationModal");
          confirmationModal.style.display = "none";
        }

        function proceedDelete(storeId) {
          window.location.href = '<?php echo URLROOT; ?>/NewBooks/deletebooks/' + storeId;
        }

        
        
    </script>
</html>