

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
        <a href="<?php echo URLROOT; ?>/admin/customers" class="active">Customers</a>
        <a href="<?php echo URLROOT; ?>/admin/publishers">Publishers</a> 
        <a href="<?php echo URLROOT; ?>/admin/charity">Charity Organizations</a> 
    </div>
    <div class="table-container" >

        <table>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Register Date</th>
            </tr>
           
    <?php foreach($data['customerDetails'] as $customer): ?>
    <tr>
        <td><?php echo $customer->customer_id; ?></td>
        <td><?php echo $customer->name; ?></td>
        <td><?php echo $customer->email; ?></td>
        <td><?php echo $customer->created_at; ?></td>
    <?php endforeach; ?>               
        </table>
        
    </div>
    
   
</body>
</html>
