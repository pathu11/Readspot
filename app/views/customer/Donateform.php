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
        <form action="<?php echo  URLROOT; ?>/customer/ContactUs"  method="POST" enctype="multipart/form-data" class="contact-us" onsubmit="return checkLoginStatus()">

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
                    <input type="text" class="form-topic" name="PhoneNumber" placeholder="Phone Number">
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
                    <div class="sub-category-div">
                        <input type="checkbox" id="book01" name="book01">
                        <label for="book01" class="label-topic">Book type 01</label>
                        <input type="text" class="form-topic" name="book01Quantity" id="book01Quantity" placeholder="Quantity" disabled>
                    </div>
                    <div class="sub-category-div">
                        <input type="checkbox" id="book02" name="book02">
                        <label for="book02" class="label-topic">Book 02</label>
                        <input type="text" class="form-topic" name="book02Quantity" id="book02Quantity" placeholder="Quantity" disabled>
                    </div>
                    <div class="sub-category-div">
                        <input type="checkbox" id="book03" name="book03">
                        <label for="book03" class="label-topic">Bk 03</label>
                        <input type="text" class="form-topic" name="book03Quantity" id="book03Quantity" placeholder="Quantity" disabled>
                    </div>
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

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>


<script>
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
</script>