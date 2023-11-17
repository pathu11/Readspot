<?php
    $title = "Update Books";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbookss.css">

    <title>Add Books</title>
    <style>
    .error {
        color: red;
        font-size: 0.8em;
        margin-top: 4px;
        display: block;
    }
</style>


</head>

<body>
    <div>
    <?php   require APPROOT . '/views/publisher/nav.php';?>
        
        <div class="buttons">
            <button  id="addbooks"><a style="text-decoration:none;color:white;" href="<?php echo URLROOT; ?>/publisher/addbooks">Add Books</a></button>
            <button  id="productgallery"><a style="text-decoration:none;color:white;" href="<?php echo URLROOT; ?>/publisher/productGallery">Product Gallery</a></button>
        </div>
        
        <div>
            <div class="form1">
                <h2>Edit Book</h2>
              
                
                <form action="<?php echo URLROOT; ?>/publisher/update/<?php echo $book_id?>" method="POST">   
                              
                    <br>
                    <br>
                    <table class="form_cover">
                        <tbody>
                            <tr class="form_cover1">
                                <th>
                                    <label>Book Name</label><br>
                                    <input type="text" name="book_name" class="<?php echo (!empty($data['book_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['book_name']; ?>" required>
                                    <span class="error"><?php echo $data['book_name_err']; ?></span>
                                </th>
                                <th>
                                    <label>ISBN no</label><br>
                                    <input type="text" name="ISBN_no" class="<?php echo (!empty($data['ISBN_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ISBN_no']; ?>" required>
                                    <span class="error"><?php echo $data['ISBN_no_err']; ?></span>
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label>Author of Book</label><br>
                                    <input type="text" name="author"  class="<?php echo (!empty($data['author_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['author']; ?>"required>
                                    <span class="error"><?php echo $data['author_err']; ?></span>
                                </th>
                                <th>
                                    <label>Price</label><br>
                                    <input type="number" step="0.01" min="0" id="priceInput" name="price"  class="<?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>"required>
                                    <span class="error"><?php echo $data['price_err']; ?></span>
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label>Book Category</label><br>
                                    <select style="padding-right:48px;padding-left:48px;padding-top:8px;padding-bottom:8px;marging-left:250px;border-radius:7px;border:none;color:gray;" class="select <?php echo (!empty($data['category_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['category']; ?>" name="category" required>
                                        <option value="" selected disabled>Select Category</option>
                                        
                                        <option >novel</option>
                                     
                                    </select>
                                </th>
                                <th>
                                    <label>Weight</label><br>
                                    <input type="number" step="0.01" min="0" placeholder="Approximate weight of the book" name="weight" class="<?php echo (!empty($data['weight_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['weight']; ?>" required> 
                                    <span class="error"><?php echo $data['weight_err']; ?></span>
                                    <br>
                                    <button class="calc" id="weightCal">
                                        <a href="https://www.bookmobile.com/book-weight-calculator/">Weight Calculator</a>
                                    </button>
                                </th>
                            </tr>
                            <tr class="form_cover1">
                                <th>
                                    <label>Description</label><br><br>
                                    <input type="text" placeholder="Briefly describe about the content" name="descript" class="<?php echo (!empty($data['descript_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['descript']; ?>">
                                    <span class="error"><?php echo $data['descript_err']; ?></span>
                                </th>
                                <th>
                                <label>Quantity</label><br><br>
                                <input type="number" step="1" min="1" id="quantityInput" placeholder="No of Books in your stock" name="quantity"  class="<?php echo (!empty($data['quantity_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['quantity']; ?>"required>
                                <span class="error"><?php echo $data['quantity_err']; ?></span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                   
                    <br>
                    <table class="form_cover">
                        <tbody>
                            <tr class="pdfUpload">
                                <th>
                                    <label>Upload two Clear images (Cover Page & Inside Paper)</label><br><br>
                                    <input type="file" id="pdfUpload1" name="img1" required>
                                    <input type="file" id="pdfUpload2" name="img2" required>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    
                    <input class="submit-button" type="submit" placeholder="Submit" name="submit">
                </form>
            </div>
        </div>
        <?php   require APPROOT . '/views/publisher/footer.php';?>
    </div>
   

</body>

</html>
