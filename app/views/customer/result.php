<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?php echo URLROOT;?>/assets/css/customer/result.css" rel="stylesheet">
  <title>Result</title>
</head>
<body>
  <div class="answers">
      <h2>Did you guess the right Answers? Let's see!</h2>
      <table>
        <?php foreach($data['answers'] as $answer):?>
        <tr>
          <td><?php echo $answer->question_id .')';?></td>
          <td><?php echo $answer->question;?></td>
        </tr>
        <tr>
          <td></td> <!-- Empty cell for alignment -->
          <td>
            <ul>
              <li <?php echo ($answer->correctAnswer == 'opt1') ? 'class="correct-answer"' : ''; ?>><?php echo $answer->option1;?></li>
              <li <?php echo ($answer->correctAnswer == 'opt2') ? 'class="correct-answer"' : ''; ?>><?php echo $answer->option2;?></li>
              <li <?php echo ($answer->correctAnswer == 'opt3') ? 'class="correct-answer"' : ''; ?>><?php echo $answer->option3;?></li>
            </ul>
          </td>
        </tr>
        <?php endforeach;?>
      </table>
  </div>

  <div class="result-go">
    <a href="<?php echo URLROOT?>/customer/BookChallenge">Go back to quizes</a>
    <div class="result">
      <h2>Your Result</h2>
      <div class="result-chart">
        <div class="pie animate" style="--p:<?php echo $data['percentage']?>;--c:lightgreen"><?php echo $data['numberOfRightAnswers']?>/5</div>
      </div>
      
      <div class="result-sheet">
        <div>
            <p style="color: green;">Number of right answers😀</p>
            <p class="number" style="color: green;"><?php echo $data['numberOfRightAnswers'];?></p>
        </div>
        <div>
            <p style="color: red;">Number of wrong answers😞</p>
            <p class="number" style="color: red;"><?php echo $data['numberOfWrongAnswers'];?></p>
        </div>
        <div>
            <p>Challenge Points</p>
            <p class="number"><?php echo $data['score'];?></p>
        </div>
        <div>
            <p>Total Points</p>
            <p class="number">15</p>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>