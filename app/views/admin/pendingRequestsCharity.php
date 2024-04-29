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
        <!-- <a href="<?php echo URLROOT; ?>/admin/pendingRequestsPub" class="active1">Pending Registration Requests > </a> -->
        <a href="<?php echo URLROOT; ?>/admin/pendingRequestsBooks">Pending Books</a> 
    </div>
    
    <!-- <div class="nav-container2">
        <a href="<?php echo URLROOT; ?>/admin/pendingRequestsPub">Publishers</a>
        <a href="<?php echo URLROOT; ?>/admin/pendingRequestsCharity" class="active">Charity Organizations</a>  
    </div> -->
    
    <div class="table-container" >

        <table>
            <tr>
                <th>Name</th>
                <th>Organization Name</th>
                <th>Register Number</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
           
    <?php foreach($data['getcharityDetails'] as $charity): ?>
    <tr>
        <td><?php echo $charity->name; ?></td>
        <td><?php echo $charity->org_name; ?></td>
        <td><?php echo $charity->reg_no; ?></td>
        <td><?php echo $charity->email; ?></td>
        <td><?php echo $charity->contact_no; ?></td>
        
       
        <td><a href='<?php echo URLROOT; ?>/admin/approveCharity/<?php echo $charity->user_id; ?>'><button>Approve</button></a>
        <div class="popup"">
                    <button onclick="myFunction()">Reject</button>
                    <div class="popuptext" id="myPopup">
                    <p>Are you sure you want to  reject and delete this Customer?</p><br>
                    <a  class="button" href='#' ><button>Yes</button></a>
                    <a class="button" href='#'><button>No</button></a>
                    </div>
                    </div></td>
    </tr>
<?php endforeach; ?>               
        </table>
        
    </div>
    
   
</body>
<script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>

</html>
