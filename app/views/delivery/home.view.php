
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/delivery/homepage.css">

    <title>Settings</title>
    
</head>

<body>
    <?php include 'nav.view.php';?> 
    <div class="con">
        <div class="l_col">
            <img style="border-radius:60%;width:60%;" src="http://localhost/Group-27/public/assets/images/publisher/person.jpg">
            <br><br><h3><?php echo $deliveryName; ?></h3>
            <p><?php echo $deliveryemail; ?></p>
            <p>0741234564</p>
            <a href="#" class='bt' type="submit"  >Edit Profile</a><br>        
            <button class="my-button" onclick="redirectTo('dashboard.view.php')">Dashboard</button><br><br>
            <button class="my-button" onclick="redirectTo('orders.view.php')">Orders</button><br><br>
            <!-- <button class="my-button" onclick="redirectTo('deliveryCharges.view.php')">Delivery Charges</button><br><br> -->
            <button class="my-button" onclick="redirectTo('notification.view.php')">Notifications</button><br><br>
            <button class="my-button" >Edit Profile</button><br><br>
        </div>

        <div class="r_col">
           
            <span class ="header">This Month ></span>
            <div class="r_a_col">
             
                <div class="box">
                    <h1>Total deliveries</h1>
                    <h2>20</h2>
                </div>
                
                <div class="box">
                    <h1>Conformed  deliveries</h1>
                    <h2>20</h2>
                </div>
                <div class="box">
                    <h1>Bank Deposit  deliveries</h1>
                    <h2>5</h2>
                </div>
                <div class="box">
                    <h1>Cash on deliveries</h1>
                    <h2>10</h2>
                </div>
                <div class="box">
                    <h1>Returned deliveries</h1>
                    <h2>2</h2>
                </div>

            </div>
                
            <span class ="header">Delivery Charging Table></span><br>
            
            <div class="r_c_col">
               
                <div class="div_table" style="width: 90%">
                <table>
                    <tr>
                        <th style="width: 35%">Weight(kg)</th>
                        <th style="width: 45%">Price per unit(Rs)</th>
                        <th style="width: 20%">Edit</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>350</th>
                        <th><a href="#"><i class="fa fa-edit" style="color:black;"></i></a></th>
                    </tr>
                    <tr>
                        <th>Additional per kilo</th>
                        <th>80</th>
                        <th><a href="#"><i class="fa fa-edit" style="color:black;"></i></a></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><a href="#"><i class="fa fa-edit" style="color:black;"></i></a></td>
                    </tr>
                </table>
                <button class="custom-button">New Weight Category</i> </button>
            </div>
            

            </div>
           
            
        </div>
    </div>

    <?php include 'footer.view.php'; ?>  
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>

</html>
