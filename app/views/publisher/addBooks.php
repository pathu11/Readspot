
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Books</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbooks.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
</head>
<body>
    <?php require APPROOT.'/views/publisher/sidebar.php';?>
    
        <div class="form-container">
             <!-- <h2>Enter the Details of the Book</h2> -->
            <div class="form1">
                <h2>Enter the Details of the Book</h2>
                <form action="<?php echo URLROOT; ?>/NewBooks/addbooks" enctype="multipart/form-data" method="POST">                    
                    <br>
                    <br>           
                    <input type="text" name="book_name" class="<?php echo (!empty($data['book_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['book_name']; ?>" placeholder="Book Name" required><br>
                    <span class="error"><?php echo $data['book_name_err']; ?></span>
                                       
                    <input type="text" pattern="[0-9]*" name="ISBN_no" class="<?php echo (!empty($data['ISBN_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ISBN_no']; ?>" placeholder="ISBN Number" required>
                                              
                    <input type="text" name="author"  class="<?php echo (!empty($data['author_err'])) ? 'is-invalid' : ''; ?>"  pattern="[a-zA-Z\s\u0D80-\u0DFF]+" value="<?php echo $data['author']; ?>"placeholder="Author Name" required><br>
                    <span class="error"><?php echo $data['author_err']; ?></span>
                    <div class="table">
                        <div class="table1">
                            <input type="number"  step="0.01" min="1" id="priceInput" name="price"  class="<?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>"placeholder="Price (Rs.)" required>
                            <span class="error"><?php echo $data['price_err']; ?></span>
                            </div>
                        <div class="table1">
                            <input type="number" step="1" min="0" max="100" id="discountInput" placeholder="Discounts as a Percentage" name="discounts"  class="<?php echo (!empty($data['discounts_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['discounts']; ?>" required><br>
                            <span class="error"><?php echo $data['discounts_err']; ?></span>

                        </div>    
                    </div> 
                    <div class="table">
                        <div class="table1">
                            <input type="number" step="1" min="1" id="quantityInput" placeholder="No of Books in your stock" name="quantity"  class="<?php echo (!empty($data['quantity_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['quantity']; ?>"placeholder="No of Books" required><br>
                            <span class="error"><?php echo $data['quantity_err']; ?></span>
                        </div>
                        <div class="table1">
                            <input type="number" step="0.01" min="1" placeholder="Approximate weight of the book(g)" name="weight" class="<?php echo (!empty($data['weight_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['weight']; ?>"  required> 
                            <span class="error"><?php echo $data['weight_err']; ?></span>
                            <br>
        
                            <a href="<?php echo URLROOT; ?>/NewBooks/weightcalc" class="calc-button">Weight Calculator</a>          
                        </div>
</div>       
<br><br>
                            <select class="select <?php echo (!empty($data['category_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['category']; ?>" name="category" required>
                                <option value="" selected disabled>Select Book Category</option>
                                <?php foreach($data['bookCategoryDetails'] as $bookCategoryDetails): ?>
                                    <option><?php echo $bookCategoryDetails->category; ?></option>
                                <?php endforeach; ?>
                            </select>                                         
                    <br><br>
                    <input type="text" placeholder="Briefly describe about the content" name="descript" class="<?php echo (!empty($data['descript_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['descript']; ?>" required><?php echo $data['descript']; ?><br>
                    <span class="error"><?php echo $data['descript_err']; ?></span>
                  <br>
                    <label>Upload two Clear images (Cover Page & Inside Paper)</label><br><br>
                    <div class="table">
                        <div class="table1">
                            <input type="file" id="pdfUpload1" name="img1" required>
                        </div>
                        <div class="table1">
                            <input type="file" id="pdfUpload2" name="img2" required>
                        </div>
                    </div> 
                    <br>
                    <div>  <input type="checkbox" required><span style="font-size:15px;">  I confirm that this book is original, free from copyright issues, and not printed through unauthorized channels. I commit to promptly addressing any copyright concerns and respect intellectual property rights.</span>
                </div>
                    <br>   
                    <button onclick="goBack()" class="submit">  Back </button>     
                    <input type="submit" value="Next" name="submit" class="submit">
                </form>
            </div>
        </div>
</div> 
    </div>
    <?php
            require APPROOT . '/views/publisher/footer.php'; 
        ?>
       
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
       
    
    </script>
</html>
