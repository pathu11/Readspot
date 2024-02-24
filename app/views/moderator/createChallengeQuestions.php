<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/moderator/createChallengeQuestions.css" />
  <title>Create Challenge Questions</title>
</head>
<body>
  <?php require APPROOT . '/views/moderator/nav.php';?>
  <div class="form-container">
    <h2><strong>Quiz Question Details</strong></h2>
    <div class="form-grid">
      <form action="<?php echo URLROOT;?>/moderator/createChallengeQuestions" method="post">
        <p><strong>Question Number 1:</strong></p>
        <input type="textarea" name="q1" id="q1" placeholder="Write Question number 1 here..">
        <input type="text" name="q1-opt1" id="q1-opt1" placeholder="Enter Option a">
        <input type="text" name="q1-opt2" id="q1-opt2" placeholder="Enter Option b">
        <input type="text" name="q1-opt3" id="q1-opt3" placeholder="Enter Option c">
        <p class="answer"><strong>Correct Answer</strong></p>
        <select name="q1-answer" id="q1-answer">
          <option value="opt1">Option a</option>
          <option value="opt2">Option b</option>
          <option value="opt3">Option c</option>
        </select>
        <br><br><br>

        <p><strong>Question Number 2:</strong></p>
        <input type="textarea" name="q2" id="q2" placeholder="Write Question number 2 here..">
        <input type="text" name="q2-opt1" id="q1-opt1" placeholder="Enter Option a">
        <input type="text" name="q2-opt2" id="q1-opt2" placeholder="Enter Option b">
        <input type="text" name="q2-opt3" id="q1-opt3" placeholder="Enter Option c">
        <p class="answer"><strong>Correct Answer</strong></p>
        <select name="q2-answer" id="q2-answer">
          <option value="opt1">Option a</option>
          <option value="opt2">Option b</option>
          <option value="opt3">Option c</option>
        </select>
        <br><br><br>
        
        <p><strong>Question Number 3:</strong></p>
        <input type="textarea" name="q3" id="q3" placeholder="Write Question number 1 here..">
        <input type="text" name="q3-opt1" id="q3-opt1" placeholder="Enter Option a">
        <input type="text" name="q3-opt2" id="q3-opt2" placeholder="Enter Option b">
        <input type="text" name="q3-opt3" id="q3-opt3" placeholder="Enter Option c">
        <p class="answer"><strong>Correct Answer</strong></p>
        <select name="q3-answer" id="q3-answer">
          <option value="opt1">Option a</option>
          <option value="opt2">Option b</option>
          <option value="opt3">Option c</option>
        </select>
        <br><br><br>

        <p><strong>Question Number 4:</strong></p>
        <input type="textarea" name="q4" id="q4" placeholder="Write Question number 1 here..">
        <input type="text" name="q4-opt1" id="q4-opt1" placeholder="Enter Option a">
        <input type="text" name="q4-opt2" id="q4-opt2" placeholder="Enter Option b">
        <input type="text" name="q4-opt3" id="q4-opt3" placeholder="Enter Option c">
        <p class="answer"><strong>Correct Answer</strong></p>
        <select name="q4-answer" id="q4-answer">
          <option value="opt1">Option a</option>
          <option value="opt2">Option b</option>
          <option value="opt3">Option c</option>
        </select>
        <br><br><br>

        <p><strong>Question Number 5:</strong></p>
        <input type="textarea" name="q5" id="q5" placeholder="Write Question number 1 here..">
        <input type="text" name="q5-opt1" id="q5-opt1" placeholder="Enter Option a">
        <input type="text" name="q5-opt2" id="q5-opt2" placeholder="Enter Option b">
        <input type="text" name="q5-opt3" id="q5-opt3" placeholder="Enter Option c">
        <p class="answer"><strong>Correct Answer</strong></p>
        <select name="q5-answer" id="q5-answer">
          <option value="opt1">Option a</option>
          <option value="opt2">Option b</option>
          <option value="opt3">Option c</option>
        </select>
        <br>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>