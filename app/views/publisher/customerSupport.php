
<?php
    $title = "Customer Support";
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/customerSupport.css">

    <title>Customer Support</title>
    
</head>

<body>
<?php   require APPROOT . '/views/publisher/nav.php';?>
    <div class="chat-container1">
        <input type="text" placeholder="Search..." class="search-bar">
</div>
<div class="chat">
    <div class="column column1">
        <div><h1 style="background-color:white">All Conversations</h1></div>
        
           <button class="div" >
            
                <p><i class="fas fa-user" style="color: black;"></i>  <b>M.K.P.Ahinsa</b></p>
                <p>&emsp;&emsp;Hi,According to the Order id-345678 have u any  ...</p>
            </button>
            
        
            <button class="div" >
                <p><i class="fas fa-user" style="color: black;">  </i> <b>M.K.P.Ahinsa</b></p>
                <p>&emsp;&emsp;Hi,According to the Order id-345678 my order not </p>
            </button>
            <button class="div" >
                <p><i class="fas fa-user" style="color: black;"></i>  <b>M.K.P.Ahinsa</b></p>
                <p>&emsp;&emsp;Hi,According to the Order id-344778 i have submit my payment </p>
            </button>
    </div> 
    <div  class="column column2">
        <div class="chat-container">
            <div class="chat-header"> Chat</div>
            <div class="chat-messages">
                <div class="chat-message">Hello, how are you?</div>
                <div class="chat-message user-message">I'm good, thanks! How about you?</div>
                <div class="chat-message">I'm doing well too. Thanks for asking!</div>
                <div class="chat-message user-message">I'm good, thanks! How about you?</div>
                <div class="chat-message">I'm doing well too. Thanks for asking!</div>
                <div class="chat-message user-message">I'm good, thanks! How about you?</div>
                <div class="chat-message">I'm doing well too. Thanks for asking!</div>
                <div class="chat-message user-message">I'm good, thanks! How about you?</div>
                <div class="chat-message">I'm doing well too. Thanks for asking!</div>
                    <!-- Add more chat messages here -->
            </div>
            <input class="message-input" type="text" placeholder="Type your message...">
        </div>
    </div>
            
            

    

</div>
    


<?php   require APPROOT . '/views/publisher/footer.php';?>
   
</body>

</html>
