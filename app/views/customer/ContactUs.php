<?php
    $title = "Contact Us";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="contact-cont">
        <form action="<?php echo  URLROOT; ?>/customer/ContactUs"  method="POST" enctype="multipart/form-data" class="contact-us" onsubmit="return checkLoginStatus()">
            <h3>Any Complaint?</h3>
            
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
                    <label class="label-topic" required>Phone Number(+94112323234)</label><br>
                    <input type="text" class="form-topic" pattern="\+\d{11}" name="PhoneNumber" placeholder="Phone Number">
                </div>
            </div>

            <div class="topic-name2">
                <div class="first-name-div">
                    <label class="label-topic" for="input3" required>Type of Complaint</label><br>
                    <select id="category" name="Reason" required onchange="toggleInput()">
                        <option value="Events">Event related</option>
                        <option value="Challenges">Challenge related</option>
                        <option value="Contents">Content related</option>
                        <option value="Comments">comment related</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="last-name-div">
                    <label class="label-topic">Enter Other Reason</label><br>
                    <input type="text" class="form-topic" name="OtherReason" id="otherReasonInput" placeholder="Other Reason" disabled>
                </div>
            </div>

            <div class="topic-name2">
                <div class="complaint-img-div">
                    <label class="label-topic">Error Image (if any)</label><br>
                    <input type="file" id="picture" accept="image/*"  name="imgComplaint">
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

        if (selectBox.value === "Other") {
            otherReasonInput.disabled = false;
        } else {
            otherReasonInput.disabled = true;
        }
    }
</script>

<script>
    function checkLoginStatus() {
        // Check if user is logged in
        <?php if (!isLoggedInCustomer()): ?>
            // If not logged in, display SweetAlert
            Swal.fire({
                title: 'You need to login',
                text: 'Please log in to submit your complaint.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Login',
                confirmButtonColor: "#70BFBA",
                cancelButtonColor: "#d33",
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to login page
                    window.location.href = '<?php echo URLROOT; ?>/users/login';
                }
            });

            // Return false to prevent form submission
            return false;
        <?php endif; ?>

        // If user is logged in, allow form submission
        return true;
    }
</script>
