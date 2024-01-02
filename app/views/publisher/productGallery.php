

<?php
    $title = "Product Gallery";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/productgallery.css" />

</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
    
    <div class="div_table" >

        <table>
            <tr>

                <!-- <th style="width:5%;background-color: #C7C7C7;">Product ID</th> -->
                <th style="width:5%; background-color:#C7C7C7;">Book Name</th>
                <!-- <th style="width:5%;background-color: #C7C7C7; ">ISBN Number</th> -->
                <th style="width:5%;background-color: #C7C7C7;">Author</th>
                <th style="width:5%;background-color: #C7C7C7;">Price</th>
                <th style="width:5%;background-color: #C7C7C7;">Category</th>
                <!-- <th style="width:5%;background-color: #C7C7C7;">Weight</th> -->
                <th style="width:5%;background-color: #C7C7C7;">No of Books</th>
                <th style="width:10%;background-color: #C7C7C7;">Description</th>
                <!-- <th style="width:16%;background-color: #C7C7C7;">Cover Image</th>
                <th style="width:16%;background-color: #C7C7C7;">Inside Image</th> -->
                
                <!-- <th style="width:9%">Image (front)</th>

                <th style="width:9%">Image(back)</th> -->
                <th style="width:5%;background-color: #C7C7C7;">Update</th>
                <th style="width:5%;background-color: #C7C7C7;">Delete</th>

            </tr>
           
            <?php foreach($data['bookDetails'] as $bookDetails): ?>
            <tr>
                <!-- <th style="width:7%"><?php echo $bookDetails->book_id; ?></th> -->
                <th style="width:7%"><?php echo $bookDetails->book_name; ?></th>
                <!-- <th style="width:7%"><?php echo $bookDetails->ISBN_no; ?></th> -->
                <th style="width:7%"><?php echo $bookDetails->author; ?></th>
                <th style="width:7%"><?php echo $bookDetails->price; ?></th>
                <th style="width:7%"><?php echo $bookDetails->category; ?></th>
                <!-- <th style="width:7%"><?php echo $bookDetails->weight; ?></th> -->
                <th style="width:7%"><?php echo $bookDetails->quantity; ?></th>
                <th style="width:20%"><?php echo $bookDetails->descript; ?></th>
                <!-- <th style="width:16%"><?php echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $bookDetails->img1 . '" alt="img1" style="width:80%;"> ';?></th>
                <th style="width:16%"><?php echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $bookDetails->img2 . '" alt="img2" style="width:80%;"> ';?></th> -->


                <!-- <th style="width:9%">Image (front)</th>

                <th style="width:9%">Image(back)</th> -->
                <th><a href='<?php echo URLROOT; ?>/publisher/update/<?php echo $bookDetails->book_id; ?>'><i class='fa fa-edit' style='color:#09514C;'></i></a></th>
                
                <th>
                   
                            <div class="popup" onclick="myFunction(<?php echo $bookDetails->book_id; ?>)">
                                <i class='fa fa-trash' style='color:#09514C;'></i>
                                <div class="popuptext" id="myPopup_<?php echo $bookDetails->book_id; ?>">
                                    <p>Are you sure you want to delete this book?</p><br>
                                    <a class="button" href='<?php echo URLROOT; ?>/publisher/deletebooks/<?php echo $bookDetails->book_id; ?>'>Yes</a>
                                    <a class="button" href='<?php echo URLROOT; ?>/publisher/productGallery'>No</a>
                                </div>
                             </div>
                        </th>
            </tr>
                <?php endforeach; ?>
            
            
           
                
        </table><br>
        <div class="btn-container">
            
        <a href="<?php echo URLROOT; ?>/publisher/addbooks" class="btn">add books</a>
    </div>
    </div>
    
   
</body>
<script>

function myFunction(bookId) {
    var popup = document.getElementById("myPopup_" + bookId);
    popup.classList.toggle("show");
}
</script>

</html>
