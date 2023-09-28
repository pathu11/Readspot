<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="addbooks.css">

    <title>Add Books</title>

</head>

<body>
    <div >
        <?php include 'nav.php';?>
        
        <div class="buttons">
            <button  id="addbooks"><a style="text-decoration:none;color:white;" href="addbooks.php">Add Books</a></button>
            <button  id="productgallery"><a style="text-decoration:none;color:white;" href="productGallery.php">Product Gallery</a></button>

        </div>
        <div>
            <div class="form1">
                <h2>Enter the Details of the Book</h2>
                <form>                    
                    <br>

<br><table class="form_cover">
                        <tbody><tr class="form_cover1">
                            <th>
                                <label>Book Name</label><br>
                                <input type="text" required="">
                            </th>
                            <th>
                                <label>ISBN no</label><br>
                                <input type="text" required="">
                            </th>
                        </tr>
                        <tr class="form_cover1">
                            
                            <th>
                                <label>Author of Book</label><br>
                                <input type="text" required=""></th>
                            <th>
                                <label>Price</label><br>
                                <input type="number" step="0.01" min="0" id="priceInput" required=""></th>
                        </tr>
                        <tr class="form_cover1">
                            <th>
                                <label>Book Category</label><br>
                                <input type="text" required=""></th>
                            <th>
                                <label>Weight</label><br>
                                <input type="text" placeholder="Approximate weight of the book" required=""> <br><button class="calc" id="weightCal"><a href="https://www.bookmobile.com/book-weight-calculator/">Weight Calculator</a></button></th>
                        </tr>
                        <tr class="form_cover1">
                            <th>
                                <label>Description </label><br>
                                <input type="text" placeholder="Briefly describe about the content"></th>
                            <th>
                                <label>Quantity</label><br>
                                <input type="number" placeholder="No of Books in your stock" required=""></th>
                        </tr>
                    </tbody></table>
                    <table class="form_cover">
                        <tbody><tr class="form_cover1">
                            <th>
                                <label>Your Address</label><br>
                            </th>

                        </tr>
                    </tbody></table>
                    <br><table class="form_cover">

                        <tbody><tr class="form_cover1">
                            <th> <input type="text" placeholder="Street Name" required=""></th>
                            <th><input type="text" placeholder="District" required=""></th>
                            
                        </tr>
                        <tr class="form_cover1">
                            <th><input type="text" placeholder="Your Town" required=""></th>
                            <th><input type="text" placeholder="Postal Code"></th>
                        </tr>    
                    </tbody></table>
                    <table class="form_cover">
                        <tbody><tr class="form_cover1">
                            <th>
                                <label>Acoount Details</label><br>
                            </th>
                        </tr>
                    </tbody></table>
                    <br><table class="form_cover">
                        <tbody><tr class="form_cover1">
                            <th> <input type="text" placeholder="Account No" required=""></th>
                            <th><input type="text" placeholder="Bank Name" required=""></th>
                        </tr>
                        <tr class="form_cover1">
                            <th><input type="text" placeholder="Account Name" required=""></th>
                            <th><input type="text" placeholder="Branch Name" required=""></th>
                        </tr>    
                    </tbody></table>
                    <br><table class="form_cover">
                        <tbody><tr class="form_cover1">
                            <th>
                                <label>Upload Clear images of Cover Pages(2)</label><br>
                                <input type="file" id="pdfUpload" name="pdfUpload" required="">

                            </th>
                        </tr>
                    </tbody></table>
                    <input class="submit-button" type="submit" placeholder="Submit">
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
         </div>

    


</body>

</html>