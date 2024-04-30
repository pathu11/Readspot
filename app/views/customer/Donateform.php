<?php
    $title = "Donate Form";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <!-- <div class="main-cont">
    <div class="add-content">
            <form action="#" class="book-add">

                <h1>Donate Books</h1>
                
                <div class="topic-book">
                    <label class="label-topic" required>Name</label><br>
                    <input type="text" class="form-topic">
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic" required>Email</label><br>
                    <input type="email" class="form-topic">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3" required>Subject</label><br>
                    <input type="text" class="form-topic" id="input3">
                </div>
        
                <div class="disc-book">
                    <label class="label-topic">Message</label><br>
                    <textarea id="description" name="description" rows="20" class="form-topic" required></textarea>
                </div>

                <input type="submit" value="Send">
            </form>
        </div>
        
    </div> -->
    
    <div class="contact-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <form action="<?php echo  URLROOT; ?>/customer/Donateform/<?php echo $data['charity_event_id'];?>"  method="POST" enctype="multipart/form-data" class="contact-us">

            <h1>Donate Books</h1>
            
            <div class="topic-name1">
                <div class="first-name-div">
                    <label class="label-topic" required>First Name</label><br>
                    <input type="text" class="form-topic" name="Fname" placeholder="First Name">
                </div>
                <div class="last-name-div">
                    <label class="label-topic" required>Last Name</label><br>
                    <input type="text" class="form-topic" name="Lname" placeholder="Last Name">
                </div>
            </div>
            
            <div class="topic-name2">
                <div class="first-name-div">
                    <label class="label-topic" required>Email Address</label><br>
                    <input type="email" class="form-topic" name="Email" placeholder="Email Address">
                </div>
                <div class="last-name-div">
                    <label class="label-topic" required>Phone Number</label><br>
                    <input type="text" class="form-topic" name="PhoneNumber" placeholder="Eg: +94712345689" pattern="\+\d{11}">
                </div>
            </div>

            <!-- <div class="topic-name2">
                <div class="first-name-div">
                    <label class="label-topic" for="input3" required>Type of Books</label><br>
                    <select id="category" name="Reason" required onchange="toggleInput()">
                        <option value="Reason 01">Book 01</option>
                        <option value="Reason 02">Book 02</option>
                        <option value="Reason 03">Book 03</option>
                        <option value="Reason 04">Book 04</option>
                        <option value="Reason 05">Book 05</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="last-name-div">
                    <label class="label-topic">Quantity</label><br>
                    <input type="text" class="form-topic" name="OtherReason" id="otherReasonInput" placeholder="Quantity">
                </div>
            </div> -->

            <div class="topic-name4">
                <div class="book-main-div">
                    <label class="label-topic">Type of Books</label><br>
                </div>
                <div class="book-type-div">
    <?php
    // Split the booksIWant string by commas
    $booksIWantList = explode(',', $data['booksIWant']);

    // Output each book in the list as a list item
    // Start unordered list
    foreach ($booksIWantList as $book) {
        // Use the actual book name as ID and name
        $bookId = 'book_' . str_replace(' ', '_', $book);
        $bookQuantityId = $bookId . '_Quantity';
        ?>
        <div class="sub-category-div">
            <input type="checkbox" id="<?php echo $bookId; ?>" name="<?php echo $bookId; ?>">
            <label for="<?php echo $bookId; ?>" class="label-topic"><?php echo trim($book); ?></label>
            <input type="text" class="form-topic" name="<?php echo $bookId; ?>_Quantity" id="<?php echo $bookQuantityId; ?>" placeholder="Quantity" disabled>
        </div>
        <?php
    }
    ?>
</div>

            </div>

            <!-- <div class="topic-name2">
                <div class="complaint-img-div">
                    <label class="label-topic">Error Image (if any)</label><br>
                    <input type="file" id="picture" accept="image/*"  name="imgComplaint">
                </div>
            </div> -->
    
            <div class="topic-name3">
                <label class="label-topic">Additional details</label><br>
                <textarea id="description" name="description" rows="20" class="form-topic" required></textarea>
            </div>

            <input type="submit" value="Send">
        </form>
    </div>
    <div id="myModal" class="modal">
            <div class="modal-content">
                <!-- <span class="close" onclick="closeModal()">&times;</span> -->
                <h2>Record Added!</h2>
                <p>Your record has been recorded. Wait for admin approval</p>
                <button onclick="closeModal()">OK</button>
            </div>
        </div>

        <script>
            function showModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            function closeModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
                window.location.href = "<?php echo URLROOT; ?>/customer/DonateBooks"; // Redirect to the event page
            }

            <?php
            // Check if the showModal flag is set, then call showModal()
            if (isset($_SESSION['showModal']) && $_SESSION['showModal']) {
                echo "window.onload = showModal;";
                // Unset the session variable after use
                unset($_SESSION['showModal']);
            }
            ?>

            // Submit form function
            // function submitForm() {
            //     document.getElementById("eventForm").submit();
            // }
        </script>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>


<!-- <script>
    // Function to toggle quantity input based on checkbox status
    function toggleQuantityInput(checkboxId, quantityInputId) {
        var checkbox = document.getElementById(checkboxId);
        var quantityInput = document.getElementById(quantityInputId);
        quantityInput.disabled = !checkbox.checked;
    }

    // Add event listeners to each checkbox to toggle quantity input
    document.getElementById("book01").addEventListener("change", function() {
        toggleQuantityInput("book01", "book01Quantity");
    });

    document.getElementById("book02").addEventListener("change", function() {
        toggleQuantityInput("book02", "book02Quantity");
    });

    document.getElementById("book03").addEventListener("change", function() {
        toggleQuantityInput("book03", "book03Quantity");
    });
</script> -->

<script>
    // Function to toggle quantity input based on checkbox status
    function toggleQuantityInput(checkboxId, quantityInputId) {
        var checkbox = document.getElementById(checkboxId);
        var quantityInput = document.getElementById(quantityInputId);
        quantityInput.disabled = !checkbox.checked;
    }

    // Add event listeners to each checkbox to toggle quantity input
    <?php
    // Loop through each book and add event listeners
    foreach ($booksIWantList as $book) {
        // Use the actual book name to construct IDs
        $bookId = 'book_' . str_replace(' ', '_', $book);
        $bookQuantityId = $bookId . '_Quantity';
        ?>
        document.getElementById("<?php echo $bookId; ?>").addEventListener("change", function() {
            toggleQuantityInput("<?php echo $bookId; ?>", "<?php echo $bookQuantityId; ?>");
        });
        <?php
    }
    ?>
</script>

