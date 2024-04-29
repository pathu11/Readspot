<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="<?php echo URLROOT;?>/assets/css/customer/question.css" rel="stylesheet">
  <title>Quiz</title>

  <script>
    const quiz_id=<?php echo $data['quiz_id']; ?>;
    // JavaScript code for the countdown timer
    let time = localStorage.getItem('remainingTime');

    // Function to update the countdown timer
    function updateCountdown() {
      const minutes = Math.floor(time / 60);
      let seconds = time % 60;

      seconds = seconds < 10 ? '0' + seconds : seconds;

      document.getElementById('countdown').innerHTML = `${minutes}:${seconds}`;
      time--;

      if(time<=0){
        localStorage.removeItem('remainingTime');
        window.location.href = 'http://localhost/Readspot/customer/result/'.quiz_id;
      }

      // Continue countdown
      setTimeout(updateCountdown, 1000);
    }

    // Start the countdown timer when the page loads
    window.onload = function() {
      updateCountdown();
    };
    
    // Call the function to update remaining time when the form is submitted
    function handleSubmit() {
      localStorage.setItem('remainingTime',time);
    }
  </script>
</head>
<body>
  <div class="question">
    <p style="color:#0B5E70"><strong>Question 02</strong></p>
    <p><?php echo $data['question'];?>?</p>
    <p class="timer" id="countdown" style="color: red;"></p>
  </div>
  <div class="img-options">
    <div class="image">
      <img src="<?php echo URLROOT;?>/assets/images/customer/q2.jpg">
    </div>
    <div class="options">
      <form id="quizForm" action="<?php echo URLROOT; ?>/customer/quizQuestion/<?php echo $data['quiz_id']; ?>/2" method="post" onsubmit="handleSubmit()">
        <div class="container">
          <input type="radio" name="option" value="opt1">
          <label><?php echo $data['option1'];?></label">
        </div>
        <div class="container">
          <input type="radio" name="option" value="opt2">
          <label><?php echo $data['option2'];?></label">
        </div>
        <div class="container">
          <input type="radio" name="option" value="opt3">
          <label><?php echo $data['option3'];?></label">
        </div>
        <div class="next">
          <button type="submit"><strong>Question 03</strong><i class="fa fa-solid fa-forward fa-lg"></i></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>