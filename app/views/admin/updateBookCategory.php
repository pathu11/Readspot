<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Category</title>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/addCategories.css" />
</head>
<body>
<?php require APPROOT . '/views/admin/nav.php';?>

<div class="form-container">
  <form method="post" class="categoryAddForm" enctype="multipart/form-data" action="<?php echo URLROOT;?>/admin/updateBookCategory/<?php echo $data['id'];?>">
    <div class="form-grid">
      <div class="img-div">
        <img src="<?php echo URLROOT;?>/assets/images/admin/category.jpg" style="width: 100%;"/>
      </div>
      <div class="form-div">
      <label for="category">Book Category</label>
      <input type="text" name="book_category" id="category" class="<?php echo (!empty($data['book_category_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['book_category']; ?>" required>
      <span class="error"><?php echo $data['book_category_err']; ?></span>

      <label for="description">Description</label>
      <input type="text" name="description" id="description" class="<?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>" required>
      <span class="error"><?php echo $data['description_err']; ?></span>

      <label for="image">Category Image</label>
      <input type="file" id="picture" accept="image/*" name="bookCategoryImg" class="<?php echo (!empty($data['img'])) ? 'is-invalid' : ''; ?>" required>


        <button type="submit" class="button">Update</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>