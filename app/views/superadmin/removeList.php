<!DOCTYPE html>
<html lang="en">

<head>
    <title>Remove List</title>
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


    <div class="container">
        <h2>Removed User's List >></h2>
        <table id="eventTable">
            <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Removed Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['removerDetails'] as $remove): ?>
                <tr>
                    <td><?php echo $remove->name; ?></td>
                    <td><?php echo $remove->email; ?></td>
                    <td><?php echo $remove->removed_date; ?></td>
                    <td action="class">
                        <a href="#" onclick="confirmRestore(<?php echo $remove->remove_id; ?>)"><i class='fa fa-trash-restore' style='color:#09514C; ' title="Restore this user"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="confirmationRestore" class="confirmationModal1">
            <div class="confirmation-content1">
                <span class="close" onclick="closeConfirmationModal1('confirmationRestore')">&times;</span>
                <h2>Confirmation</h2>
                <p>Are you sure you want to restore this user again?</p>
                <button onclick="proceedRestore(<?php echo $remove->remove_id; ?>)">Yes</button>
                <button class="no" onclick="closeConfirmationModal1('confirmationRestore')">No</button>
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

    <script>
        function confirmRestore(userId) {
            openConfirmationModal1('confirmationRestore'); // Call the function to open the modal
        }

        function openConfirmationModal1(modalId) {
            var confirmationModal1 = document.getElementById(modalId);
            confirmationModal1.style.display = "block"; // Set the display style to block to show the modal
        }

        function closeConfirmationModal1(modalId) {
            var confirmationModal1 = document.getElementById(modalId);
            confirmationModal1.style.display = "none"; // Set the display style to none to hide the modal
        }

        function proceedRestore(userId) {
            window.location.href = '<?php echo URLROOT; ?>/superadmin/restoreusers/' + userId;
        }
    </script>

</body>

</html>
