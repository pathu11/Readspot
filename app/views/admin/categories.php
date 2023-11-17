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
      <p>Categories</p>
      <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="tdata">1</td>
          <td>Fiction</td>
          <td><i class="fa fa-solid fa-trash"></i><i class="fa fa-solid fa-pen"></i></td>
        </tr>
        <tr>
          <td class="tdata">2</td>
          <td>Science Fiction</td>
          <td><i class="fa fa-solid fa-trash"></i><i class="fa fa-solid fa-pen"></i></td>
        </tr>
        <tr>
          <td class="tdata">3</td>
          <td>Mystery</td>
          <td><i class="fa fa-solid fa-trash"></i><i class="fa fa-solid fa-pen"></i></td>
        </tr>
              <!-- Add more rows for additional categories -->
      </tbody>
      </table>
    </div>
  
    <div class="container-column">
      <p>Events</p>
      <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="tbody">
        <tr>
          <td class="tdata">1</td>
          <td>Fiction</td>
          <td><i class="fa fa-solid fa-trash"></i><i class="fa fa-solid fa-pen"></i></td>
        </tr>
        <tr>
          <td class="tdata">2</td>
          <td>Science Fiction</td>
          <td><i class="fa fa-solid fa-trash"></i><i class="fa fa-solid fa-pen"></i></td>
        </tr>
        <tr>
          <td class="tdata">3</td>
          <td>Mystery</td>
          <td><i class="fa fa-solid fa-trash"></i><i class="fa fa-solid fa-pen"></i></td>
        </tr>
              <!-- Add more rows for additional categories -->
      </tbody>
      </table>
    </div>
  </div>
  
</body>
</html>