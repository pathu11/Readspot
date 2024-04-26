

<?php
    $title = "Approve Payment Reciepts";  
?>
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
   <br><br><br>
    
    <div class="table-container" >

        <table>
            <tr>
                <th>Order Id</th>
                <th>Tracking Number</th>
                <th>Total Price</th>
                <th>Payment Recipt</th>
                <th>Customer Name</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
           
    <?php foreach($data['orderDetails'] as $order): ?>
    <tr>
        <td><?php echo $order->order_id; ?></td>
        <td><?php echo $order->tracking_no; ?></td>
        <td><?php echo $order->total_price; ?></td>
        <td><a href="<?php echo URLROOT; ?>/assets/images/customer/orderRecipt/<?php echo $order->recipt; ?>">payment Recipt</a></td>
        <td><?php echo $order->customer_name; ?></td>
        <td><?php echo $order->contact_no; ?></td>
        <td><button onclick="approvePopup('<?php echo $order->order_id;?>')">Approve</button>
              <button onclick="rejectPopup('<?php echo $order->order_id;?>')">Reject</button></td>
    </tr>
<?php endforeach; ?>               
        </table>
        
    </div>
    
    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Are you sure you want to approve this payment?</h2>
        <div id="orderApprovalTable"></div>
      </div>
    </div>
    
    <div id="myModal2" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Reject Reason</h2>
        <form action="<?php echo URLROOT;?>/admin/rejectOrder" method="post">
          <textarea id="rejectReason" name="rejectReason" rows="4" cols="50" placeholder="Enter reject reason..."></textarea>
          <input type="hidden" id="order_id" name="order_id">
          <button type="submit">Send Rejection Email</button>
        </form>
      </div>
    </div> 
   
</body>

<script>
    function approvePopup(order_id){
      var approval = '<p>Send approval email</p><br> <a href="<?php echo URLROOT;?>/admin/approveOrder/'+`${order_id}`+'"</a><button>Send</button></a>';
      var orderApproval = document.getElementById("orderApprovalTable");
      orderApproval.innerHTML = approval;
      document.getElementById("myModal").style.display = "block";
    }

    function rejectPopup(order_id) {
      document.getElementById("order_id").value = order_id;
      document.getElementById("myModal2").style.display = "block";
    }

    function closeModal(){
      document.getElementById("myModal").style.display = "none";
      document.getElementById("myModal2").style.display = "none";
    }
  </script>

</html>
