
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
      <form action="<?php echo URLROOT;?>/publisher/addEvent" enctype="multipart/form-data" onsubmit="return validateTime()" method="post">
      
      <input type="text" name="title" class="<?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>" placeholder="Event title" required><br>
      <span class="error"><?php echo $data['title_err']; ?></span>
      
      <input type="text" name="description" class="<?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>" placeholder="Event description" required><br>
      <span class="error"><?php echo $data['description_err']; ?></span>

      <input type="text" name="location" class="<?php echo (!empty($data['location_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['location']; ?>" placeholder="Event Location" required><br>
      <span class="error"><?php echo $data['location_err']; ?></span>

      <input type="text" name="start_date" onfocus="(this.type='date')" class="<?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['start_date']; ?>" placeholder="Start Date" min="<?php echo date('Y-m-d'); ?>" 
       oninput="setEndDateMin(this.value)" required><br>
      <span class="error"><?php echo $data['start_date_err']; ?></span>

      <input type="text" name="end_date" onfocus="(this.type='date')" class="<?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['end_date']; ?>" placeholder="End date" min="<?php echo date('Y-m-d'); ?>" required><br>
      <span class="error"><?php echo $data['end_date_err']; ?></span>

      <input type="text" name="start_time" onfocus="(this.type='time')" class="<?php echo (!empty($data['start_time_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['start_time']; ?>" placeholder="Start Time" oninput="setEndTimeMin(this.value)"  required><br>
      <span class="error"><?php echo $data['start_time_err']; ?></span>

      <input type="text" name="end_time" onfocus="(this.type='time')" class="<?php echo (!empty($data['end_time_err'])) ? 'is-invalid' : ''; ?>" oninput="setEndTimeMin(this.value)"  value="<?php echo $data['end_time']; ?>" placeholder="End time" required><br>
      <span class="error"><?php echo $data['end_time_err']; ?></span>


      <select class="select <?php echo (!empty($data['category_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['category']; ?>" name="category" required>
        <option value="" selected disabled>Select Event Category</option>                     
          <?php foreach($data['eventCategoryDetails'] as $event): ?>
            <option><?php echo $event->event; ?></option>
          <?php endforeach; ?>
      </select>
      
      <label>Enter Your event poster with all details to display in our site</label>
      <div style="display:flex;">
        <input type="file" id="pdfUpload1" name="poster" required>
        <input type="file" id="pdfUpload2" name="poster1" required>
        <input type="file" id="pdfUpload3" name="poster2" required>
        <input type="file" id="pdfUpload4" name="poster3" required>
        <input type="file" id="pdfUpload5" name="poster4" required>
        <input type="file" id="pdfUpload6" name="poster5" required>

      </div>

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
            <button onclick="closeModal()" class="confirm">OK</button>
        </div>
    </div>
    <!--div class="bg">
      <img src="<?php echo URLROOT;?>/assets/images/publisher/event2.webp">
    </div-->
  </div>
  <?php
            require APPROOT . '/views/publisher/footer.php'; 
        ?>


<script>
        function validateTime() {
              var startDate = new Date(document.getElementsByName("start_date")[0].value);
              var endDate = new Date(document.getElementsByName("end_date")[0].value);
              var startTime = document.getElementsByName("start_time")[0].value;
              var endTime = document.getElementsByName("end_time")[0].value;

              if (startDate.getTime() === endDate.getTime() && startTime > endTime) {
                  alert("End time cannot be before start time on the same day.");
                  return false; // Prevent form submission
              }
              return true; // Proceed with form submission
          }
          function setEndDateMin(startDateValue) {
            document.getElementsByName("end_date")[0].min = startDateValue;
        }

        function setEndTimeMin(startTimeValue) {
            document.getElementsByName("end_time")[0].min = startTimeValue;
        }
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