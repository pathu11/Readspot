<?php
    $title = "Weight Calculator";
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Add Books</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbooks.css" />

</head>

<body>
    <div>
    
        <div class="form-container">
             <!-- <h2>Enter the Details of the Book</h2> -->
            <div class="form1">
                <h2>Enter the Details of the Book</h2>
                <form action="<?php echo URLROOT; ?>/publisher/update/" method="POST">                    
                    <br>
                    <br>
                                   
                    <input type="text" name="width"  placeholder="Width of the page" required><br>
                    
                    <input type="text" name="height" placeholder="Height of the page" required>
                                              
                    <input type="text" name="gsm"  placeholder="Author Name" required><br>
                   
                    
                    <input  type="submit" placeholder="Submit" name="submit" class="submit">

                </form>
            </div>
        </div>

</div> 
    </div>
   

</body>

</html>
