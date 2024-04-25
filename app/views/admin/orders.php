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

  <div class="search-bar" style="margin-top: 100px;">
    <label for="birthday">Search Order by order date:</label>
    <input type="date" class="search" id="live-search1"autocomplete="off">
    <input type="text" class="search" id="live-search2" autocomplete="off" placeholder="Search by Order ID..." >
  </div>

  <div id="searchresult"></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#live-search2").keyup(function(){
        var input = $(this).val();
        var searchType = 'order';
        var inputType = 'word';
        //alert(input);
        if(input != ""){
            $.ajax({
                url:"<?php echo URLROOT;?>/admin/livesearch",
                method:"POST",
                data:{input:input, searchType:searchType, inputType:inputType},

                success:function(data){
                    $(".table-container").hide();
                    $("#searchresult").html(data);
                    $("#searchresult").css("display","block");
                }
            });
        }else{
            $(".table-container").show();
            $("#searchresult").css("display","none");
        }
      });
    });

    $(document).ready(function(){
      $("#live-search1").change(function(){
        var input = $(this).val();
        var searchType = 'order';
        var inputType = 'date';
        
        var formattedDate = new Date(input);
        var year = formattedDate.getFullYear();
        var month = formattedDate.getMonth() + 1;
        var day = formattedDate.getDate();
        if (month < 10) month = '0' + month;
        if (day < 10) day = '0' + day;
        var formattedInput = year + '-' + month + '-' + day;
        
        if(input != ""){
            $.ajax({
                url:"<?php echo URLROOT;?>/admin/livesearch",
                method:"POST",
                data:{input:formattedInput, searchType:searchType, inputType:inputType},

                success:function(data){
                    $(".table-container").hide();
                    $("#searchresult").html(data);
                    $("#searchresult").css("display","block");
                }
            });
        }else{
            $(".table-container").show();
            $("#searchresult").css("display","none");
        }
      });
    });
  </script>


  
  <div class="table-container">

    <table id="eventTable">
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
            <td>
              <?php 
                if($order->status == 'delivered'){
                  echo '<span style="color: purple;">'.$order->status.'</span>';
                }
                elseif($order->status == 'cancel'){
                  echo '<span style="color: red;">'.$order->status.'</span>';
                }
                elseif($order->status == 'processing'){
                  echo '<span style="color: blue;">'.$order->status.'</span>';
                }
                elseif($order->status == 'pending'){
                  echo '<span style="color: orange;">'.$order->status.'</span>';
                }      
              ?>
            </td>
            <td><?php echo $order->total_price; ?></td>
            <td><?php echo $order->total_weight	; ?></td>
        </tr>
      <?php endforeach; ?>               
    </table>
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

    <script src="<?php echo URLROOT;?>/assets/js/moderator/table.js"></script>
  </div>

</body>
</html>