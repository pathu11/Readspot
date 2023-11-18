<?php
    $title = "Exchange Book Details";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="excg-detail">
        <div class="sub1">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book3" class="main-img"> <!--path changed-->
        </div>
        <div class="sub2">
            <h3>Book Name : <span>The Great Gatsby</span></h3><br>
            <h3>Author of Book : <span>F. Scott Fitzgerald</span></h3><br>
            <h3>Book Category : <span>Novel</span></h3><br>
            <h3>Condition : <span>Used</span></h3><br>
            <h3>Published Date : <span>November 17, 2020</span></h3><br>
            <h3>Price : <span>Rs.1500.00</span></h3><br>
            <h3>Price Type : <span>Fixed</span></h3><br>
            <h3>Weight (grams) : <span>181g</span></h3><br>
            <h3>ISBN Number : <span>ISBN 9780743273565 </span></h3><br>
            <!-- <h3>ISSN Number : <span>Lorem ipsum dolor sit amet.</span></h3><br>
            <h3>ISMN Number : <span>Lorem ipsum dolor sit amet.</span></h3> -->
        </div>
        <div class="sub3">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/book4.jpeg" alt="Book3" class="sub-img"> <!--path changed-->
        </div>
        <div class="sub4">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/inside.jpeg" alt="Book3" class="sub-img"> <!--path changed-->
        </div>
        <div class="sub5">
            <img src="<?php echo URLROOT; ?>/assets/images/customer/back.jpeg" alt="Book3" class="sub-img"> <!--path changed-->
        </div>
        <div class="sub6">
        <h3>Description about the book</h3><br>
            <p>The Great Gatsby, third novel by F. Scott Fitzgerald, published in 1925 by Charles Scribner’s Sons. Set in Jazz Age New York, the novel tells the tragic story of Jay Gatsby, a self-made millionaire, and his pursuit of Daisy Buchanan, a wealthy young woman whom he loved in his youth. Unsuccessful upon publication, the book is now considered a classic of American fiction and has often been called the Great American Novel.
            </p>

        </div>
        <div class="sub9">
        <h3>Which Books I Want</h3><br>
            <p>
            <ol>
                <li>War and Peace</li>
                <li>Madame Bovary</li>
                <li>Anna Karenina</li>
                <li>Lolita</li>
                <li>Harry Potter and the Chamber of Secrets</li>
                <li>Harry Potter and the Half-Blood Prince</li>
                <li>Hamlet</li>
                <!-- <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
                <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
                <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li> -->
            </ol>
            </p>
        </div>
        <div class="sub7">
        <h3>Town : <span>Panadura</span></h3><br>
            <h3>District : <span>Kalutara</span></h3><br>
            <h3>Postal Code : <span>12500</span></h3><br>
        </div>
        <div class="sub8">
            <a href="#"><button class="chat-btn">Chat</button></a>
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
