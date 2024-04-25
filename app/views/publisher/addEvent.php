
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addEvent.css" />
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">

  <title>Add Event</title>
</head>
<body>
  <?php require APPROOT.'/views/publisher/sidebar.php';?>
  <div class="form-container">
    <div class="bg">
      <img src="<?php echo URLROOT;?>/assets/images/publisher/event.jpg">
    </div>
    <div class="form1">
      <h2>Enter the details of the event</h2>
      <form action="<?php echo URLROOT;?>/publisher/addEvent" enctype="multipart/form-data" method="post">
      
      <input type="text" name="title" class="<?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>" placeholder="Event title" required><br>
      <span class="error"><?php echo $data['title_err']; ?></span>
      
      <input type="text" name="description" class="<?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>" placeholder="Event description" required><br>
      <span class="error"><?php echo $data['description_err']; ?></span>

      <input type="text" name="location" class="<?php echo (!empty($data['location_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['location']; ?>" placeholder="Event Location" required><br>
      <span class="error"><?php echo $data['location_err']; ?></span>

      <input type="text" name="start_date" onfocus="(this.type='date')" class="<?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['start_date']; ?>" placeholder="Start Date" required><br>
      <span class="error"><?php echo $data['start_date_err']; ?></span>

      <input type="text" name="end_date" onfocus="(this.type='date')" class="<?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['end_date']; ?>" placeholder="End date" required><br>
      <span class="error"><?php echo $data['end_date_err']; ?></span>

      <select class="select <?php echo (!empty($data['category_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['category']; ?>" name="category" required>
        <option value="" selected disabled>Select Event Category</option>                     
          <?php foreach($data['eventCategoryDetails'] as $event): ?>
            <option><?php echo $event->event; ?></option>
          <?php endforeach; ?>
      </select>
      <label>Enter Your event poster with all details to display in our site</label>
      <input type="file" id="pdfUpload1" name="poster" required>
      <br>
      <button class="submit" type="button" onclick="goBack()">Back</button>
      <button type="submit" class="submit">Request</button>
    
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
    <!--div class="bg">
      <img src="<?php echo URLROOT;?>/assets/images/publisher/event2.webp">
    </div-->
  </div>
  <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Event Added Successfully</h2>
        <!-- You can add more details or actions here -->
    </div>
</div>
<?php echo $_SESSION['successEvent']; ?>
<?php if (isset($_SESSION['successEvent']) && $_SESSION['successEvent']): ?>
        showModal();
        <?php unset($_SESSION['successEvent']); ?>
    <?php endif; ?>
<script>
    function showModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
        window.location.href = "<?php echo URLROOT; ?>/publisher/events"; // Redirect to the event page
    }

    // Check if the showModal flag is set, then call showModal()
   
</script>


<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        function showModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            function closeModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
                window.location.href = "<?php echo URLROOT; ?>/publisher/events"; // Redirect to the event page
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

<!-- 
        <script>
           
        </script> -->

</html>