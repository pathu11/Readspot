<?php
    $title = "Contact Us";
    require APPROOT . '/views/landing/header.php'; //path changed
?>

    <div class="contact-cont">
        <form action="#" class="contact-us">

            <h1>SEND A MESSAGE</h1>
            
            <div class="topic-name1">
                <label class="label-topic" required>Name</label><br>
                <input type="text" class="form-topic">
            </div>
            
            <div class="topic-name2">
                <label class="label-topic" required>Email</label><br>
                <input type="email" class="form-topic">
            </div>
    
            <div class="topic-name2">
                <label class="label-topic" for="input3" required>Subject</label><br>
                <input type="text" class="form-topic" id="input3">
            </div>
    
            <div class="topic-name3">
                <label class="label-topic">Message</label><br>
                <textarea id="description" name="description" rows="20" class="form-topic" required></textarea>
            </div>

            <input type="submit" value="Send">
        </form>
    </div>

<?php
    require APPROOT . '/views/landing/footer.php'; //path changed
?>
