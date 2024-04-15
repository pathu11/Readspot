<?php
    $title = "Contact Us";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="contact-cont">
        <form action="#" class="contact-us">

            <h1>Any Complaint?</h1>
            
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
                    <input type="email" class="form-topic" name="PhoneNumber" placeholder="Phone Number">
                </div>
            </div>
    
            <div class="topic-name2">
                <div class="first-name-div">
                    <label class="label-topic" for="input3" required>Reason for Complaint</label><br>
                    <select id="category" name="Reason" required onchange="toggleInput()">
                        <option value="technology">Reason 01</option>
                        <option value="travel">Reason 02</option>
                        <option value="food">Reason 03</option>
                        <option value="lifestyle">Reason 04</option>
                        <option value="health">Reason 05</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="last-name-div">
                    <label class="label-topic">Enter Other Reason</label><br>
                    <input type="text" class="form-topic" name="OtherReason" id="otherReasonInput" placeholder="Other Reason" disabled>
                </div>
            </div>

    
            <div class="topic-name3">
                <label class="label-topic">Please provide any details</label><br>
                <textarea id="description" name="description" rows="20" class="form-topic" required></textarea>
            </div>

            <input type="submit" value="Send">
        </form>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>

<script>
    function toggleInput() {
        var selectBox = document.getElementById("category");
        var otherReasonInput = document.getElementById("otherReasonInput");

        if (selectBox.value === "other") {
            otherReasonInput.disabled = false;
        } else {
            otherReasonInput.disabled = true;
        }
    }
</script>
