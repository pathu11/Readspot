
<?php
    $title = "Product Gallery";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/productGallery.css">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <title>Product Gallery</title>

</head>

<body>
<?php   require APPROOT . '/views/publisher/nav.php';?>
    <div class="buttons">
        <button class="custom-button" id="addbooks"><a href="<?php echo URLROOT; ?>/publisher/addBooks">Add Books</a></button>
        <button class="custom-button" id="productgallery"><a href="<?php echo URLROOT; ?>/publisher/productGallery">Product Gallery</a></button>

    </div>
    <div class="div_table" style="width:90%">

        <table>
            <tr>

                <th style="width:7%">Product ID</th>
                <th style="width:7%">Book Name</th>
                <th style="width:7%">ISBN Number</th>
                <th style="width:7%">Author</th>
                <th style="width:7%">Price</th>
                <th style="width:7%">Category</th>
                <th style="width:7%">Weight</th>
                <th style="width:7%">No of Books</th>
                <th style="width:20%">Description</th>
                
                <!-- <th style="width:9%">Image (front)</th>

                <th style="width:9%">Image(back)</th> -->
                <th style="width:5%">Update</th>
                <th style="width:5%">Delete</th>

            </tr>
           
            <?php foreach($data['bookDetails'] as $bookDetails): ?>
            <tr>
                <th style="width:7%"><?php echo $bookDetails->book_id; ?></th>
                <th style="width:7%"><?php echo $bookDetails->book_name; ?></th>
                <th style="width:7%"><?php echo $bookDetails->ISBN_no; ?></th>
                <th style="width:7%"><?php echo $bookDetails->author; ?></th>
                <th style="width:7%"><?php echo $bookDetails->price; ?></th>
                <th style="width:7%"><?php echo $bookDetails->category; ?></th>
                <th style="width:7%"><?php echo $bookDetails->weight; ?></th>
                <th style="width:7%"><?php echo $bookDetails->quantity; ?></th>
                <th style="width:20%"><?php echo $bookDetails->descript; ?></th>
                
                <!-- <th style="width:9%">Image (front)</th>

                <th style="width:9%">Image(back)</th> -->
                <th><a href='<?php echo URLROOT; ?>/publisher/update/<?php echo $bookDetails->book_id; ?>'><i class='fa fa-edit' style='color:black;'></i></a></th>
                <th><a href='#'><i class='fa fa-trash' style='color:black;'></i></a></th>
            </tr>
                <?php endforeach; ?>
            
            
           
                
        </table>
    </div>
    <?php   require APPROOT . '/views/publisher/footer.php';?>
</body>

</html>
