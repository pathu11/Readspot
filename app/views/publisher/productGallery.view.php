<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/MVC1/public/assets/css/publisher/productGallery.css">

    <title>Product Gallery</title>

</head>

<body>
    <?php include 'nav.view.php'; ?>
    <div class="buttons">
        <button class="custom-button" id="addbooks"><a href="addBooks.view.php">Add Books</a></button>
        <button class="custom-button" id="productgallery"><a href="productGallery.view.php">Product Gallery</a></button>

    </div>
    <div class="div_table" style="width:90%">
        <table>
            <tr>

                <th style="width:15%">Product ID</th>
                <th style="width:15%">No of Items</th>
                <th style="width:25%">Description</th>
                <th style="width:20%">Total Price(Rs)</th>
                <th style="width:5%">Update</th>
                <th style="width:5%">Delete</th>

            </tr>
            
            
                <tr>
                    <th>{$row['id']}</th>
                    <th>{$row['quantity']}</th>
                    <th>{$row['descript']}</th>
                    <th>{$row['price']}</th>
                    <th><i class="fa fa-edit" style="color:black;"></i> </a></th>
                    <th><i class="fa fa-trash" style="color:black;"></i></a></th>
                </tr>
        
        </table>
    </div>
    <?php include 'footer.view.php'; ?>
</body>

</html>
