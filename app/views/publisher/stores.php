<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/stores.css" />
  <title>Add Stores</title>
</head>
<body>
  <?php require APPROOT . '/views/publisher/sidebar.php';?>
  <div class="sub-nav">
    <p class="table-head">Stores</p>
    <div class="search-bar">
        <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div>
    <a href="<?php echo URLROOT;?>/publisher/addStore"><button>Add a Store</button></a>
  </div>

  <div class="table-container">
    <table>
      <tr>
        <th>Store ID</th>
        
        <th>Sender's Name</th>
        <th>Street Name</th>
        <th>Town</th>
        <th>District</th>
        <th>Postal Code</th>
        <th>Edit</th>
        <th>Delete</th>
        
      </tr>
      <?php foreach($data['storeDetails'] as $store): ?>
        <tr>
          <td><?php echo $store->store_id; ?></td>
          
          <td><?php echo $store->postal_name; ?></td>
          <td><?php echo $store->street_name; ?></td>
         
          <td><?php echo $store->town; ?></td>
          <td><?php echo $store->district; ?></td>
          <td><?php echo $store->postal_code; ?></td>
          <th><a href='<?php echo URLROOT; ?>/publisher/updateStore/<?php echo $store->store_id; ?>'><i class='fa fa-edit' style='color:#09514C;'></i></a></th>               
                <th>                 
                            <div class="popup" onclick="myFunction(<?php echo $store->store_id; ?>)">
                                <i class='fa fa-trash' style='color:#09514C;'></i>
                                <div class="popuptext" id="myPopup_<?php echo $store->store_id; ?>">
                                    <p>Are you sure you want to delete this store?</p><br>
                                    <a class="button" href='<?php echo URLROOT; ?>/publisher/deleteStore/<?php echo $store->store_id; ?>'>Yes</a>
                                    <a class="button" href='<?php echo URLROOT; ?>/publisher/stores'>No</a>
                                </div>
                             </div>
                        </th>
          
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        function myFunction(storeId) {
          var popup = document.getElementById("myPopup_" + storeId);
          popup.classList.toggle("show");
      }
        
    </script>
</html>