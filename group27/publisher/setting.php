<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="setting.css"> -->
    <link rel="stylesheet" href="set.css">

    <title>Settings</title>
    
</head>

<body>
    <?php include 'nav.php';?> 
    <div class="con">
        <div class="l_col">
            <img src="../images/publisher/profile.jpg" class="profile-image"/><br><br>
            <h3>Ramath Peera</h3><br>
            <p>ramathperera08@gmail.com</p><br>
            <p>0741218057</p>
            <button id="btnclick" class="my-button">Edit Profile</button><br>
            
        </div>

        <div class="r_col">
            
            <div class="r_a_col">
                <h2>Postal Details</h2>
                <table>
                    <tr>
                        <td> 
                            <label>Name</label><br>
                            <span>M.K.P.Ahinsa</span><br>
                        </td>
                        <td>
                            <label>Address</label><br>
                            <span>No:53/1,Godellawela,Tangalle</span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>City</label><br>
                            <span>Tangalle</span><br>
                        </td>
                        <td>
                            <label>District</label><br>
                            <span>Hambantota</span><br>
                        </td>
                        <td>
                            <label>Postal Code</label><br>
                            <span>82200</span><br>
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
                            <span>M.K.P.Ahinsa</span><br>
                        </td>
                        <td>
                            <label>Account Number</label><br>
                            <span>345678</span><br> 
                        </td>

                    <tr>
                    <tr>
                        <td>
                            <label>Bank Name</label><br>
                            <span>Peoples Bank</span><br>
                        </td>
                        <td>
                            <label>Branch Name</label><br>
                            <span>Tangalle</span><br>
                        </td>
                        <td>
                            <label>Branch Code</label><br>
                            <span>067</span><br>
                        </td>

                    <tr>


                </table>
               

             
                <button id="btnClick1" class="my-button">Edit</button>
            </div>
            
            
        </div>
    </div>

    <?php include 'footer.php'; ?>  
   
</body>

</html>
