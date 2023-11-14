
<?php
    $title = "Customer Support";
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Customer Support</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/customerSupport.css" />
</head>

<body >
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
    <div class="chat-container1">
        <input type="text" placeholder=" Search..." class="search-bar">
</div>
<div class="chat">
    <div class="head">
        <div class="head1">
            <h4>Notifications</h4>
            <span>You've 3 unread notifications </span>
        </div>
        <div class="head1">
            <button>Mark all as read</button>

        </div>
    </div>

    <div>
        <table>
            <tr>
                <th style="width:70%">
                    <h4>Meeting at 07.30 PM</h5>
                    <p>You have an new order at</p>
</th>
                <th style="width:15%">
                    <button class="view">View</button>
                    
</th>
                <th style="width:15%">
                    <button class="delete">Delete</button>
</th>
            <tr>

            <tr>
                <th style="width:70%">
                    <h4>Meeting at 07.30 PM</h5>
                    <p>You have an new order at</p>
</th>
                <th style="width:15%">
                    <button class="view">View</button>
                    
</th>
                <th style="width:15%">
                    <button class="delete">Delete</button>
</th>
            <tr>
            
            <tr>
                <th style="width:70%">
                    <h4>Meeting at 07.30 PM</h5>
                    <p>You have an new order at</p>
</th>
                <th style="width:15%">
                    <button class="view">View</button>
                    
</th>
                <th style="width:15%">
                    <button class="delete">Delete</button>
</th>
            <tr>
        </table>
    </div>
   
            

    

</div>
    

</body>

</html>
