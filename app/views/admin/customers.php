

<?php
    $title = "Admin";
    
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

    <div class="nav-container2" style="margin-top: 100px;">
        <a href="<?php echo URLROOT; ?>/admin/customers" class="active">Customers</a>
        <a href="<?php echo URLROOT; ?>/admin/publishers">Publishers</a> 
        <a href="<?php echo URLROOT; ?>/admin/charity">Charity Organizations</a> 
    </div>
    
    <div class="search-bar">
        <input type="text" class="search" id="live-search" autocomplete="off" placeholder="Search..." >
    </div>
    
    <div id="searchresult"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#live-search").keyup(function(){
                var input = $(this).val();
                var searchType = 'customer';
                //alert(input);
                if(input != ""){
                    $.ajax({
                        url:"<?php echo URLROOT;?>/admin/livesearch",
                        method:"POST",
                        data:{input:input, searchType:searchType},

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
    
    <div class="table-container" >
        <table>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Register Date</th>
            </tr>
           
    <?php foreach($data['customerDetails'] as $customer): ?>
            <tr>
                <td><?php echo $customer->customer_id; ?></td>
                <td><?php echo $customer->name; ?></td>
                <td><?php echo $customer->email; ?></td>
                <td><?php echo $customer->created_at; ?></td>
            </tr>
    <?php endforeach; ?>               
        </table>
        
    </div>
    
   
</body>
</html>
