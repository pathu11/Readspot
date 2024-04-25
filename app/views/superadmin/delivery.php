



<!DOCTYPE html>
<html lang="en">

<head>
<title>Delivery </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/table.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
<link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
<style>
.action a {
    display: inline-block;
    width: 30px;
    height: 30px;
    background-color: #ccc;
    border-radius: 50%; 
    text-align: center;
    line-height: 30px;
    color: #fff; 
    margin-right: 5px;
    transition: background-color 0.3s ease; 
}

.action a:hover {
    background-color:#009D94;
}
</style>
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
        <h3>Delivery Systems >></h3>
        <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
        <thead>
            <tr>

                <th >Id</th>
                <th >Name</th>
                <th >Email</th>
                <th >Status</th>
                <th >Actions</th>
                

            </tr>
</thead> 
<tbody>
    <?php foreach($data['adddeliveryDetails'] as $delivery): ?>
    <tr>
        <td ><?php echo $delivery->delivery_id; ?></td>
        <td ><?php echo $delivery->name; ?></td>
        <td ><?php echo $delivery->email; ?></td>
        <td ><?php echo $delivery->status; ?></td>
        <td class="action">
            <a href='<?php echo URLROOT; ?>/superadmin/updateDelivery/<?php echo $delivery->user_id; ?>'><i class='fa fa-edit'  title="Edit Delivery system's Details"></i></a>

            <a href='#'onclick='confirmDelete(<?php echo $delivery->user_id; ?>)' ><i class='fa fa-user-times'  title="Remove this user from the website"></i></a>
            <a href='#'onclick='confirmRestrict(<?php echo $delivery->user_id; ?>)' ><i class='fa fa-ban'  title="Restrict this account for 7 days" ></i></a>
            <a href="<?php echo URLROOT; ?>/Chats/chat/<?php echo $delivery->user_id; ?>"><i class='fas fa-comment-dots'  title="Chat with this user" ></i></a>
    </td>
           
    </tr>
<?php endforeach; ?>   
<tbody>            
        </table>

        <div id="confirmationDelete" class="confirmationModal">
            <div class="confirmation-content">
                <span class="close" onclick="closeConfirmationModal('confirmationDelete')">&times;</span>
                <h2>Confirmation</h2>
                <p>Are you sure you want to delete this delivery system?</p>
                <button onclick="proceedDelete(<?php echo $delivery->user_id; ?>)">Yes</button>
                <button class="no" onclick="closeConfirmationModal('confirmationDelete')">No</button>
            </div>
        </div>
        <div id="confirmationRestrict" class="confirmationModal1">
            <div class="confirmation-content1">
                <span class="close" onclick="closeConfirmationModal1('confirmationRestrict')">&times;</span>
                <h2>Confirmation</h2>
                <p>Are you sure you want to restrict  this delivery system for 7 days?</p>
                <button onclick="proceedRestrict(<?php echo $delivery->user_id; ?>)">Yes</button>
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
            <a href="<?php echo URLROOT; ?>/superadmin/addDelivery"><button>Add</button></a>

            
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
    window.location.href = '<?php echo URLROOT; ?>/superadmin/restrictdelivery/' + userId;
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
        window.location.href = '<?php echo URLROOT; ?>/superadmin/deletedelivery/' + userId;
    }
</script>


</html>
