<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/style.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
  <?php require APPROOT . '/views/admin/nav.php';?>
  
  <div class="table-container" style="margin-top: 100px;" >

    <table>
      <tr>
          <th>Order ID</th>
          <th>Book ID</th>
          <th>Customer ID</th>
          <th>Quantitiy</th>
          <th>Order Date</th>
          <th>Status</th>
          <th>Total Price</th>
          <th>Total Weight</th>
      </tr>
           
      <?php foreach($data['orderDetails'] as $order): ?>
        <tr>
            <td><?php echo $order->order_id; ?></td>
            <td><?php echo $order->book_id; ?></td>
            <td><?php echo $order->customer_id; ?></td>
            <td><?php echo $order->quantity	; ?></td>
            <td><?php echo $order->order_date; ?></td>
            <td><?php echo $order->status; ?></td>
            <td><?php echo $order->total_price; ?></td>
            <td><?php echo $order->total_weight	; ?></td>
        </tr>
      <?php endforeach; ?>               
    </table>
  </div>

</body>
</html>