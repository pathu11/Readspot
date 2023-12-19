<?php
    $title = "Edit Account Details";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/addbooks.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/sidebar.css" />

</head>

<body>
    <div>
   
        <div class="form-container">
             
            <div class="form1">
                <h2>Enter the Account Details </h2>
                <form action="<?php echo URLROOT; ?>/publisher/editAccountForAddbooks/<?php echo $data['publisher_id']; ?>" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="text" name="account_name" class="<?php echo (!empty($data['account_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['account_name']; ?>" placeholder="Account Holder Name" required><br>
                    <span class="error"><?php echo $data['account_name_err']; ?></span>
                               
                                   
                    <input type="text" name="account_no" class="<?php echo (!empty($data['account_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['account_no']; ?>" placeholder="Account Number" required>
                                              
                    <input type="text" name="bank_name"  class="<?php echo (!empty($data['bank_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['bank_name']; ?>"placeholder="Bank Name" required><br>
                    <span class="error"><?php echo $data['bank_name_err']; ?></span>

                    <input type="text" name="branch_name"  class="<?php echo (!empty($data['branch_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['branch_name']; ?>"placeholder="Branch Name" required><br>
                    <span class="error"><?php echo $data['branch_name_err']; ?></span>
                    
                    <input  type="submit" placeholder="Next" name="submit" class="submit">
                    </div> 
                    <br>       
                    

                </form>
            </div>
        </div>

</div> 
    </div>
   

</body>

</html>
