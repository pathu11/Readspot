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
    <a href="<?php echo URLROOT; ?>/admin/pendingRequestsPub">Pending Registration Requests > </a>
    <a href="<?php echo URLROOT; ?>/admin/pendingRequestsBooks" class="active1">Pending Books</a> 
  </div>
   
</body>

</html>
