<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbooks.css" />

  <title>Add Event</title>
</head>
<body>
  <?php require APPROOT.'/views/publisher/sidebar.php';?>
  <div class="form-container">
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
      <br><br><label>Enter Your event poster with all details to display in our site</label>
      <div><input type="file" id="pdfUpload1" name="poster" required></div>
      <br>
      <button class="submit" type="button" onclick="goBack()">Back</button>
      <button type="submit" class="submit">Request</button>
    
      </form>
    </div>
  </div>
  
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>