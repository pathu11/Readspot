

<?php
    $title = "Admin";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/productgallery.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />

</head>

<body>
 
<?php require APPROOT . '/views/admin/nav.php';?>
<?php require APPROOT . '/views/admin/subnav.php';?>
    
    <div class="div_table" >

        <table>
            <tr>

               
                <th style="width:10%;background-color: #C7C7C7;">Name</th>
                <th style="width:10%;background-color: #C7C7C7;">Organization Name</th>
                <th style="width:10%;background-color: #C7C7C7;">Register Number</th>
                <th style="width:10%;background-color: #C7C7C7;">Email</th>
                <th style="width:10%;background-color: #C7C7C7;">Contact Number</th>
                <th style="width:5%;background-color: #C7C7C7;">Approve</th>
                <th style="width:5%;background-color: #C7C7C7;">Reject</th>

            </tr>
           
    <?php foreach($data['getcharityDetails'] as $charity): ?>
    <tr>
        <td style="width:10%"><?php echo $charity->name; ?></td>
        <td style="width:10%"><?php echo $charity->org_name; ?></td>
        <td style="width:10%"><?php echo $charity->reg_no; ?></td>
        <td style="width:10%"><?php echo $charity->email; ?></td>
        <td style="width:10%"><?php echo $charity->contact_no; ?></td>
        
       
        <td><a href='<?php echo URLROOT; ?>/admin/approveCharity/<?php echo $charity->user_id; ?>'>Edit</a></td>
        <td><div class="popup" onclick="myFunction()">
                    <i class='fa fa-trash' style='color:#09514C;'></i>
                </a>
                    <div class="popuptext" id="myPopup">
                    <p>Are you sure you want to delete this Customer?</p><br>
                    <a  class="button" href='<?php echo URLROOT; ?>/superadmin/deletecustomers/<?php echo $customers->user_id; ?>' >Yes</a>
                    <a class="button" href='<?php echo URLROOT; ?>/superadmin/customers'>No</a>
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
