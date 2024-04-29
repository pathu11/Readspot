

<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/customer/style.css">
</head>
<body>
  <div class="wrapper">
  
    <section class="chat-area">
      <header>
      <i class="fa fa-arrow-left back-icon" onclick="history.back()"></i>
        <?php
                    $profileImage = empty($data['profile_img']) ? URLROOT . '/assets/images/publisher/person.jpg' : URLROOT . '/assets/images/landing/profile/' . $data['profile_img'] ;
                ?>
     
        <img src="<?php echo $profileImage; ?>" alt="">
        <div class="details">
          <span><?php echo $data['name']; ?></span>
         <?php if($data['isActiveNow']==1): ?>
            <p>active now</p>
        <?php else: ?>
            <p>Last seen  <em><?php echo $data['lastLogoutTime']->logout_time; ?></em> </p>
        <?php endif; ?>
        </div>
       
      </header>
      <div class="chat-box">
        

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $data['incoming_id']; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button class="button"><i class="fa fa-paper-plane" ></i></button>
      </form>
    </section>
  </div>

  <!-- <script src="javascript/chat.js"></script> -->

</body>
</html>
<script>
    var urlroot="<?php echo URLROOT; ?>";
    console.log(urlroot);
    const form = document.querySelector(".typing-area"),
        incoming_id = form.querySelector(".incoming_id").value,
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("button"),
        chatBox = document.querySelector(".chat-box");
      

    form.onsubmit = (e) => {
        e.preventDefault();
    }
    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    }

    sendBtn.onclick = () => {
        console.log("Button clicked");
        let xhr = new XMLHttpRequest();
        xhr.open("POST", urlroot + "/Chats/insertChat", true);

        xhr.onload = () => {
            console.log("XHR onload called");
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Insert successful");
                    inputField.value = "";
                    scrollToBottom();
                }else{
                    console.error("HTTP request failed with status:", xhr.status);
                }
            }else{
                console.error("HTTP request failed with status:22", xhr.status);
            }
        }

        let formData = new FormData(form);
        xhr.send(formData);
    }

    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    }

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    }

    setInterval(() =>{
        let xhr = new XMLHttpRequest();
        xhr.open("POST", urlroot + "/Chats/getChat", true);
        xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id="+incoming_id);
    }, 500);

    function scrollToBottom(){
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    
    </script>
