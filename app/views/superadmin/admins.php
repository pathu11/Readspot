

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
 
    <?php require APPROOT . '/views/superadmin/nav.php';?>
    <?php require APPROOT . '/views/superadmin/subnav.php';?>
    <div class="div_table" >

        <table>
            <tr>

               
                <th style="width:45%;background-color: #C7C7C7;">Name</th>
                <th style="width:45%;background-color: #C7C7C7;">Email</th>
                <th style="width:5%;background-color: #C7C7C7;">Update</th>
                <th style="width:5%;background-color: #C7C7C7;">Delete</th>

            </tr>
           
    <?php foreach($data['addadminDetails'] as $admin): ?>
    <tr>
        <td style="width:7%"><?php echo $admin->name; ?></td>
        <td style="width:20%"><?php echo $admin->email; ?></td>
        <td><a href='<?php echo URLROOT; ?>/superadmin/updateAdmin/<?php echo $admin->admin_id; ?>'><i class='fa fa-edit' style='color:#09514C;'></i></a></td>
        <td>
            <div class="popup" onclick="myFunction()">
                    <i class='fa fa-trash' style='color:#09514C;'></i>
                </a>
                    <div class="popuptext" id="myPopup">
                    <p>Are you sure you want to delete this admin?</p><br>
                    <a  class="button" href='<?php echo URLROOT; ?>/superadmin/deleteadmins/<?php echo $admin->user_id; ?>' >Yes</a>
                    <a class="button" href='<?php echo URLROOT; ?>/superadmin/admins'>No</a>
                    </div>
                    </div></td>
    </tr>
<?php endforeach; ?>               
        </table>
        <a href="<?php echo URLROOT; ?>/superadmin/addAdmin" class="btn">Add</a>
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
