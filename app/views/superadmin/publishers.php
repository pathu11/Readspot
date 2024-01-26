

<?php
    $title = "Publishers";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/productgallery.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />

</head>

<body>
 
    <?php require APPROOT . '/views/superadmin/nav.php';?>
    <a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a>
    <?php require APPROOT . '/views/superadmin/subnav.php';?>
    <div class="div_table" >

        <table>
            <tr>

               
                <th style="width:45%;background-color: #C7C7C7;">Name</th>
                <th style="width:45%;background-color: #C7C7C7;">Email</th>
                <!-- <th style="width:5%;background-color: #C7C7C7;">Update</th> -->
                <th style="width:5%;background-color: #C7C7C7;">Delete</th>

            </tr>
           
    <?php foreach($data['addpublishersDetails'] as $publishers): ?>
    <tr>
        <td style="width:7%"><?php echo $publishers->name; ?></td>
        <td style="width:20%"><?php echo $publishers->email; ?></td>
        <!-- <td><a href='<?php echo URLROOT; ?>/superadmin/updateAdmins/<?php echo $admin->admin_id; ?>'><i class='fa fa-edit' style='color:#09514C;'></i></a></td> -->
        <td><div class="popup" onclick="myFunction()">
                    <i class='fa fa-trash' style='color:#09514C;'></i>
                </a>
                    <div class="popuptext" id="myPopup">
                    <p>Are you sure you want to delete this Publisher?</p><br>
                    <a  class="button" href='<?php echo URLROOT; ?>/superadmin/deletepublishers/<?php echo $publishers->user_id; ?>' >Yes</a>
                    <a class="button" href='<?php echo URLROOT; ?>/superadmin/publishers'>No</a>
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
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
