<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories</title>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/categories.css" />
</head>
<body>
  <?php require APPROOT . '/views/admin/nav.php';?>
  <div class="table-container">
    <div class="container-column">
      <h3>Categories</h3>
      <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Category</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data['bookCategoryDetails'] as $bookCategoryDetails): ?>
        <tr>
          <td class="tdata"><?php echo $bookCategoryDetails->id; ?></td>
          <td><?php echo $bookCategoryDetails->category; ?></td>
          <td><?php echo $bookCategoryDetails->description; ?></td>
          <td><i class="fa fa-solid fa-pen"></i><i class="fa fa-solid fa-trash"></i></td>
        </tr>
        <?php endforeach; ?>      <!-- Add more rows for additional categories -->
      </tbody>
      </table>
    </div>
  
    <div class="container-column">
      <h3>Events</h3>
      <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Event</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="tbody">
      <?php foreach($data['eventCategoryDetails'] as $eventCategoryDetails): ?>
        <tr>
          <td class="tdata"><?php echo $eventCategoryDetails->id; ?></td>
          <td><?php echo $eventCategoryDetails->event; ?></td>
          <td><?php echo $eventCategoryDetails->description; ?></td>
          <td><i class="fa fa-solid fa-pen"></i><i class="fa fa-solid fa-trash"></i></td>
        </tr>
        <?php endforeach; ?> 
      </tbody>
      </table>
    </div>
  </div>
  
</body>
</html>