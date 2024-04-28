<?php
    $title = "Add Event";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>          
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Function to validate dates and times
        function validateDateTime() {
            // Get date inputs
            var startDate = new Date(document.getElementById("startDate").value);
            var endDate = new Date(document.getElementById("endDate").value);
            var today = new Date();
            today.setHours(0, 0, 0, 0);
            startDate.setHours(0, 0, 0, 0);
            endDate.setHours(0, 0, 0, 0);

            // Get time inputs
            var startTime = document.getElementById("startTime").value;
            var endTime = document.getElementById("endTime").value;

            // Check if start date is equal to or after today
            if (startDate < today) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Start date must be equal to or after today.'
                });
                return false;
            }

            // Check if end date is after start date
            if (endDate < startDate) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'End date must be equal to or after the start date.'
                });
                return false;
            }

            
            if (endTime < startTime) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'End time must be after the start time.'
                });
                return false;
            }

            return true; // Dates and times are valid
        }

        // Function to validate form on submit
        function validateForm() {
            return validateDateTime();
        }
    </script>


    <div class="container">
        <div class="add-content">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <form action="<?php echo URLROOT; ?>/customer/Addevnt" enctype="multipart/form-data" class="cont-add" method="POST" onsubmit="return validateForm()">
                <h1>Add an Event</h1>
                <div class="topic-cont">
                    <label class="label-topic">Event Name</label><br>
                    <input type="text" class="form-topic" name="eventName" required>
                </div>
                <div class="disc-cont">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" name="descriptions" rows="12" class="form-topic" required></textarea>
                </div>
                <div class="upload-pages book-cate">
                    <div class="topic-cont author">
                        <label class="label-topic">Event Location</label><br>
                        <input type="text" class="form-topic" name="location" required>
                    </div>
                    <div class="topic-book author">
                        <label class="label-topic">Event Category</label><br>
                        <select id="category"  name="category" required>
                            <!-- <option value="Author Talks">Author Talks</option>
                            <option value="Book Launch">Book Launch</option>
                            <option value="Book Fair">Book Fair</option>
                            <option value="Book Club Meeting">Book Club Meeting</option>
                            <option value="Book Swap Event">Book Swap Event</option> -->
                            <?php foreach($data['eventCategoryDetails'] as $eventCategoryDetails): ?>
                                <option><?php echo $eventCategoryDetails->event; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="upload-pages">
                    <div class="topic-cont">
                        <label class="label-topic">Start Date</label><br>
                        <input type="date" class="form-topic" id="startDate" name="startDate" required>
                    </div>
                    <div class="topic-cont">
                        <label class="label-topic">End Date</label><br>
                        <input type="date" class="form-topic" id="endDate" name="endDate" required>
                    </div>
                </div>
                
                <div class="upload-pages">
                    <div class="topic-cont">
                        <label class="label-topic">Start Time</label><br>
                        <input type="time" class="form-topic" id="startTime" name="startTime" required>
                    </div>
                    <div class="topic-cont">
                        <label class="label-topic">End Time</label><br>
                        <input type="time" class="form-topic" id="endTime" name="endTime" required>
                    </div>
                </div>

                <div class="upload-doc-content">
                    <div class="img-cont-content">
                        <label class="label-topic">Event Poster</label><br>
                        <input type="file" id="picture" name="imgMain" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image1</label><br>
                        <input type="file" id="picture" name="1stImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image2</label><br>
                        <input type="file" id="picture" name="2ndImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image3</label><br>
                        <input type="file" id="picture" name="3rdImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image4</label><br>
                        <input type="file" id="picture" name="4thImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image5</label><br>
                        <input type="file" id="picture" name="5thImg" accept="image/*" required>
                    </div>
                    <!-- <div class="pdf-cont">
                        <label class="label-topic">Upload Document</label><br>
                        <input type="file" id="pdf" name="pdf" accept=".pdf" required>
                    </div> -->
                </div>
                <input type="submit" value="Submit">
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
                window.location.href = "<?php echo URLROOT; ?>/customer/Event"; // Redirect to the event page
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
    </div>