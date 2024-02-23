<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="<?php echo URLROOT;?>/assets/css/customer/question.css" rel="stylesheet">

  <title>Quiz</title>
</head>
<body>
  <div class="question">
    <p style="color:#0B5E70"><strong>Question 04</strong></p>
    <p><?php echo $data['question'];?>?</p>
  </div>
  <div class="img-options">
    <div class="image">
      <img src="<?php echo URLROOT;?>/assets/images/customer/q1.jpg">
    </div>
    <div class="options">
      <div class="container">
        <input type="radio" name="option1" value="option1">
        <label><?php echo $data['option1'];?></label">
      </div>
      <div class="container">
        <input type="radio" name="option2" value="option1">
        <label><?php echo $data['option2'];?></label">
      </div>
      <div class="container">
        <input type="radio" name="option3" value="option1">
        <label><?php echo $data['option3'];?></label">
      </div>
      <div class="next">
        <a href="<?php echo URLROOT; ?>/customer/quizQuestion5/<?php echo $data['quiz_id']; ?>"><strong>Question 05</strong><i class="fa fa-solid fa-forward fa-lg"></i></a>
      </div>
    </div>
  </div>
</body>
</html>