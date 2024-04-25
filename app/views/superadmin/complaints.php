<!DOCTYPE html>
<html lang="en">

<head>
    <title>Complaints</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/table.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <style>
        .action a {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color:#009D94 ;
            border-radius: 50%; 
            text-align: center;
            line-height: 30px;
            color: #fff; 
            margin-right: 5px;
            transition: background-color 0.3s ease; 
        }

        .action a:hover {
            background-color:#ccc;
        }
</style>
</head>

<body>

    <?php require APPROOT . '/views/superadmin/nav.php';?>

    <div class="container">

        <table id="eventTable">
            <h3>complaints >></h3>
            <div class="container1">
                <div class="select-wrapper">
                    <label for="filterStatusSuperadmin">Resolved by <br>Superadmin:</label>
                    <select id="filterStatusSuperadmin" onchange="filterByStatus('superadmin')">
                        <option value="">All</option>
                        <option value="resolved">Resolved by Superadmin</option>
                        <option value="not_resolved">Not Resolved</option>
                    </select>
                </div>

                <div class="select-wrapper">
                    <label for="filterStatusAdmin">Resolved by <br>Admin:</label>
                    <select id="filterStatusAdmin" onchange="filterByStatus('admin')">
                        <option value="">All</option>
                        <option value="resolved_by_admin">Resolved by Admin</option>
                        <option value="not_resolved">Not Resolved</option>
                    </select>
                </div>
                
            </div>
            <!-- <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()"> -->
            <thead>
                <tr>

                    <th>Complaint Id</th>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Reason</th>
                    <th>Description</th>
                    <th>Moderator Comment</th>
                    <th style="display:none;">Resolved or not By Superadmin</th>
                    <th style="display:none;">Resolved or not By admin/moderator</th>
                    <th>Superadmin Comment</th>
                    <th>Actions</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach($data['complintsDetails'] as $complaints): ?>
                <tr>
                    <td title="<?php echo $complaints->complaint_id; ?>"><?php echo $complaints->complaint_id; ?></td>
                    <td title="<?php echo $complaints->customer_id; ?>"><?php echo $complaints->customer_id; ?></td>
                    <td title="<?php echo $complaints->first_name; ?> "><?php echo $complaints->first_name; ?> <?php echo $complaints->last_name; ?></td>
                    <td title="<?php echo $complaints->email; ?>"><?php echo $complaints->email; ?></td>
                    <td title="<?php echo $complaints->contact_number; ?>"><?php echo $complaints->contact_number; ?></td>
                    <td title="<?php echo $complaints->reason; ?>"><?php echo $complaints->reason; ?></td>
                    <td title="<?php echo $complaints->descript; ?>"><?php echo $complaints->descript; ?></td>

                    <td title="<?php echo $complaints->moderatorAdmin_comment; ?>"><?php echo $complaints->moderatorAdmin_comment; ?></td>
                    <td style="display:none;"><?php echo $complaints->resolvedBy_superadmin; ?></td>
                    <td style="display:none;"><?php echo $complaints->resolved_or_not; ?></td>
                    <td title="<?php echo $complaints->superadmin_comment; ?>"><?php echo $complaints->superadmin_comment; ?></td>


                    <td class="action" >
                        <?php if(isset($complaints->superadmin_comment)): ?>
                            <a href='#' style="background-color:#ccc;" ><i class="fa fa-check" title="already resolved that issue"></i> </a>
                        <?php else: ?>
                            <a href='#' onclick='resolved(<?php echo $complaints->complaint_id; ?>)'><i class="fa fa-check" title="Resolved this issue"></i> </a>
                        <?php endif ; ?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="confirmationResolved" class="confirmationModal">
            <div class="confirmation-content">
                <span class="close" onclick="closeConfirmationModal('confirmationResolved')">&times;</span>
                <h2>Confirmation</h2>
                <h3>Are you sure you want to confirm that issue is resolved?</h3>
                <p>Enter your special notes here >></p>
                <input type="text" name="superadmin_comment">
                <button onclick="proceedResolved(<?php echo $complaints->complaint_id; ?>)">Yes</button>
                <button class="no" onclick="closeConfirmationModal('confirmationResolved')">No</button>
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
    function resolved(userId) {
        openConfirmationModal('confirmationResolved');
    }

    function openConfirmationModal(modalId) {
        var confirmationModal = document.getElementById(modalId);
        confirmationModal.style.display = "block";
    }

    function closeConfirmationModal(modalId) {
        var confirmationModal = document.getElementById(modalId);
        confirmationModal.style.display = "none";
    }

    function proceedResolved(complaintId) {
        var reason = document.querySelector('input[name="superadmin_comment"]').value;
        window.location.href = '<?php echo URLROOT; ?>/superadmin/proceedResolved/' + complaintId + '/' + encodeURIComponent(reason);
    }
    
    function filterByStatus() {
        var filterSuperadmin = document.getElementById("filterStatusSuperadmin").value;
        var filterAdmin = document.getElementById("filterStatusAdmin").value;
        var table = document.getElementById("eventTable");
        var rows = table.getElementsByTagName("tr");
        for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the table header
            var statusSuperadmin = rows[i].getElementsByTagName("td")[8].innerText.trim();
            var statusAdmin = rows[i].getElementsByTagName("td")[9].innerText.trim();
            if ((filterSuperadmin === "" || (filterSuperadmin === 'resolved' && statusSuperadmin === '1') || (filterSuperadmin === 'not_resolved' && statusSuperadmin === '0')) &&
                (filterAdmin === "" || (filterAdmin === 'resolved_by_admin' && statusAdmin === '1') || (filterAdmin === 'not_resolved' && statusAdmin === '0'))) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>

</html>
