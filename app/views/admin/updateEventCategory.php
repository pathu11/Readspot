<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Event Category</title>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/addCategories.css" />
</head>
<body>
<?php require APPROOT . '/views/admin/nav.php';?>

  <div class="form">
  <form method="post" class="categoryAddForm" action="<?php echo URLROOT;?>/admin/updateEventCategory/<?php echo $data['id'];?>">
    <div class="grid-container">
      <label for="category">Event Category</label>
      <input type="text" name="event_category" id="category" class="<?php echo (!empty($data['event_category_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['event_category'];?>" required>
      <span class="error"><?php echo $data['event_category_err']; ?></span>
      
      <label for="description">Description</label>
      <input type="text" name="description" id="description" class="<?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description'];?>" required>
      <span class="error"><?php echo $data['description_err']; ?></span>

      <button type="submit" class="button">Update</button>
    </div>
  </form>
</div>
</body>
</html>