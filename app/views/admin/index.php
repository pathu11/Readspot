<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
  <title>Admin Dashboard</title>
</head>
<body>
  <?php require APPROOT . '/views/admin/nav.php';
  
  ?>

  <div class="dashboard">
    <div class="stat-items">
      <div class="grid-container">
        <div class="grid-item"><i class="fa fa-duotone fa-book"></i><br><a href="<?php  echo URLROOT;?>/admin/customers">Customers</a></div>
        <div class="grid-item"><i class="fa fa-solid fa-address-book"></i><br><a href="<?php  echo URLROOT;?>/admin/publishers">Publishers</a></div>
        <div class="grid-item"><i class="fa fa-solid fa-heart"></i><br><a href="<?php  echo URLROOT;?>/admin/charity">Charity Organizations</a></div>
      </div>

      <div class="chart-container">
        <div class="chart">
          <canvas id="myChart1"></canvas>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </div>

    <div class="message-panel">
      <h3>Messages for you</h3>
      <div class="messages">
        <?php foreach($data['messageDetails'] as $message): ?>
        <a href="<?php echo URLROOT;?>/Chats/chat/<?php echo $message->outgoing_msg_id;?>">
        <div class="message">
          <div class="user-message">
            <i class="bx bxs-user-circle icon"></i>
            <span><?php echo $message->outgoing_user_name;?></span>
          </div>
          <p><?php echo $message->msg;?></p>
        </div></a>
        <?php endforeach;?>
      </div>
    </div>
  </div>

  <script>
    // set up block
    const publishers=<?php echo json_encode($data['countPublishers']); ?>;
    const charity=<?php echo json_encode($data['countCharity']); ?>;
    const customers=<?php echo json_encode($data['countCustomers']); ?>;
    const moderators=<?php echo json_encode($data['countModerators']); ?>;
    const delivery=<?php echo json_encode($data['countDelivery']); ?>;
    const data={
      labels: ['Publishers', 'Charity organizations', 'Customers', 'Community moderators','Delivery Systems'],
      datasets: [{
        label: 'Number of users',
        data: [publishers, charity, customers, moderators,delivery],
        backgroundColor: [
          '#333333', '#70BFBA', '#02514C', '000000','#70BFBA'
        ],
        borderWidth: 0,
        borderRadius: 5,
      }]

    };

    // config block
    const config={
      type: 'bar',
      data,
      options: {
        indexAxis: 'y', // Set indexAxis to 'y' for a horizontal bar chart
        scales: {
          x: {
            beginAtZero: true
          },
          y: {
            barPercentage: 0.3, // Adjust the bar height (default is 0.9)
            categoryPercentage: 0.5 // Adjust the spacing between bars (default is 0.8)
          }
        },
        plugins: {
          legend: {
            display: false // Set display to false to hide the legend
          },
          title: {
            display: true,
            text: 'Number of Users', // Title text
            padding: {
              top: 10,
              bottom: 10
            }
          }
        }
      }
    };
    // render block
    const myChart1 = new Chart(
      document.getElementById('myChart1'),config
    );

    </script>


  <div class="table-container">
    <span class="table-head">Pending Registration Requests</span>
    <div class="filter-bar">
        <form action="<?php echo URLROOT;?>/admin/" method="get">
            <select name="user_role" class="select-bar">
                <option value="">Select User Role</option>
                <option value="publisher" <?php isset($_GET['user_role'])==true ? ($_GET['user_role']=='publisher'? 'selected':''):''?> >Publisher
                </option>
                <option value="charity" <?php isset($_GET['user_role'])==true ? ($_GET['user_role']=='charity'? 'selected':''):''?> >Charity Organization
                </option>
            </select>
            <button type="submit" class="filter-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <table>
      <thead>
        <tr>
          <th>Request ID</th>
          <th>Organization Name</th>
          <th>Type</th>
          <th>Request Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data['pendingUserDetails'] as $PendingUser): ?>
        <tr>
          <td><?php echo $PendingUser->user_id;?></td>
          <td><?php echo $PendingUser->email;?></td>
          <td><?php echo $PendingUser->user_role;?></td>
          <td><?php echo $PendingUser->created_at;?></td>
          <td class="actions">
          <?php
            $userRole = '';
            if($PendingUser->user_role=='publisher'){
              $userRole = 'approvePub';
            } else{
              $userRole = 'approveCharity';
            }
          ?>
          
          <a href='<?php echo URLROOT; ?>/admin/<?php echo $userRole; ?>/<?php echo $PendingUser->user_id; ?>'><button>Approve</button></a>
            <button>Reject</button>
            <i class="fa fa-solid fa-eye"></i>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="table-container" >
  <span class="table-head">Pending Payment Receipt Requests</span>
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

</body>
</html>

