<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="productGallery.css">

    <title>Product Gallery</title>

</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="buttons">
            <button class="custom-button" id="addbooks"><a href="addbooks.php">Add Books</a></button>
            <button class="custom-button" id="productgallery"><a href="productGallery.php">Product Gallery</a></button>

        </div>
    <div class="div_table" style="width:90%">
        <table>
            <tr>
                
                <th style="width:15%">Product ID</th>
                <th style="width:15%">No of Items</th>
                <th style="width:25%">Discounts</th>
                <th style="width:20%">Total Price(Rs)</th>
                <th style="width:5%">Update</th>
                <th style="width:5%">Delete</th>

            </tr>
            <tr>
                <th>23128</th>
                <th>3</th>
                <th>M.K.P.Pathumi</th>
                <th>1800</th>
                <th><i class="fa fa-edit" style="color:black;"></i></th>
                <th><i class="fa fa-trash" style="color:black;"></i></i>
                </th>

            </tr>
            <tr>
                
                <th>23128</th>
                <th>3</th>
                <th>M.K.P.Pathumi</th>
                <th>1800</th>
                <th><i class="fa fa-edit" style="color:black;"></i></th>
                <th><i class="fa fa-trash" style="color:black;"></i></i>
                </th>

            </tr>
            <tr>
                
                <th>23128</th>
                <th>3</th>
                <th>M.K.P.Pathumi</th>
                <th>1800</th>
                <th><i class="fa fa-edit" style="color:black;"></i></th>
                <th><i class="fa fa-trash" style="color:black;"></i></i>
                </th>

            </tr>

        </table>
    </div>
    <?php include 'footer.php'; ?>





</body>

</html>