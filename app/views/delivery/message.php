
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/delivery/message.css" />
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>



<div>
    <div>
        <div class="form-container">
             
            <div class="form1" id="messages">
                <h2>Send a Message </h2>
                <form id="messageForm" method="POST">                   
                    <br>
                    <br>
                    <label for="topic">Your Topic:</label>
                    <input type='text' id="topic" name="topic" required><br> 
                    <span class="error"><?php echo $data['topic_err']; ?></span>            
                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" required></textarea><br>
                    <span class="error"><?php echo $data['message_err']; ?></span>
                    
                    <input type="hidden" id="receiverId" name="receiver_id" value="<?php echo isset($_GET['receiver_id']) ? $_GET['receiver_id'] : ''; ?>">
                                   
                    
                    <button type="submit" onclick="goBack()" class="go-back-link">Back</button>
                    <button type="submit" class="submit">Send Message</button>
                    </div> 
                    <br>       
                    

                </form>
            </div>
        </div>

</div> 
    </div>
   


    <script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
<script>var urlroot="<?php echo URLROOT; ?>"
console.log(urlroot)</script>
<script>
   $(document).ready(function () {
    loadComments();

    
    $('#messageForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: urlroot + '/delivery/message', // Update the path
        data: $(this).serialize(),
        data: $(this).serialize() +  '&receiver_id=' + $('#receiverId').val(),
        success: function () {
            loadMessages();
            $('#messageForm')[0].reset();
        }
    });
});

    

   

});


</script>

</body>
</html>
