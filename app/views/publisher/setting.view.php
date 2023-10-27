<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/publisher/set.css">

    <title>Settings</title>
    
</head>

<body>
    <?php include 'nav.view.php';?> 
    <div class="con">
        <div class="l_col">
        
           
                <h3>{$row['full_name']}</h3><br>
                <p>{$row['email']}</p><br>
                <p>{$row['contact_no']}</p>
                
            <button id="btnclick" class="my-button">Edit Profile</button><br>
            
        </div>

        <div class="r_col">
            
            <div class="r_a_col">
                <h2>Postal Details</h2>
                <table>
                
                        <tr>
                        <td> 
                            <label>Name</label><br>
                            <span>{$row['full_name']}</span><br>
                        </td>
                        <td>
                            <label>Address</label><br>
                            <span>{$row['street_name']}</span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>City</label><br>
                            <span>{$row['town']}</span><br>
                        </td>
                        <td>
                            <label>District</label><br>
                            <span>{$row['district']}</span><br>
                        </td>
                        <td>
                            <label>Postal Code</label><br>
                            <span>{$row['postal_code']}</span><br>
                        </td>

                    <tr>

                
                    
                </table>
               

             
                <button id="btnClick1" class="my-button">Edit</button>
            </div>
            <div class="r_b_col">
                <h2>Account Details</h2>
                <table>
                
                        <tr>
                        <td> 
                            <label>Name</label><br>
                            <span>{$row['account_name']}</span><br>
                        </td>
                        <td>
                            <label>Account Number</label><br>
                            <span>{$row['account_no']}</span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>Bank Name</label><br>
                            <span>{$row['bank_name']}</span><br>
                        </td>
                        <td>
                            <label>Branch Name</label><br>
                            <span>{$row['branch_name']}</span><br>
                        </td>
                       

                    <tr>


                </table>
               

             
                <button id="btnClick1" class="my-button">Edit</button>
            </div>
            
            
        </div>
    </div>

    <?php include 'footer.view.php'; ?>  
   
</body>

</html>
