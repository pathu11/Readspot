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
                        echo '<a href="'.URLROOT.'/customer/quiz/'.$challenge->quiz_id.'"><button>Attempt</button></a>';
                    }
                    ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
