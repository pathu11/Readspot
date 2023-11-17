
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/homepage.css">

    <title>Index page</title>
    
</head>

<body>
<?php require APPROOT . '/views/delivery/sidebar.php';?>
    <div class="container">
        <main class="dashboard">
            <section class="topic">
                <div class="head">
                    <h2>Sales Analytics</h2>
                    <p> &nbsp;&nbsp;&nbsp;Track your sales performance and discover trends</p>
                </div>
                <div class="drop">
                    <label>Date range</label><br>
                    <input type="date">
                </div>
            </section>
            <section class="summary">
                <div class="box total-orders">
                    <p>Total Books</p>
                    <h3 class="value">25 </span></h3>
                </div>
                <div class="box total-sales">
                    <p>Total Orders</p>
                    <h3 class="value">50</h3>
                </div>
                <div class="box books-added">
                    <p>Total Income</p>
                    <h3 class="value">LKR 12000</h3>
                </div>
                <div class="box books-added">
                    <p>Total Income</p>
                    <h3 class="value">LKR 12000</h3>
                </div>
                
            </section> 
        </main>
     
            <div class="dashboard1">  
                <span class ="header">Delivery Charging Table >></span><br>
                
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

     
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>

</html>
