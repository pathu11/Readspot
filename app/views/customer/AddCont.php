<?php
    $title = "Add Content";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <head>
        
    </head>
    <div class="container">
        <div class="add-content">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <form action="<?php echo  URLROOT; ?>/customer/AddCont"  method="POST" enctype="multipart/form-data" class="cont-add">
                <h1>Add a Content</h1>
                <div class="topic-cont">
                    <label class="label-topic">Topic</label><br>
                    <input type="text" name="topic" class="form-topic" required>
                    
                </div>
                <div class="disc-cont">
                    <label class="label-topic">Summary about your content</label><br>
                    <textarea id="description" name="description" rows="12" class="form-topic" required></textarea>
                </div>
                <div class="upload-doc">
                    <div class="img-cont">
                        <label class="label-topic">Upload an relevent Image</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="pdf-cont">
                        <label class="label-topic">Upload Your content Document</label><br>
                        <input type="file" id="pdf" name="pdf" accept=".pdf" required>
                    </div>
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
                window.location.href = "<?php echo URLROOT; ?>/customer/Content"; // Redirect to the event page
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
