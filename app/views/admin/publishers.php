

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

    <div class="nav-container2">
        <a href="<?php echo URLROOT; ?>/admin/customers">Customers</a>
        <a href="<?php echo URLROOT; ?>/admin/publishers" class="active">Publishers</a> 
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
                var searchType = 'publisher';
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
                <th>Publisher ID</th>
                <th>Name</th>
                <th>Company Name</th>
                <th>Register Number</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Postal Name</th>
                <th>Street Name</th>
                <th>Town</th>
                <th>District</th>
                <th>Postal Code</th>
                <th>Account Name</th>
                <th>Account Number</th>
                <th>Bank Name</th>
                <th>Branch Name</th>
                <th>Registerd Date</th>
            </tr>
           
    <?php foreach($data['publisherDetails'] as $publisher): ?>
            <tr>
                <td><?php echo $publisher->publisher_id; ?></td>
                <td><?php echo $publisher->name; ?></td>
                <td><?php echo $publisher->company_name; ?></td>
                <td><?php echo $publisher->reg_no; ?></td>
                <td><?php echo $publisher->email; ?></td>
                <td><?php echo $publisher->contact_no; ?></td>
                <td><?php echo $publisher->postal_name; ?></td>
                <td><?php echo $publisher->street_name; ?></td>
                <td><?php echo $publisher->town; ?></td>
                <td><?php echo $publisher->district; ?></td>
                <td><?php echo $publisher->postal_code; ?></td>
                <td><?php echo $publisher->account_name; ?></td>
                <td><?php echo $publisher->account_no; ?></td>
                <td><?php echo $publisher->bank_name; ?></td>
                <td><?php echo $publisher->branch_name; ?></td>
                <td><?php echo $publisher->created_at; ?></td>
            </tr>
    <?php endforeach; ?>               
        </table>
        
    </div>
    
   
</body>
</html>
