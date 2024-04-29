
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
  <title> Stores</title>
</head>
<body>
  <?php require APPROOT . '/views/publisher/sidebar.php';?>
  <div class="all">
    <div class="container">
        <table id="eventTable">
          <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
          <thead>
            <tr>
              <th>Store ID</th>
              
              <th>Sender's Name</th>
              <th>Street Name</th>
              <th>Town</th>
              <th>District</th>
              <th>Postal Code</th>
              <th>Action</th>
              <!-- <th>Edit</th>
              <th>Delete</th> -->
              
            </tr>
          </thead>
          <tbody>
          <?php foreach($data['storeDetails'] as $store): ?>
            <tr>
              <td><?php echo $store->store_id; ?></td>
              
              <td><?php echo $store->postal_name; ?></td>
              <td><?php echo $store->street_name; ?></td>
              <td><?php echo $store->town; ?></td>
              <td><?php echo $store->district; ?></td>
              <td><?php echo $store->postal_code; ?></td>
              <td class="action-buttons">
                  <a  href='<?php echo URLROOT; ?>/publisher/updateStore/<?php echo $store->store_id; ?>' ><i class='fa fa-edit' ></i></a>
                  <a  href='#' onclick='confirmDelete(<?php echo $store->store_id; ?>)'><i class='fa fa-trash'></i></a>  
                </td> 
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <div id="confirmationModal" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeConfirmationModal()">&times;</span>
          <h2>Confirmation</h2>
          <p>Are you sure you want to delete this store?</p>
          <input type="hidden" id="storeIdToDelete" >
          <button onclick="proceedDelete()">Yes</button>
          <button onclick="closeConfirmationModal()">No</button>
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
            <a href="<?php echo URLROOT;?>/publisher/addStore"><button>Add a Store</button></a>
            </div>
        </div>
        <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
        <?php
            require APPROOT . '/views/publisher/footer.php'; //path changed
        ?>
  </div>
    
  
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
        function confirmDelete(bookId) {
            var confirmationModal = document.getElementById("confirmationModal");
            confirmationModal.style.display = "block";
            document.getElementById("storeIdToDelete").value = bookId;
        }

        function closeConfirmationModal() {
            var confirmationModal = document.getElementById("confirmationModal");
            confirmationModal.style.display = "none";
        }
        function proceedDelete() {
            var storeId = document.getElementById("storeIdToDelete").value;
            if (storeId) {
                window.location.href = '<?php echo URLROOT; ?>/publisher/deleteStore/' + storeId;
            } else {
                alert("Error: Store ID not found!");
            }
        }
        
        
    </script>
</html>