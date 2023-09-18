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
    <?php include 'nav.php';?>
   
    <div class="buttons">
        <button id="addbooks">Add Books</button>
        <button id="productgallery">Product Gallery</button>

    </div>
    <div class="form_cover">
        <div>
            <h2>Enter the Details of the Book</h2>
            <form>
                <table>
                    <tr>
                        <th class="tCol2">
                            <label>Book Name</label><br>
                            <input type="text">
                        </th>
                        <th class="tCol3">
                            <label>ISBN no</label><br>
                            <input type="text">
                        </th>
                    </tr>
                    <tr>
                        <th class="tCol2">
                            <label>Author of Book</label><br>
                            <input type="text"></th>
                        <th class="tCol3">
                            <label>Price</label><br>
                            <input type="number" step="0.01" min="0" id="priceInput"></th>
                    </tr>
                    <tr>
                        <th class="tCol2">
                            <label>Book Category</label><br>
                            <input type="text"></th>
                        <th class="tCol3">
                            <label>Weight</label><br>
                            <input type="text"> <button id="weightCal"><a href="https://www.bookmobile.com/book-weight-calculator/">Weight Calculator</a></button></th>
                    </tr>
                    <tr>
                        <th class="tCol2">
                            <label>Description about Book</label><br>
                            <input type="text"></th>
                        <th class="tCol3">
                            <label>Quantity</label><br>
                            <input type="number"></th>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>
                            <label>Your Address</label><br>
                        </th>

                    </tr>
                </table>
                <table>

                    <tr>
                        <th class="tCol4"> <input type="text" placeholder="Street Name"></th>
                        <th class="tCol4"><input type="text" placeholder="District"></th>
                        <th class="tCol4"><input type="text" placeholder="Your Town"></th>
                        <th class="tCol4"><input type="text" placeholder="Postal Code"></th>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th>
                            <label>Acoount Details</label><br>
                        </th>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th class="tCol4"> <input type="text" placeholder="Account No"></th>
                        <th class="tCol4"><input type="text" placeholder="Bank Name"></th>
                        <th class="tCol4"><input type="text" placeholder="Account Name"></th>
                        <th class="tCol4"><input type="text" placeholder="Branch Name"></th>

                    </tr>
                </table>
                <table>
                    <tr>
                        <th>
                            <label>Upload Clear images of Cover Pages(2)</label><br>
                            <input type="text">

                        </th>
                    </tr>
                </table>
                <input type="submit" placeholder="Submit">



            </form>
        </div>
    </div>




    <?php include 'footer.php'; ?>

</body>

</html>