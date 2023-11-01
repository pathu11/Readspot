<?php
    $title = "Add an Admin";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="http://localhost/Group-27/public/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/publisher/addbookss.css">

    <title>Add Books</title>
    <style>
    .error {
        color: red;
        font-size: 0.8em;
        margin-top: 4px;
        display: block;
    }
</style>


</head>

<body>
    <div>
        <?php include 'nav.view.php';?>
        <?php include 'subNav.view.php';?>

        
        <div class="buttons">
            <button  id="addbooks"><a style="text-decoration:none;color:white;" href="addadmin.view.php">Add Books</a></button>
            <button  id="productgallery"><a style="text-decoration:none;color:white;" href="admin.view.php">Product Gallery</a></button>
        </div>
        
        <div>
            <div class="form1">
                <h2>Enter the Details of the Admin</h2>
                <form action="http://localhost/Group-27/app/controllers/superadmin/AddAdminController.php" method="POST">                    
                    <br>
                    <br>
                    <table class="form_cover">
                        <tbody>
                            <tr class="form_cover1">
                                <th>
                                    <label>Name</label><br>
                                    <input type="text" name="name" required>
                                </th>
                                <th>
                                    <label>Email</label><br>
                                    <input type="email" name="email" required>

                                </th>
                                <th>
                                    <label>Password</label><br>
                                    <input type="text" name="pass" required>
                                    
                                </th>
                </tr>
                                
                            
                           
                        </tbody>
                    </table>
                   
                    <br>
                   
                    
                    <input class="submit-button" type="submit" placeholder="Submit" name="submit">
                </form>
            </div>
        </div>
        <?php include 'footer.view.php'; ?>
    </div>
    <script>
    
</script>

</body>

</html>
