


<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/table.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
<link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
<title> Moderators</title>
</head>

<body>
 
    <?php require APPROOT . '/views/superadmin/nav.php';?>
   
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
        <h3>Moderators >></h3>
        <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
        <thead>
            <tr>
                <th >Name</th>
                <th >Email</th>
                <th >Actions</th>
            </tr>
</thead> 
<tbody>
    <?php foreach($data['addmoderatorDetails'] as $moderator): ?>
    <tr>
        <td ><?php echo $moderator->name; ?></td>
        <td ><?php echo $moderator->email; ?></td>
        <td>
            <a href='<?php echo URLROOT; ?>/superadmin/updateModerator/<?php echo $moderator->user_id; ?>'><i class='fa fa-edit' style='color:#09514C;' title="Edit moderator's Details"></i></a>

            <a href='#'onclick='confirmDelete(<?php echo $moderator->user_id; ?>)' ><i class='fa fa-user-times' style='color:#09514C;' title="Remove this user from the website"></i></a>
            <a href='#'onclick='confirmRestrict(<?php echo $moderator->user_id; ?>)' ><i class='fa fa-ban' style='color:#09514C;' title="Restrict this account for 7 days" ></i></a>
    </td>
           
    </tr>
<?php endforeach; ?>   
<tbody>            
        </table>

        <div id="confirmationDelete" class="confirmationModal">
            <div class="confirmation-content">
                <span class="close" onclick="closeConfirmationModal('confirmationDelete')">&times;</span>
                <h2>Confirmation</h2>
                <p>Are you sure you want to delete this moderator?</p>
                <button onclick="proceedDelete(<?php echo $moderator->user_id; ?>)">Yes</button>
                <button class="no" onclick="closeConfirmationModal('confirmationDelete')">No</button>
            </div>
        </div>
        <div id="confirmationRestrict" class="confirmationModal1">
            <div class="confirmation-content1">
                <span class="close" onclick="closeConfirmationModal1('confirmationRestrict')">&times;</span>
                <h2>Confirmation</h2>
                <p>Are you sure you want to restrict  this moderator for 7 days?</p>
                <button onclick="proceedRestrict(<?php echo $moderator->user_id; ?>)">Yes</button>
                <button class="no" onclick="closeConfirmationModal1('confirmationRestrict')">No</button>
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
        <div class="button-container">
            <a href="<?php echo URLROOT; ?>/superadmin/addModerator"><button>Add</button></a>

            
        </div>
        
    </div>
    <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
   
</body>
<script>
    function confirmRestrict(userId) {
    openConfirmationModal1('confirmationRestrict'); // Call the function to open the modal
}

function openConfirmationModal1(modalId) {
    var confirmationModal1 = document.getElementById(modalId);
    confirmationModal1.style.display = "block"; // Set the display style to block to show the modal
}

function closeConfirmationModal1(modalId) {
    var confirmationModal1 = document.getElementById(modalId);
    confirmationModal1.style.display = "none"; // Set the display style to none to hide the modal
}

function proceedRestrict(userId) {
    window.location.href = '<?php echo URLROOT; ?>/superadmin/restrictmoderators/' + userId;
}

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
            window.location.href = '<?php echo URLROOT; ?>/superadmin/deletemoderators/' + userId;
        }
</script>


</html>
