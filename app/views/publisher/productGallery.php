

<?php
    $title = "Product Gallery";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">

</head>

<body>
<?php   require APPROOT . '/views/publisher/sidebar.php';?>
<a href="#" class="go-back-link" onclick="goBack()">&lt;&lt; Back</a>
    <div class="container">

        <table id="eventTable">
        <thead>
            <tr>

                
                <th >Book Name</th>
               
                <th >Author</th>
                <th >Price</th>
                <th >Category</th>
               
                <th >No of Books</th>
                <th >Description</th>
                <th >Cover Image</th>
                <th >Inside Image</th>
                
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
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
                <th style="width:16%"><?php echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $bookDetails->img1 . '" alt="img1" style="width:60%;"> ';?></th>
                <th style="width:16%"><?php echo '<img src="' . URLROOT . '/assets/images/publisher/addbooks/' .  $bookDetails->img2 . '" alt="img2" style="width:60%;"> ';?></th>


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
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>
