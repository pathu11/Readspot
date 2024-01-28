

<?php
    $title = "Customers";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />

</head>

<body>
 
    <?php require APPROOT . '/views/superadmin/nav.php';?>
    <!-- <a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a>
    <?php require APPROOT . '/views/superadmin/subnav.php';?> -->
    <div class="container" >
    <div class="nav">
        <a href="<?php echo URLROOT; ?>/superadmin/customers">Customers</a>
        <a href="<?php echo URLROOT; ?>/superadmin/publishers">Publishers</a>
        <a href="<?php echo URLROOT; ?>/superadmin/admins">Admins</a>
        <a href="<?php echo URLROOT; ?>/superadmin/moderators">Moderatotrs</a>
        <a href="<?php echo URLROOT; ?>/superadmin/charity">Charity Organizations</a>
        <a href="<?php echo URLROOT; ?>/superadmin/delivery">Delivery System</a>
    </div>
        <table id="eventTable">
        <thead>
            <tr>

               
                <th >Name</th>
                <th >Email</th>
                <th >Actions</th>
                

            </tr>
</thead> 
<tbody>
    <?php foreach($data['addcustomersDetails'] as $customer): ?>
    <tr>
        <td ><?php echo $customer->name; ?></td>
        <td ><?php echo $customer->email; ?></td>
        <td>
           

            <a href='#'onclick='confirmDelete(<?php echo $customer->user_id; ?>)' ><i class='fa fa-trash' style='color:#09514C;'></i></a>
    </td>
           
    </tr>
<?php endforeach; ?>   
<tbody>            
        </table>

        <div id="confirmationDelete" class="confirmationModal">
            <div class="confirmation-content">
                <span class="close" onclick="closeConfirmationModal('confirmationDelete')">&times;</span>
                <h2>Confirmation</h2>
                <p>Are you sure you want to delete this customer?</p>
                <button onclick="proceedDelete(<?php echo $customer->user_id; ?>)">Yes</button>
                <button class="no" onclick="closeConfirmationModal('confirmationDelete')">No</button>
            </div>
        </div>

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
        
        
    </div>
    <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
   
</body>
<script>
    // When the user clicks on div, open the popup
    function confirmDelete(userId) {
            openConfirmationModal('confirmationDelete');
        }

    function openConfirmationModal(modalId) {
            var confirmationModal = document.getElementById(modalId);
            confirmationModal.style.display = "block";
        }

    function closeConfirmationModal(modalId) {
            var confirmationModal = document.getElementById(modalId);
            confirmationModal.style.display = "none";
        }


    function proceedDelete(userId) {
        window.location.href = '<?php echo URLROOT; ?>/superadmin/deletecustomers/' + userId;
    }
</script>


</html>
