<?php
    $title = "Buy New Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>

        <div class="ongoing-challenges">
            <h2>Ongoing Challenges</h2>
            <table>
                <tr>
                    <th>Quiz Name</th>
                    <th>Time Limit</th>
                    <th>Attempt/Already Attempted</th>
                </tr>
                <tr>
                   <?php foreach($data['challengeDetails'] as $challenge):?>
                    <td><?php echo $challenge->title?></td>
                    <td><?php echo $challenge->time_limit?> minutes</td>
                    <td>
                    <?php if($challenge->user_id==$_SESSION['user_id']){
                        echo '<h3>Already Attemped</h3>';
                    }
                    else{
                        echo '<button onclick="showAcceptPopup(\'' . $challenge->quiz_id . '\')">Attempt</button>';

                    }
                    ?>
                    </td>
                </tr>
                <div id="acceptPopup_<?php echo $challenge->quiz_id; ?>" class="model">
                    <div class="modal-content">
                        <span class="close" onclick="hidePopup('acceptPopup_<?php echo $challenge->quiz_id; ?>')">&times;</span>
                        <p><?php echo $challenge->description;?></p>
                        <a href="<?php echo URLROOT; ?>/customer/quizQuestion/<?php echo $challenge->quiz_id;?>/1"><button>Attemp Now</button></a>
                    </div>
                </div>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    <script src="<?php echo URLROOT;?>/assets/js/customer/tables.js"></script>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
