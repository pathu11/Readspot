<?php
    $title = "Buy New Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>

        <div class="sub-cont-BC1">
            <div class="ongoing-challenges">
                <h2>Ongoing Challenges</h2>
                <table>
                    <tr>
                    <?php foreach($data['challengeDetails'] as $challenge):?>
                        <td class="card" style="background-image: url('<?php echo URLROOT?>/assets/images/moderator/<?php echo $challenge->img; ?>');">
                            <div class="text">
                            <h2><?php echo $challenge->title; ?></h2>
                            <p><?php echo $challenge->description;?></p>
                            <?php if($challenge->attempted_by_user == $_SESSION['user_id']): ?>
                                <h3>Already Attempted</h3>
                            <?php else: ?>
                                <div class="wrap">
                                    <button onclick="showAcceptPopup('<?php echo $challenge->quiz_id; ?>')" class="btn">Attempt</button>
                                </div>
                            <?php endif; ?>
                            </div>
                        </td>
                    
                    </tr>
                    <div id="acceptPopup_<?php echo $challenge->quiz_id; ?>" class="model">
                        <div class="modal-content">
                            <span class="close" onclick="hidePopup('acceptPopup_<?php echo $challenge->quiz_id; ?>')">&times;</span>
                            <p><?php echo $challenge->description;?></p>
                            <span style="color: red;">If you go back you cannot attempt quiz again. Your attempt will be recorded.</span><br>
                            <a href="<?php echo URLROOT; ?>/customer/quizQuestion/<?php echo $challenge->quiz_id;?>/1"><button>Attemp Now</button></a>
                        </div>
                    </div>
                    <?php endforeach;?>
                </table>
            </div>

            <div class="score">
                <h2>Scoreboard</h2>
                <table>
                <?php
                $userFound = false;
                foreach($data['quizDetails'] as $score):
                ?>
                    <tr>
                        <?php if($score->user_id==$_SESSION['user_id']):
                            $userFound = true; 
                        ?>
                            <td>You</td>
                        <?php else:?>
                            <td><?php echo $score->name;?></td>
                        <?php endif;?>
                        <td><?php echo $score->total_score?></td>
                    </tr>
                <?php endforeach;?>
                </table>
                <?php if(!$userFound): ?>
                    <tr>
                        <td>You haven't attempted any quizzes yet. Try them to get on the scoreboard!</td>
                    </tr>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT;?>/assets/js/customer/tables.js"></script>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
